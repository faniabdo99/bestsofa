@component('mail::message')
# @lang('mails/orders.order_receipt')
@lang('mails/orders.order_receipt_first_paragraph') <br>
<p><b>@lang('mails/orders.order_receipt_serial_number'): </b> {{$EmailData->serial_number}}</p><br>
<p><b>@lang('mails/orders.order_receipt_order_total'): </b> {{$EmailData->total.getCurrency()['symbole']}}</p><br>
<p><b>@lang('mails/orders.order_receipt_payment_method'): </b> {{$EmailData->PaymentMethodData['name']}}</p><br>
<p>@lang('mails/orders.order_receipt_last_paragraph')</p>
@component('mail::button', ['url' => 'https://ukfashionshop.be'])
@lang('mails/mails.sender')
@endcomponent

@lang('mails/mails.thanks'),<br>
{{ config('app.name') }}
@endcomponent
