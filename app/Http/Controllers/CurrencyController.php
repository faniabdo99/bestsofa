<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller{
    public function setCurrency($currency , $CurrencyCode){
      session(['currency' => $currency]);
      session(['currency_code' => $CurrencyCode]);
      return back();
    }
}
