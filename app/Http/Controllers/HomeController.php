<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cookie;
//Models 
use App\Product;
class HomeController extends Controller{
    public function getHome(){
        $PromotedProducts = Product::where('is_promoted' , 1)->where('status' , '!=' , 'Invisible')->latest()->limit(10)->get();
        return view('home' , compact('PromotedProducts'));
    }
}
