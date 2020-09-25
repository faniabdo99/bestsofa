<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class OrderInvoiceMail extends Mailable{
    use Queueable, SerializesModels;
    public $EmailData;
    public $TheInvoice;
    public function __construct($EmailData,$TheInvoice){
      $this->EmailData = $EmailData;
        $this->TheInvoice = $TheInvoice;
    }

    public function build(){
        return $this->markdown('mails/orders/order-invoice-mail')->subject('Your Order Invoice - UK Fashion Shop')->attachData($this->TheInvoice,$this->EmailData->serial_number.'.pdf');
    }
}
