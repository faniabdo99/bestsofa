<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Coupoun;
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
            'coupoun_code' => 'required',
            'discount_type' => 'required',
            'discount_amount' => 'required|numeric',
            'amount' => 'required|numeric'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }else{
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
            $CouponData = $r->all();
            Coupoun::findOrFail($id)->update($CouponData);
            return redirect()->route('admin.coupoun.home')->withSuccess('Coupon Updated Successfully');
        }
    }
    public function delete(Request $r){
        Coupoun::findOrFail($r->item_id)->delete();
        return response('Coupoun Deleted Successfully' , 200);
    }
}
