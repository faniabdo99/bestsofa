<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Invoice extends Model{
    protected $guarded = [];
    protected $dates = ['due_date'];
    public function getPaymentMethodDataAttribute(){
        $PaymentMethod = Payment_Method::where('code_name' , $this->payment_method)->first();
        if($PaymentMethod){
            return [
            'code_name' => $PaymentMethod->code_name,
            'name' => $PaymentMethod->name
        ];
        }else{
            return [
                'code_name' => 'N/A',
                'name' => 'N/A'
            ];
        }
    }
}
