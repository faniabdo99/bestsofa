<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App;
//Models
use App\Product;
class HomeController extends Controller{
    public function getHome(){
        $PromotedProducts = Product::where('is_promoted' , 1)->where('status' , '!=' , 'Invisible')->latest()->limit(15)->get();
        return view('home' , compact('PromotedProducts'));
    }

    public function changeLang($locale){
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
