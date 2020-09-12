<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Invoice extends Model{
    protected $guarded = [];
    protected $dates = ['due_date'];
}
