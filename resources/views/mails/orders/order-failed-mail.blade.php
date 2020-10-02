@component('mail::message')
# @lang('mails.orders.order_failed')
@lang('mails.orders.order_failed_first_paragraph')<br>
@lang('mails.orders.order_failed_second_paragraph')
@component('mail::button', ['url' => route('checkout.payment' , $TheOrder->id)])
@lang('mails.orders.order_failed_try_payment_again')
@endcomponent
@lang('mails.mails.thanks'),<br>
{{ config('app.name') }}
@endcomponent
