<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Order;
class AdminController extends Controller{
    public function getHome(){
      $TotalProductsCount = Product::where('status' , 'Available')->count();
      $TotalUsersCount = Product::where('status' , 'Available')->count();
      $LatestOrders = Order::where('status' , 'Processing')->limit(10)->get();
      return view('admin.index' , compact('TotalProductsCount' , 'TotalUsersCount','LatestOrders'));
    }
}
