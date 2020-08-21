<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ShippingCost extends Model{
    protected $guarded = [];
    public function getFinalCostAttribute(){
      $PriceTo = session()->has('currency') ? session()->get('currency') : 'EUR';
      return convertCurrency($this->cost , 'EUR' , $PriceTo);
    }
}
