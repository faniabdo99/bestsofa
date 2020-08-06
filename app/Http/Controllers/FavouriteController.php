<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Favourite;
class FavouriteController extends Controller{
    public function ToggleFavourite(Request $r){
        //Validate the request 
        $Rules = [
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return response("Something Went Wrong , We Are Sorry !" , 403);
        }else{
            //Check if the record exists
            $FavRecord = Favourite::where('user_id' , $r->user_id)->where('product_id' , $r->product_id)->first();
            if($FavRecord == null){
                //Add a Like
                Favourite::create($r->all());
                return response("Product Added to Wishlist!");
            }else{
                //Remove the Like
                $FavRecord->delete();
                return response("Product Removed from Wishlist!");

            }
        }
    }
}
