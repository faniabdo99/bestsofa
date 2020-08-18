<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Cookie;
use Carbon\Carbon;
use App\Product;
use App\Cart;
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
            return response("This item is not available for sell right now" , 404);
        }else{
            if($Product->inventory_value < $r->qty){
                 return response("The Maximum Availabe Amount For Order is " .$Product->inventory_value  , 404);
            }
            $CartData['qty'] = ($r->qty ? $r->qty : 1);
            $CurrentCart = Cart::where('product_id' , $CartData['product_id'])->where('user_id' , $CartData['user_id'])->whereDate('created_at' , Carbon::today())->where('status' , 'active')->first();
            if($CurrentCart){
                $CurrentCart->update(['qty' => $CurrentCart->qty + $CartData['qty']]);
                return "Item Added to Cart";
            }else{
                $CartData['product_id'] = $Product->id;
                Cart::create($CartData);
                return "Item Added to Cart";
            }
        }
    }
    public function deleteItem($CartId , $UserId){
        $CartItem = Cart::where('id' , $CartId)->where('user_id' , $UserId)->where('status' , 'active')->whereDate('created_at' , Carbon::today())->first();
        if($CartItem){
            $CartItem->update([
                'status' => 'deleted'
            ]);
            return redirect()->route('cart')->withSuccess('Cart Item Deleted Successfully');
        }else{
            return redirect()->route('cart')->withError('This Cart Item Doesn\'t Exist');
        }
    }
    public function postUpdate(Request $r){
        //Get the cart item
        $CartItem = Cart::where('id' , $r->item_id)->where('user_id' , $r->user_id)->where('status' , 'active')->whereDate('created_at' , Carbon::today())->first();
        if($CartItem){
            $CartItem->update([
                'qty' => $r->qty
            ]);
            return response("Cart Value Updated");
        }else{
            return response("This cart item is not available" , 404);
        }
        
    }
    public function getCartPage(){
        if(auth()->check()){$UserId = auth()->user()->id;}else{$UserId = Cookie::get('guest_id');}
        $CartItems = Cart::where('user_id' , $UserId)->where('status' , 'active')->get();
        $CartSubTotalArray = $CartItems->map(function($item) {
            return ($item->Product->final_price * $item->qty);
        });
        $CartTaxArray = $CartItems->map(function($item) {
            return ($item->Product->tax_amount * $item->qty);
        });
        $CartTax = $CartTaxArray->sum();
        $SubTotal = $CartSubTotalArray->sum() + $CartTax;
        return view('orders.cart' , compact('CartItems' , 'CartTax' ,'SubTotal'));
    }
}
