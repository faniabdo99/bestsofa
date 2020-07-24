<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class AdminController extends Controller{
    public function getHome(){
      $TotalProductsCount = Product::where('status' , 'Available')->count();
      $TotalUsersCount = Product::where('status' , 'Available')->count();
      return view('admin.index' , compact('TotalProductsCount' , 'TotalUsersCount'));
    }
}
