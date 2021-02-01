<?php
namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
class PagesController extends Controller{
    public function getAboutUs(){
        return view('static.about');
    }
    public function getPrivacyPolicy(){
        return view('static.privacy-policy');
    }
    public function getTOC(){
        return view('static.toc');
    }

    public function getOffer(Request $req){
        if($req->filter==2)
            $Products = Product::where("discount_id","<>","NULL")->orderBy("price" , 'DESC')->get();
        else
            $Products = Product::where("discount_id","<>","NULL")->orderBy("price" , 'ASC')->get();

        return view('products.offer',compact('Products' ));
    }
}
