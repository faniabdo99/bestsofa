<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//Models 
use App\Product;
class HomeController extends Controller{
    public function getHome(){
        $PromotedProducts = Product::where('is_promoted' , 1)->latest()->limit(10)->get();
        return view('home' , compact('PromotedProducts'));
    }
}
