@component('mail::message')
# Your Order Receipt
Thank you for your order at UK Fashion Shop, Please find the order information below <br>
<p><b>Order Serial Number: </b> {{$EmailData->serial_number}}</p><br>
<p><b>Order Total: </b> {{$EmailData->total.getCurrency()['symbole']}}</p><br>
<p><b>Payment Method: </b> {{$EmailData->PaymentMethodData['name']}}</p><br>
<p>if you already have an account, you can view your orders from your account page at UK Fashion Shop, Otherwise you can track your order status in the order tracking page.</p>
@component('mail::button', ['url' => 'https://ukfashionshop.be'])
UK Fashion Shop
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
