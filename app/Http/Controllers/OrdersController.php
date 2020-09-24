<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Cookie;
use Carbon\Carbon;
use Validator;
use Auth;
use Mail;
use GuzzleHttp\Client;
use Srmklive\PayPal\Services\ExpressCheckout;
//Models
use App\Cart;
use App\Coupoun;
use App\Coupoun_User;
use App\ShippingCost;
use App\Order;
use App\Order_Product;
use App\User;
use App\Payment_Method;
//Mails
use App\Mail\OrderSignupPassword;
use App\Mail\BankTransferMail;
use App\Mail\NewOrderMail;
use App\Mail\OrderReceiptMail;
use App\Mail\OrderFailedMail;
use App\Mail\OrderStatusUpdateMail;
class OrdersController extends Controller{
  public function getCheckoutPage(){
    //***************** Get Cart Items
    //1- Get the user data
    if(auth()->check()){$UserId = auth()->user()->id;}else{$UserId = Cookie::get('guest_id');}
    //2- Get the cart items
    $CartItems = Cart::where('user_id' , $UserId)->where('status','active')->whereDate('created_at' , Carbon::today())->get();
    if($CartItems->count() == 0){
      return redirect()->route('product.home')->withError('You Don\'t Have Any Items in Your Cart');
    }
    //Generate the total price without a tax
    $CartSubTotalArray = $CartItems->map(function($item) {
        return ($item->Product->final_price * $item->qty);
    });
    //Generate the total tax
    $CartTaxArray = $CartItems->map(function($item) {
        return ($item->Product->tax_amount * $item->qty);
    });
    $CartTax = $CartTaxArray->sum();
    $Total = $CartSubTotalArray->sum();
    //Check id there is a coupon code applied
    $CouponDiscount = null;
    $TotalWithoutTax = $Total;

    if(isset($CartItems->first()->applied_coupon)){//There is an applied coupon
        $CouponData = explode('-',$CartItems->first()->coupon_amount );
        if($CouponData[1] == 'fixed'){
            $CouponDiscount = $CouponData[0];
        }elseif($CouponData[1] == 'percent'){
            $CouponDiscount = ($Total * $CouponData[0]) / 100;
        }else{
            $CouponDiscount = $CouponData[0];
        }
        $TotalWithoutTax = $Total - $CouponDiscount;
    }
    $SubTotal = ($CartSubTotalArray->sum() + $CartTax) - $CouponDiscount;
    $ShippingCostCountries = ShippingCost::pluck('country_name')->unique();
    $WeightArray = $CartItems->map(function($item){
      return ($item->Product->weight * $item->qty);
    });
    $OrderWeight = $WeightArray->sum();
    $CartTaxArray =  $CartItems->map(function($item){
      return ($item->Product->tax_rate);
    });
    $CartTaxAvg = $CartTaxArray->avg();
    return view('orders.checkout.checkout' , compact('CartItems','Total','CartTax','ShippingCostCountries' , 'OrderWeight' , 'CartTaxAvg' , 'SubTotal' , 'CouponDiscount' , 'TotalWithoutTax'));
  }
  public function postOrder(Request $r){
    //Validate the Request
    $Rules = [
      "first_name" =>'required',
      "last_name" => 'required',
      "phone_number" => 'required',
      "email" => 'required|email|confirmed',
      "country" => 'required',
      "address" =>'required',
      "city" => 'required',
      "zip_code" => 'required',
      "accepted_toc" => 'required',
      "order_weight" => 'required',
      "order_tax_rate" => 'required',
      "total_amount" => 'required',
      "total_tax_amount" => 'required',
      "total_shipping_cost" => 'required',
      "total_shipping_tax" => 'required'
    ];
    $validator = Validator::make($r->all() , $Rules);
    if($validator->fails()){
      return back()->withErrors($validator->errors()->all());
  }else{
      if(auth()->check()){$UserId = auth()->user()->id;}else{$UserId = Cookie::get('guest_id');}
      //Check if there is any old orders related to this user
      $OldOrders = Order::where('user_id' , $UserId)->where('status' , 'Pre-Payments')->first();
      if($OldOrders){
        //Delete the Old Order
        $OldOrders->delete();
      }
      //Create a User Account if Requested
      if($r->has('create_account') && $r->create_account == 'on'){
      //Create an Account and Log the User in
      //Check if User Existed
      $CheckUser = User::where('email' , $r->email)->first();
      if($CheckUser){
        //Update Cart Items to the new Owner ID
        if(auth()->check()){$UserId = auth()->user()->id;}else{$UserId = Cookie::get('guest_id');}
        $CartItems = Cart::where('user_id' , $UserId)->where('status' , 'active')->whereDate('created_at' , Carbon::today())->get();
        $CartItems->map(function($Item) use ($CheckUser) {
          $Item->update(['user_id' => $CheckUser->id]);
        });
        //Login
        Auth::loginUsingId($CheckUser->id);
      }else{
        $TheUser = User::create([
          'first_name' => $r->first_name,
          'last_name' => $r->last_name,
          'phone_number' => $r->phone_number,
          'email' => $r->email,
          'country' => getCountryNameFromISO($r->country),
          'street_address' => $r->address,
          'city' => $r->city,
          'zip_code' => $r->zip_code,
          'password' => 'Placeholder Password',
          'code' =>  rand(0,99999999),
          'vat_number' => $r->vat_number,
          'auth_provider' => 'Order Signup',
        ]);
        $CartItems = Cart::where('user_id' , $UserId)->where('status' , 'active')->whereDate('created_at' , Carbon::today())->get();
        $CartItems->map(function($Item) use ($TheUser) {
          $Item->update(['user_id' => $TheUser->id]);
        });
        //Send Password Creation Email

        Mail::to($r->email)->send(new OrderSignupPassword($TheUser));
        //Log the User in
        Auth::loginUsingId($TheUser->id);
      }
    }
    //Grab the User
    if(auth()->check()){$UserId = auth()->user()->id;}else{$UserId = Cookie::get('guest_id');}
    //Create the Order
    $OrderData = $r->except(['_token' , 'create_account' , 'accepted_toc' , 'diff_shipping_address' , 'email_confirmation']);
    if($r->has('diff_shipping_address') && $r->diff_shipping_address == 'no'){
      $OrderData['shipping_address'] = $r->address;
      $OrderData['shipping_address_2'] = $r->address_2;
      $OrderData['shipping_city'] = $r->city;
      $OrderData['shipping_zip_code'] = $r->zip_code;
    }
    if($r->has('vat_number') && $r->vat_number != null && $r->vat_number != ''){
      //Validate VAT Number
      $HttpClient = new Client();
      $response = @$HttpClient->get('http://apilayer.net/api/validate?access_key=c741ee3de22b687def5c1f981131e65e&vat_number='.$r->vat_number);
      if($response->getStatusCode() != 200){
        $OrderData['is_vat_valid'] = 'no';
      }else{
        $ResponseAsArray = json_decode($response->getBody(), true);
        if($ResponseAsArray['valid']){
          $OrderData['is_vat_valid'] = 'yes';
        }
      }
    }
    if($r->pickup_at_store == 'yes'){
      $OrderData['total_shipping_cost'] = '0.00';
      $OrderData['total_shipping_tax'] = '0.00';
    }
    $TheCodeNumber = "2020029051".str_replace('.' ,'', microtime(true).rand(1,9));
    $OrderData['serial_number'] = wordwrap($TheCodeNumber,5,'-',true);
    $OrderData['status'] = 'Pre-Payments';
    $OrderData['order_currency'] = getCurrency()['code'];
    $OrderData['user_id'] = $UserId;
    $TheNewOrder = Order::create($OrderData);
    //Add the Cart Items to the table
    //2- Get the cart items
    $CartItems = Cart::where('user_id' , $UserId)->where('status','active')->whereDate('created_at' , Carbon::today())->get();
    //Generate the total price without a tax
    $CartSubTotalArray = $CartItems->map(function($item) use($TheNewOrder) {
      //Decrease Cart Items Inventory
      $item->Product->update([
        'inventory' => ($item->Product->inventory - $item->qty),
        'fake_inventory' => ($item->Product->fake_inventory - $item->qty),
      ]);
      //Add Cart Item to Order
      Order_Product::create([
        'order_id' => $TheNewOrder->id,
        'user_id' => $TheNewOrder->user_id,
        'product_id' => $item->product_id,
        'is_free_shipping' => false,
        'qty' => $item->qty
      ]);
    });
    Mail::to('admin@ukfashionshop.be')->send(New NewOrderMail);
    return redirect()->route('checkout.summary' , $TheNewOrder->id);
  }
}
  public function getSummaryPage($id){
    //Get the Order and Compare it to User ID
    if(auth()->check()){$UserId = auth()->user()->id;}else{$UserId = Cookie::get('guest_id');}
    $TheOrder = Order::findOrFail($id);
    //in case the order dosn't match with the user , kill the process
    if($TheOrder->user_id != $UserId){abort(403);}
    //All Good , Move On
    //Get the Order Items
    $OrderItems = Order_Product::where('order_id' , $id)->get();
    return view('orders.checkout.summary' , compact('TheOrder' , 'OrderItems'));
  }
  public function updateVatNumber(Request $r , $id){
    //Check if the Order is There
    $TheOrder = Order::findOrFail($id);
    if($TheOrder != null){
      //Checl User ID vs Order
      if($TheOrder->user_id == $r->user_id){
        //The Guy's Order m Looking Good
        $TheOrder->update([
          'vat_number' => $r->vat_number,
          'is_vat_valid' => $r->is_vat_valid
        ]);
        return response("Order Updated" , 200);
      }else{
        return response("This is Not Your Order !" , 403);
      }
    }else{
      return response("The Order Can't be Found !" , 404);
    }
  }
  public function getPaymentPage($id){
    //Get the Order and Compare it to User ID
    if(auth()->check()){$UserId = auth()->user()->id;}else{$UserId = Cookie::get('guest_id');}
    $TheOrder = Order::findOrFail($id);
    //in case the order dosn't match with the user , kill the process
    if($TheOrder->user_id != $UserId){abort(403);}
    //All Good , Move On
    //Get the Order Items
    $OrderItems = Order_Product::where('order_id' , $id)->get();
    return view('orders.checkout.payment' , compact('TheOrder' , 'OrderItems'));
  }
  public function postPaymentPage(Request $r , $id){
    //Validate the Request
    $Rules = [
      'user_id' => 'required',
      'payment_method' => 'required'
    ];
    $validator = Validator::make($r->all() , $Rules);
    if($validator->fails()){
      return back()->withErrors($validator->errors()->all());
    }else{
      //Get the order and compare it to user id
      $TheOrder = Order::findOrFail($id);
      if($TheOrder){
        if($TheOrder->user_id == $r->user_id){
         //Check if the order already paid
          if($TheOrder->AlreadyPaid()){
            return redirect()->route('home')->withErrors('Order Already Paid, You Track the Order Progress in Your Orders Page');
          }
          if($r->payment_method == 'banktransfer'){
            //Send the Email to User
            $SendTheMessage = Mail::to($TheOrder->email)->send(new BankTransferMail($TheOrder));
            $OrderItems = Order_Product::where('order_id' , $TheOrder->id)->get();
            //Check the Payment Status
            $TheOrder->update([
              'is_paid' => 'Pending',
              'payment_method' => 'banktransfer',
              'status' => 'Waiting for payment'
              ]);
            $TheCart = Cart::where('user_id' , $TheOrder->user_id)->where('status' , 'active')->whereDate('created_at' , Carbon::today())->get();
            $TheCart->map(function($item){
              $item->update(['status' => 'purchased']);
            });
           return view('orders.checkout.thank-you' , compact('TheOrder' , 'OrderItems'));
          }elseif($r->payment_method == 'paymentoncollection'){
            //Payment on Collection
            if($TheOrder){
              if($TheOrder->pickup_at_store == 'yes'){
                //Get the order items
                $OrderItems = Order_Product::where('order_id' , $TheOrder->id)->get();
                //Clear the Cart
                $TheCart = Cart::where('user_id' , $TheOrder->user_id)->where('status' , 'active')->whereDate('created_at' , Carbon::today())->get();
                $TheCart->map(function($item){
                  $item->update(['status' => 'purchased']);
                });
                //Update the order to the new information
                $TheOrder->update([
                  'status' => 'Order received',
                  'is_paid' => 'no',
                  'payment_method' => 'Payment On Collection'
                ]);
                return view('orders.checkout.thank-you' , compact('TheOrder' , 'OrderItems'));
              }else{
                return back()->withError('You Can\'t Pay on Collection on Shipping Orders!');
              }
            }
          }
          //Normal Payment Here
          $ProductsListObject = Order_Product::where('order_id' , $TheOrder->id)->get();
          $ProductsListArray = $ProductsListObject->map(function($item){
            return "Title: ".$item->Product->title." | ID: ".$item->product_id." | Quantity: ".$item->qty;
          });
            $GetPaymentMethod = Payment_Method::where('code_name' , $r->payment_method)->first();
            $OrderTotalAddition = ($TheOrder->final_total * $GetPaymentMethod->percentage_fee) / 100;
            $OrderFixedFee = $GetPaymentMethod->fixed_fee;
            $OrderFinalTotal = $TheOrder->final_total + $OrderTotalAddition + $OrderFixedFee;
            $payment = Mollie::api()->payments->create([
              "amount" => [
                  "currency" => "$TheOrder->order_currency",
                  "value" => sprintf("%.2f",$OrderFinalTotal) // You must send the correct number of decimals, thus we enforce the use of strings
              ],
              "description" => "Order #$TheOrder->serial_number",
              "locale" => "$TheOrder->lang"."_us",
              "method" => "$r->payment_method",
              "billingEmail" => "$TheOrder->email",
              "metadata" => [
                  'customer_name' => $TheOrder->first_name .' '.$TheOrder->last_name,
                  'customer_id' => 'cst_'.$r->user_id,
                  'products_list' => $ProductsListArray
              ],
              "redirectUrl" => route('order.success' , ['id' => $TheOrder->id])
              ]);
              //Update the order with mollie id and status
              $TheOrder->update([
                'payment_method' => $payment->method,
                'status' => 'Order received',
                'payment_id' => $payment->id,
                'is_paid' => $payment->status
              ]);
              // redirect customer to Mollie checkout page
              return redirect($payment->getCheckoutUrl(), 303);
        }else{
          abort(403);
        }
        abort(404);
      }
    }
  }
  public function orderSuccess(Request $r){
    if(auth()->check()){$UserId = auth()->user()->id;}else{$UserId = Cookie::get('guest_id');}
    //Get the Payment ID
    $TheOrder = Order::where('id',$r->id)->first();
    if($TheOrder){
      if($TheOrder->user_id == $UserId){
        $OrderItems = Order_Product::where('order_id' , $TheOrder->id)->get();
        $ThePayment = Mollie::api()->payments->get($TheOrder->payment_id);
        //Check the Payment Status
        $TheOrder->update(['is_paid' => $ThePayment->status]);
        $TheCart = Cart::where('user_id' , $TheOrder->user_id)->where('status' , 'active')->whereDate('created_at' , Carbon::today())->get();
        if($ThePayment->status != 'failed'){
            //Clear the cart
          $TheCart->map(function($item){
            $item->update(['status' => 'purchased']);
          });
          //Mail The User
          Mail::to($TheOrder->email)->send(new OrderReceiptMail($TheOrder));
        }else{
          $TheOrder->update(['status' => 'Waiting for payment']);
          //Add The Items Back to inventory
          $TheCart->map(function($item){
            $item->Product->update([
              'inventory' => ($item->Product->inventory - $item->qty),
              'fake_inventory' => ($item->Product->fake_inventory - $item->qty),
            ]);
          });
          //Add The Coupon Back
          if(isset($TheCart->first()->applied_coupon)){
            $TheCoupon = Coupoun::where('coupoun_code' , $TheCart->first()->applied_coupon)->first();
            $TheCoupon->amount = $TheCoupon->amount + 1;
            $TheCoupon->save();
            //Delete The Usage Record
            Coupoun_User::where('user_id' , auth()->user()->id)->where('coupoun_id' , $TheCoupon->id)->delete();
          }
          Mail::to($TheOrder->email)->send(new OrderFailedMail($TheOrder));

        }
      return view('orders.checkout.thank-you' , compact('TheOrder' , 'OrderItems'));
      }else{
        $TheOrder->update(['status' => 'Wrong User']);
        abort(403);
      }
    }else{
      abort(404);
    }

  }




  //Admin Only Methods
  public function getHome(){
    $Orders = Order::latest()->get();
    return view('admin.orders.index' , compact('Orders'));
  }
  public function getSingleOrder($id){
    $TheOrder = Order::findOrFail($id);
    return view('admin.orders.single' , compact('TheOrder'));
  }
  public function updateOrderStatus(Request $r, $id){
    //Find The Order
    $TheOrder = Order::findOrFail($id);
    if($TheOrder){
        //Vlidate the Request
        $Rules = [
          'order_status' => 'required',
          'tracking_link' => 'nullable|url'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
          return back()->withErrors($validator->errors()->all());
        }else{
          //Updat the Order
          $TheOrder->update([
            'status' => $r->order_status,
            'tracking_link' => $r->tracking_link
          ]);
          //Send an Email to The User
          Mail::to($TheOrder->email)->send(new OrderStatusUpdateMail($TheOrder));
          return back()->withSuccess('Order Updated Successfully');
        }
    }else{
      return back()->withErrors('Order is Not Available');
    }

  }
}
