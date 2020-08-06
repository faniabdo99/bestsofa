<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuestionAboutProduct extends Mailable
{
    use Queueable, SerializesModels;
    public $EmailData;
    public function __construct($EmailData){
        $this->EmailData = $EmailData;
    }
    public function build()
    {
        return $this->markdown('mails/products/question-about-product')
                    ->subject('Question About Product | UK Fashion Shop');

    }
}
