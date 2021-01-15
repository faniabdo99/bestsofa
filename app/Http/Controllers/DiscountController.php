<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use App\Discount;
class DiscountController extends Controller{
    public function getHome(){
        $Discounts = Discount::latest()->get();
        return view('admin.discount.index',compact('Discounts'));
    }
    public function getNew(){
        return view('admin.discount.new');
    }
    public function postNew(Request $r){
        //Validate request 
        $Rules = [
            'title' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
            'valid_until' => 'required'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }else{
            //Check if Discount More Than 100%
            if($r->type == 'percent' && $r->amount > 100){
                return back()->withErrors("The Discount is More Than 100% !");
            }
            $DiscountData = $r->all();
            $DiscountData['valid_until'] = Carbon::createFromFormat('Y-m-d', $r->valid_until)->toDateTimeString();
            if($DiscountData['valid_until'] < Carbon::today()){
                return back()->withErrors("The Validaty Date Has Already Passed");
            }
            Discount::create($DiscountData);
            return redirect()->route('admin.discount.home')->withSuccess('Discount Added Successfully');
        }
    }
    public function getEdit($id){
        $TheDiscount = Discount::findOrFail($id);
        return view('admin.discount.edit' , compact('TheDiscount'));
    }
    public function postEdit(Request $r , $id){
        //Validate request 
        $Rules = [
            'title' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
            'valid_until' => 'required'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }else{
            //Check if Discount More Than 100%
            if($r->type == 'percent' && $r->amount > 100){
                return back()->withErrors("The Discount is More Than 100% !");
            }
            $DiscountData = $r->all();
            $DiscountData['valid_until'] = Carbon::createFromFormat('Y-m-d', $r->valid_until)->toDateTimeString();
            if($DiscountData['valid_until'] < Carbon::today()){
                return back()->withErrors("The Validaty Date Has Already Passed");
            }
            Discount::findOrFail($id)->update($DiscountData);
            return redirect()->route('admin.discount.home')->withSuccess('Discount Updated Successfully');
        }
    }
    public function delete(Request $r){
        Discount::findOrFail($r->item_id)->delete();
        return response('Discount Deleted Successfully' , 200);
    }
}
