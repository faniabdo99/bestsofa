<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
class OrdersController extends Controller{
    public function testOrder(){
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "20.00" // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Order #12345",
            "locale" => "en_us",
            "method" => "creditcard",
            "billingEmail" => "faniabdo99@gmail.com",
            "metadata" => [
                'customer_name' => 'Abod Fani',
                'customer_id' => '224',
                'products_id' => [1,5,46,3]
            ],
            "redirectUrl" => route('order.success')
        ]);
        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }
    public function orderSuccess(Request $r){
        $payment = Mollie::api()->payments->get('tr_uSsTcfzhpf');
        dd($payment->metadata->customer_name);
    }
}
