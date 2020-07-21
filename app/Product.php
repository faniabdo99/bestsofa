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
}
