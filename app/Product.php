<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Product extends Model{
    protected $guarded = [];
    //Relations Methods
    public function Category(){
        return $this->belongsTo(Category::class)->withDefault([
            'title' => __('models.deleted_category'),
            'slug' => 'deleted-category',
            'image' => 'category.png',
            'description' => __('models.deleted_category')
        ]);
    }

    //Non-Relation Methods
    public function getInventoryValueAttribute(){
      if($this->inventory < 5){
        return $this->inventory;
      }else{
        return intval($this->inventory/2);
      }
        // if($this->fake_inventory == 0){
        //     return $this->inventory;
        // }else{
        //     if($this->inventory > $this->fake_inventory){
        //         return $this->fake_inventory;
        //     }else{
        //         return $this->inventory;
        //     }
        // }
    }
    public function getIsActiveAttribute(){
        if($this->status == 'Available'){
            return true;
        }else{
            return false;
        }
    }
    public function getLocalTitleAttribute(){
        $SiteLang = app()->getLocale() ?? 'en';
        if($SiteLang == 'en'){
            return $this->title;
        }else{
            $GetLocalTitle = Product_Local::where('product_id' , $this->id)->where('lang_code' , $SiteLang)->first();
            if($GetLocalTitle){
              return $GetLocalTitle->title_value;
            }else{
              return $this->title;
            }
        }
    }
    public function getLocalSlugAttribute(){
          return $this->slug;
    }
    public function getLocalDescriptionAttribute(){
        $SiteLang = app()->getLocale() ?? 'en';
        if($SiteLang == 'en'){
            return $this->description;
        }else{
            $GetLocaleDesc =  Product_Local::where('product_id' , $this->id)->where('lang_code' , $SiteLang)->first();
            if($GetLocaleDesc){
              return $GetLocaleDesc->description_value;
            }else{
              return $this->description;
            }
        }
    }
    public function getLocalBodyAttribute(){
        $SiteLang = app()->getLocale() ?? 'en';
        if($SiteLang == 'en'){
            return $this->body;
        }else{
            $GetLocaleBody = Product_Local::where('product_id' , $this->id)->where('lang_code' , $SiteLang)->first();
            if($GetLocaleBody){
              return $GetLocaleBody->body_value;
            }else{
              return $this->body;
            }
        }
    }
    public function getMainImageAttribute(){
        return url('storage/app/images/products').'/'.$this->image;
    }
    public function GalleryImages(){
        return $this->hasMany(Product_Image::class);
    }
    public function LikedByUser(){
        if(auth()->check()){
            $isLiked = Favourite::where('user_id' , auth()->user()->id)->where('product_id' , $this->id)->count();
            if($isLiked != 0){
                return true;
            }else{
                return false;
            }
        }
    }
    public function HasDiscount(){
        if($this->discount_id){
            $TheDiscount = Discount::find($this->discount_id);
            if($TheDiscount && Carbon::parse($TheDiscount->valid_until) > Carbon::today()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function getFinalPriceAttribute(){
        if($this->discount_id){
            //Check if there is a discount on this product
            $TheDiscount = Discount::find($this->discount_id);
            if($TheDiscount && Carbon::parse($TheDiscount->valid_until) > Carbon::today()){
                //Check the type -_-
                if($TheDiscount->type == 'fixed'){
                    $ThePrice = $this->price - $TheDiscount->amount;
                }elseif($TheDiscount->type == 'percent'){
                    $TheDiscountAmount = ($this->price * $TheDiscount->amount) / 100;
                    $ThePrice = $this->price - $TheDiscountAmount;
                }
                $returnPrice = $ThePrice;
            }else{
                  $returnPrice = $this->price;
            }
        }else{
              $returnPrice = $this->price;
        }
        //Convert Currency if Needed
        $PriceTo = session()->has('currency') ? session()->get('currency') : 'EUR';
        return convertCurrency(formatPrice($returnPrice) , 'EUR' , $PriceTo);
    }
    public function getTaxAmountAttribute(){
        return formatPrice($this->final_price * $this->tax_rate);
    }
    public function getStatusClassAttribute(){
        $StatuesArray = [];
        if($this->status == 'Sold Out'){
            $StatuesArray['text'] = 'text-danger';
            $StatuesArray['background'] = 'bg-danger';
        }elseif($this->status == 'Available'){
            $StatuesArray['text'] = 'text-success';
            $StatuesArray['background'] = 'bg-success';
        }elseif($this->status == 'Pre-Order'){
            $StatuesArray['text'] = 'text-warning';
            $StatuesArray['background'] = 'bg-warning';
        }else{
            $StatuesArray['text'] = 'd-none';
            $StatuesArray['background'] = 'd-none';
        }
        return $StatuesArray;
    }
    public function Reviews(){
      return Review::where('product_id' , $this->id)->get();
    }
}
