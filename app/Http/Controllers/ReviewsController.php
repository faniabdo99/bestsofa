<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Review;
class ReviewsController extends Controller{
    public function postReview(Request $r){
      //Validate The Request
      $Rules = [
        'product_id' => 'required',
        'rate' => 'required',
        'review' => 'required'
      ];
      $validator = Validator::make($r->all() , $Rules);
      if($validator->fails()){
        return back()->withErrors($validator->errors()->all());
      }else{
        //Check if the user already reviewed this product
        $TheReview = Review::where('user_id',auth()->user()->id)->where('product_id',$r->product_id)->first();
        if($TheReview){
          $TheReview->update(['review' => $r->review , 'rate' => $r->rate]);
          return back()->withSuccess(__('controllers.review_updated'));
        }else{
          //Create the review
          $ReviewData = $r->all();
          $ReviewData['user_id'] = auth()->user()->id;
          Review::create($ReviewData);
          return back()->withSuccess(__('controllers.review_thanks'));
        }
      }
    }
}
