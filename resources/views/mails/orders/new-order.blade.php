@component('mail::message')
# @lang('mails/orders.new_order')
@lang('mails/orders.first_paragraph') <br><br>
@lang('mails/orders.second_paragraph')
<br><br>
@lang('mails/mails.thanks'),<br>
{{ config('app.name') }}
@endcomponent
