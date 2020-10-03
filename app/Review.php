<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Review extends Model{
    protected $guarded = [];
    public function User(){
      return $this->belongsTo(User::class , 'user_id')->withDefault([
        'name' => __('models.deleted_user')
      ]);
    }
}
