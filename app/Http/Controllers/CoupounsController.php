<?php
namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Cart;
use App\Coupoun;
use App\Coupoun_User;
class CoupounsController extends Controller{
    public function getHome(){
        $Coupouns = Coupoun::latest()->get();
        return view('admin.coupoun.index',compact('Coupouns'));
    }
    public function getNew(){
        return view('admin.coupoun.new');
    }
    public function postNew(Request $r){
        //Validate request
        $Rules = [
            'coupoun_code' => 'required|unique:coupouns',
            'discount_type' => 'required',
            'discount_amount' => 'required|numeric',
            'amount' => 'required|numeric'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }else{
            if($r->discount_type == 'percent' && $r->discount_amount > 100){
                return back()->withErrors("The Coupon Discount is More Than 100% !");
            }
            $CouponData = $r->all();
            Coupoun::create($CouponData);
            return redirect()->route('admin.coupoun.home')->withSuccess('Coupon Added Successfully');
        }
    }
    public function getEdit($id){
        $TheCoupoun = Coupoun::findOrFail($id);
        return view('admin.coupoun.edit' , compact('TheCoupoun'));
    }
    public function postEdit(Request $r , $id){
        //Validate request
        $Rules = [
            'coupoun_code' => 'required',
            'discount_type' => 'required',
            'discount_amount' => 'required|numeric',
            'amount' => 'required|numeric'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }else{
            if($r->discount_type == 'percent' && $r->discount_amount > 100){
                return back()->withErrors("The Coupon Discount is More Than 100% !");
            }
            $CouponData = $r->all();
            Coupoun::findOrFail($id)->update($CouponData);
            return redirect()->route('admin.coupoun.home')->withSuccess('Coupon Updated Successfully');
        }
    }
    public function delete(Request $r){
        Coupoun::findOrFail($r->item_id)->delete();
        return response('Coupoun Deleted Successfully' , 200);
    }

    //Non-Admin Methods
    public function applyCoupon(Request $r){
        //Check if the user is logged in ...
        if(auth()->check()){
            $UserId = auth()->user()->id;
            $CouponCode = $r->coupuon_code;
            //Get the Coupon
            $TheCoupon = Coupoun::where('coupoun_code' , $CouponCode)->where('amount','>','0')->first();
            if(!$TheCoupon){
                return back()->withErrors('This Coupon Code is Invalid !');
            }
            //Check if the user already used this coupon
            $isUsed = Coupoun_User::where('user_id' , $UserId)->where('coupoun_id' , $TheCoupon->id)->get();
            if($isUsed->count() == 0 ){ //User Never Used This Coupon
                //Apply The Discount
                $UserCart = Cart::where('user_id' , $UserId)->where('status' ,'active')->whereDate('created_at' , Carbon::today())->get();
                if(isset($UserCart->first()->applied_coupon)){
                  return back()->withErrors('You Already Using a Coupon!');
                }
                $CartSubTotalArray = $UserCart->map(function($item) {
                    return ($item->Product->final_price * $item->qty);
                });
                //Check if coupon is bigger than the actual cart
                if($TheCoupon->discount_type == 'fixed'){
                    if($CartSubTotalArray->sum() < $TheCoupon->DiscountValue){
                        return back()->withErrors('The Coupon Value is Bigger Than the Order Value !');
                    }
                }
                if($UserCart){
                    $UserCart->map(function($item) use ($TheCoupon){
                        $item->update([
                            'applied_coupon' => $TheCoupon->coupoun_code,
                            'coupon_amount'  => $TheCoupon->DiscountValue . '-' .$TheCoupon->discount_type
                        ]);
                    });
                    //Set a Record in the Database
                    Coupoun_User::create([
                        'user_id' => $UserId,
                        'coupoun_id' => $TheCoupon->id
                    ]);
                    //Decrease The Coupon Amount By One
                    $TheCoupon->amount = $TheCoupon->amount - 1;
                    $TheCoupon->save();
                    return back()->withSuccess('Coupon ' .$TheCoupon->coupoun_code.' Has Been Applied !');
                }else{
                    return back()->withErrors('You Don\'t Have Any Products in Your Cart !');
                }


            }else{
                return back()->withErrors('You Can\'t Use This Coupon Again !');
            }
        }else{
            abort(403);
        }
    }
}
