<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderFailedMail extends Mailable{
    use Queueable, SerializesModels;
    public $TheOrder;
    public function __construct($TheOrder){
        $this->TheOrder = $TheOrder;
    }
    public function build()
    {
        return $this->markdown('mails/orders/order-failed-mail')->subject("Order Failed - Best Sofa");
    }
}
