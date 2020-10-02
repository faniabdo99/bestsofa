<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Cookie;
use Carbon\Carbon;
use App\Product;
use App\Cart;
use App\ShippingCost;
class CartController extends Controller{
    public function addItem(Request $r){
        $CartData = $r->all();
        //Check if there is a user id
        if(!$r->has('user_id')){
            //Check if there is a Cookie for it
            if(Cookie::has('guest_id')){
                $CartData['user_id'] = Cookie::get('guest_id');
            }else{
                Cookie::queue(Cookie::make('guest_id', md5(rand(1,500))));
                $CartData['user_id'] = Cookie::get('guest_id');
            }
        }
        //Check if the product viable
        $Product = Product::find($r->product_id);
        if(!$Product || $Product->inventory_value <= 0 || $Product->status == 'Sold Out' || $Product->status == 'Invisible'){
            return response( __('controllers.cart_item_not_available') , 404);
        }else{
            //Check the current cart
            $UserCart = Cart::where('user_id' , $CartData['user_id'])->where('product_id' , $r->product_id)->where('status','active')->whereDate('created_at' , Carbon::today())->first();
            if($UserCart){
                if($UserCart->qty >= $Product->inventory_value){
                      return response(__('controllers.cart_max_amount') .$Product->inventory_value  , 404);
                }
            }
            if($Product->inventory_value < $r->qty){
                 return response(__('controllers.cart_max_amount') .$Product->inventory_value  , 404);
            }elseif($Product->min_order > $r->qty){
                return response(__('controllers.cart_min_amount').$Product->min_order  , 404);
            }
            $CartData['qty'] = ($r->qty ? $r->qty : 1);
            $CurrentCart = Cart::where('product_id' , $CartData['product_id'])->where('user_id' , $CartData['user_id'])->whereDate('created_at' , Carbon::today())->where('status' , 'active')->first();
            if($CurrentCart){
                $CurrentCart->update(['qty' => $CurrentCart->qty + $CartData['qty']]);
                return __('controllers.cart_item_added');
            }else{
                $CartData['product_id'] = $Product->id;
                Cart::create($CartData);
                return __('controllers.cart_item_added');
            }
        }
    }
    public function deleteItem($CartId , $UserId){
        $CartItem = Cart::where('id' , $CartId)->where('user_id' , $UserId)->where('status' , 'active')->whereDate('created_at' , Carbon::today())->first();
        if($CartItem){
            $CartItem->update([
                'status' => 'deleted'
            ]);
            return redirect()->route('cart')->withSuccess(__('controllers.cart_item_deleted'));
        }else{
            return redirect()->route('cart')->withError(__('controllers.cart_item_doesnt_exist'));
        }
    }
    public function postUpdate(Request $r){
        //Get the cart item
        $CartItem = Cart::where('id' , $r->item_id)->where('user_id' , $r->user_id)->where('status' , 'active')->whereDate('created_at' , Carbon::today())->first();
        if($CartItem->Product->inventory_value < $r->qty){
            return response(__('controllers.cart_max_amount') .$CartItem->Product->inventory_value  , 404);
        }else{
            if($CartItem){
                $CartItem->update([
                    'qty' => $r->qty
                ]);
                return response(__('controllers.cart_value_updated'));
            }else{
                return response(__('controllers.cart_item_not_available') , 404);
            }
        }

    }
    public function getCartPage(){
        if(auth()->check()){$UserId = auth()->user()->id;}else{$UserId = Cookie::get('guest_id');}
        $CartItems = Cart::where('user_id' , $UserId)->where('status' , 'active')->whereDate('created_at' , Carbon::today())->get();
        $CartSubTotalArray = $CartItems->map(function($item) {
            return $item->Product->final_price * $item->qty;
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
        $SubTotal = ($CartSubTotalArray->sum()) - $CouponDiscount;
        $ShippingCostCountries = ShippingCost::pluck('country_name')->unique();
        return view('orders.cart' , compact('CartItems' , 'CartTax' , 'Total' ,'SubTotal','CouponDiscount' , 'ShippingCostCountries'));
    }
}
