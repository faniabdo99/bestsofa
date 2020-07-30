<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    protected $guarded = [];
    //Relations Methods 
    public function Category(){
        return $this->belongsTo(Category::class)->withDefault([
            'title' => 'Deleted Category',
            'slug' => 'deleted-category',
            'image' => 'category.png',
            'description' => 'Deleted Category'
        ]);
    }

    //Non-Relation Methods
    public function getInventoryValueAttribute(){
        if($this->inventory == 0){
            return 9999999999;
        }else{
            return $this->inventory;
        }
    }
    public function getIsActiveAttribute(){
        if($this->status == 'Available'){
            return true;
        }else{
            return false;
        }
    }
    public function getLocalTitleAttribute(){
        $SiteLang = \Lang::locale() ?? 'en';
        if($SiteLang == 'en'){
            return $this->title;
        }else{
            return Product_Local::where('product_id' , $this->id)->where('lang_code' , $SiteLang)->first()->title_value;
        }
    }
    public function getLocalSlugAttribute(){
        $SiteLang = \Lang::locale() ?? 'en';
        if($SiteLang == 'en'){
            return $this->slug;
        }else{
            return Product_Local::where('product_id' , $this->id)->where('lang_code' , $SiteLang)->first()->slug_value;
        }
    }
    public function getLocalDescriptionAttribute(){
        $SiteLang = \Lang::locale() ?? 'en';
        if($SiteLang == 'en'){
            return $this->description;
        }else{
            return Product_Local::where('product_id' , $this->id)->where('lang_code' , $SiteLang)->first()->description_value;
        }
    }
    public function getLocalBodyAttribute(){
        $SiteLang = \Lang::locale() ?? 'en';
        if($SiteLang == 'en'){
            return $this->body;
        }else{
            return Product_Local::where('product_id' , $this->id)->where('lang_code' , $SiteLang)->first()->body_value;
        }
    }
    public function getMainImageAttribute(){
        return url('storage/app/images/products').'/'.$this->image;
    }
    public function GalleryImages(){
        return $this->hasMany(Product_Image::class);
    }
}
