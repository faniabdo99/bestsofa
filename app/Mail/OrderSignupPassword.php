<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class OrderSignupPassword extends Mailable{
    public $EmailData;
    public function __construct($EmailData){
        $this->EmailData = $EmailData;
    }
    public function build(){
        return $this->markdown('mails/users/order-signup-password')->subject('Welcome to UK Fashion Shop');
    }
}
