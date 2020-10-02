@component('mail::message')
# @lang('mails.orders.order_invoice')
@lang('mails.mails.hello'), {{$EmailData->first_name}}, @lang('mails.orders.order_invoice_first_paragraph')<br>
<br>
<b>@lang('mails.orders.order_invoice_order_id'):</b> {{$EmailData->serial_number}}<br>
<b>@lang('mails.orders.order_invoice_total'):</b> {{$EmailData->total}}€<br>
@lang('mails.mails.thanks'),<br>
{{ config('app.name') }}
@endcomponent
