@component('mail::message')
# Order Failed
We are sorry to tell you that the payment has failed, You may try again anytime you want<br>
In case you are a registered user, You can find all your orders under your account page and try again there
@component('mail::button', ['url' => route('checkout.payment' , $TheOrder->id)])
Try Payment Again
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
