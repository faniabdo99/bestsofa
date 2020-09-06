<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Order extends Model{
    protected $guarded = [];
    public function getTotalAttribute(){
        $PriceTo = session()->has('currency') ? session()->get('currency') : 'EUR';
        return convertCurrency($this->total_amount , 'EUR' , $PriceTo);
    }
    public function getTotalTaxAttribute(){
        if($this->vat_number && $this->is_vat_valid == 'yes'){
            return 0;
        }else{
            $PriceTo = session()->has('currency') ? session()->get('currency') : 'EUR';
            return convertCurrency($this->total_tax_amount , 'EUR' , $PriceTo);
        }
    }
    public function getTotalShippingAttribute(){
        $PriceTo = session()->has('currency') ? session()->get('currency') : 'EUR';
        if($this->vat_number && $this->is_vat_valid == 'yes'){
            return convertCurrency(($this->total_shipping_cost) , 'EUR' , $PriceTo);
        }else{
            return convertCurrency(($this->total_shipping_cost+$this->total_shipping_tax) , 'EUR' , $PriceTo);
        }
    }
    public function getFinalTotalAttribute(){
        return $this->total + $this->total_tax + $this->total_shipping;
    }
    public function Items(){
        return Order_Product::where('order_id' , $this->id)->get();
    }
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
