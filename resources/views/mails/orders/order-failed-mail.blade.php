@component('mail::message')
# Order Failed
We are sorry to tell you that the payment have failed, You may try again anytime you want<br>
In case you are a registered user, You can find all your orders under your account page and try again there
@component('mail::button', ['url' => 'https://ukfashionshop.be'])
UK Fashion Shop
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
