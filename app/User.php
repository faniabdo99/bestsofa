<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
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
}
