<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Str;
use App\Category_local;
class Category extends Model{
    protected $guarded = [];

    public function getShortDescriptionAttribute(){
        return Str::limit($this->description , 60);
    }
    public function getLocalTitleAttribute(){
        $CurrentLang = app()->getLocal() ?? 'en';
        //Get The Title From Localized Table
        $LocalizedRow = Category_local::where('category_id' , $this->id)->where('lang_code' , $CurrentLang)->first();
        if($LocalizedRow != null){
            return $LocalizedRow->title_value;
        }else{
            return $this->title;
        }
    }
    public function Product(){
        return $this->hasMany(Product::class , 'category_id');
    }
}
