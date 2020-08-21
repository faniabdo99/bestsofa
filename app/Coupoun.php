<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Coupoun extends Model{
    protected $guarded = [];
    public function getDiscountValueAttribute(){
      if($this->discount_type == 'percent'){
        return $this->discount_amount;
      }else{
        $PriceTo = session()->has('currency') ? session()->get('currency') : 'EUR';
        return convertCurrency($this->discount_amount , 'EUR' , $PriceTo);
      }
    }
}
