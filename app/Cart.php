<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Cart extends Model{
    protected $guarded = [];
    public function Product(){
        return $this->belongsTo(Product::class);
    }
    public function getTotalPriceAttribute(){
        return $this->Product->final_price * $this->qty;
    }
}
