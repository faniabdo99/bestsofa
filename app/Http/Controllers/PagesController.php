<?php
namespace App\Http\Controllers;
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
}
