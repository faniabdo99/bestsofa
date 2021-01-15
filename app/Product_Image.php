<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Product_Image extends Model{
    protected $guarded = [];
        public function getImagePathAttribute(){
           return url('storage/app/images/products/gallery').'/'.$this->image; 
        }
}
