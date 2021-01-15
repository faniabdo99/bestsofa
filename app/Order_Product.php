<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Order_Product extends Model{
    protected $guarded = [];
    public function Product(){
      return $this->belongsTo(Product::class , 'product_id');
    }
}
