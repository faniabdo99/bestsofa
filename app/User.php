<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
    use Notifiable;
    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getProfileImageAttribute(){
        $UserImageArray = explode('.' , $this->image);
        if($UserImageArray[0] == $this->id || $UserImageArray[0] == 'user'){
            return url('storage/app/images/users').'/'.$this->image;
        }else{
            return $this->image;
        }
    }
    public function AddressCompleted(){
        if(empty($this->country) || empty($this->zip_code) || empty($this->city) || empty($this->street_address) || empty($this->phone_number)){
            return false;
        }else{
            return true;
        }
    }
    public function LikedProducts(){
        return Favourite::where('user_id' , $this->id)->get();
    }
    public function Orders(){
        return Order::where('user_id' , $this->id)->get();
    }
    public function getNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }
    public function Bought($ProductId){
      $UserOrders = Order_Product::where('user_id' , $this->id)->where('product_id' , $ProductId)->count();
      if($UserOrders >= 1){
        return true;
      }else{
        return false;
      }
    }
}
