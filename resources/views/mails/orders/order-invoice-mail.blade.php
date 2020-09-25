@component('mail::message')
# Order Invoice
Hello, {{$EmailData->first_name}}, Please find the attached invoice file for your order in UK Fashion Shop.<br>
<br>
<b>Order ID:</b> {{$EmailData->serial_number}}<br>
<b>Total:</b> {{$EmailData->total}}€<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
