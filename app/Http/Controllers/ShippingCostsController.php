<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\ShippingCost;
class ShippingCostsController extends Controller{
  public function getHome(){
      $SCData = ShippingCost::latest()->get();
      return view('admin.shipping-costs.index',compact('SCData'));
  }
  public function getNew(){
      return view('admin.shipping-costs.new');
  }
  public function postNew(Request $r){
      //Validate request
      $Rules = [
          'shipping_method' => 'required',
          'country_name' => 'required',
          'weight_from' => 'required|numeric',
          'weight_to' => 'required|numeric',
          'cost' => 'required|numeric'
      ];
      $validator = Validator::make($r->all() , $Rules);
      if($validator->fails()){
          return back()->withErrors($validator->errors()->all());
      }else{
          $SCData = $r->all();
          ShippingCost::create($SCData);
          return redirect()->route('admin.shippingCosts.home')->withSuccess('Data Added Successfully');
      }
  }
  public function getEdit($id){
      $TheSCData = ShippingCost::findOrFail($id);
      return view('admin.shipping-costs.edit' , compact('TheSCData'));
  }
  public function postEdit(Request $r , $id){
      //Validate request
      $Rules = [
        'shipping_method' => 'required',
        'country_name' => 'required',
        'weight_from' => 'required|numeric',
        'weight_to' => 'required|numeric',
        'cost' => 'required|numeric'
      ];
      $validator = Validator::make($r->all() , $Rules);
      if($validator->fails()){
          return back()->withErrors($validator->errors()->all());
      }else{
          $SCData = $r->all();
          ShippingCost::findOrFail($id)->update($SCData);
          return redirect()->route('admin.shippingCosts.home')->withSuccess('Data Updated Successfully');
      }
  }
  public function delete(Request $r){
      ShippingCost::findOrFail($r->item_id)->delete();
      return response('Data Deleted Successfully' , 200);
  }
  public function calculateShippingCost(request $r){
    //Validate the request
    $Rules = [
      'order_weight' => 'required|numeric',
      'country_name' => 'required'
    ];
    $ErrorMessages = [
      'order_weight.required' => 'Something is Wrong !',
      'order_weight.numeric' => 'Something is Wrong !',
      'country_name.required' => 'Plese Choose a Country from the list',
    ];
    $validator = Validator::make($r->all() ,$Rules,$ErrorMessages);
    if($validator->fails()){
      return response($validator->errors()->first(),500);
    }else{
      ///Do the calculations
      $ShippingCost = ShippingCost::where('country_name' , $r->country_name)->where('weight_from' , '<=' , $r->order_weight)->where('weight_to' , '>=',$r->order_weight)->first();
      if($ShippingCost){
        //Calculate Cost
        $ShippingTax = $ShippingCost->FinalCost * $r->cart_tax_avg;
        return response("This Order Shipping Cost to ".getCountryNameFromISO($ShippingCost->country_name)." is ".($ShippingCost->FinalCost+$ShippingTax).getCurrency()['symbole']);
      }else{
        return response("We Don\'t Have a Record For That Yet , Sorry" , 404);
      }
    }
  }
}
