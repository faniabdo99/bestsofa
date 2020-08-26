<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Cookie;
use Carbon\Carbon;
//Models
use App\Cart;
use App\ShippingCost;
class OrdersController extends Controller{
  public function getCheckoutPage(){
    //Get User Cart Items
    if(auth()->check()){$UserId = auth()->user()->id;}else{$UserId = Cookie::get('guest_id');}
    $CartItems = Cart::where('user_id' , $UserId)->where('status','active')->whereDate('created_at' , Carbon::today())->get();
    $CartSubTotalArray = $CartItems->map(function($item) {
        return (str_replace(['€' , '£'] , '' ,$item->Product->final_price) * $item->qty);
    });
    $CartTaxArray = $CartItems->map(function($item) {
        return ($item->Product->tax_amount * $item->qty);
    });
    $CartTax = $CartTaxArray->sum();
    $Total = $CartSubTotalArray->sum();
    //Check id there is a coupon code applied
    $CouponDiscount = null;
    if(isset($CartItems->first()->applied_coupon)){//There is an applied coupon
        $CouponData = explode('-',$CartItems->first()->coupon_amount );
        // $CouponDiscountType = $CouponData[1];
        // $CouponDiscountAmount = $CouponData[0];
        if($CouponData[1] == 'fixed'){
            $CouponDiscount = $CouponData[0];
        }elseif($CouponData[1] == 'percent'){
            $CouponDiscount = ($Total * $CouponData[0]) / 100;
        }else{
            $CouponDiscount = $CouponData[0];
        }
    }
    $SubTotal = ($CartSubTotalArray->sum() + $CartTax) - $CouponDiscount;
    $ShippingCostCountries = ShippingCost::pluck('country_name')->unique();

    return view('orders.checkout' , compact('CartItems','Total','CartTax','ShippingCostCountries'));
  }
    public function testOrder(){
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "20.00" // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Order #12345",
            "locale" => "en_us",
            "method" => "creditcard",
            "billingEmail" => "faniabdo99@gmail.com",
            "metadata" => [
                'customer_name' => 'Abod Fani',
                'customer_id' => '224',
                'products_id' => [1,5,46,3]
            ],
            "redirectUrl" => route('order.success')
        ]);
        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }
    public function orderSuccess(Request $r){
        $payment = Mollie::api()->payments->get('tr_uSsTcfzhpf');
        dd($payment->metadata->customer_name);
    }
}
