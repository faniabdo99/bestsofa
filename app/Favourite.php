<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Favourite extends Model{
    protected $guarded = [];
    public function User(){
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Deleted User',
        ]);
    }
    public function Product(){
        return $this->belongsTo(Product::class)->withDefault([
            'title' => __('models.deleted_product'),
        ]);
    }
}
