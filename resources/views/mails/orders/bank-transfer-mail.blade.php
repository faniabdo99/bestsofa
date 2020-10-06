@component('mail::message')
<div style="padding:40px;">
    <h1>@lang('mails/orders.bank_transfer')</h1>
    <p>@lang('mails/orders.bank_transfer_first_paragraph')</p>
    <p><b style="margin-right:40px;">@lang('mails/orders.bank_transfer_beneficiary')</b> @lang('mails/orders.bank_transfer_global_trading')</p>
    <p><b style="margin-right:40px;">@lang('mails/orders.bank_transfer_iban')</b> @lang('mails/orders.bank_transfer_iban_number')</p>
    <p><b style="margin-right:40px;">@lang('mails/orders.bank_transfer_bic')</b> @lang('mails/orders.bank_transfer_bic_number')</p>
    <p><b style="margin-right:40px;">@lang('mails/orders.bank_transfer_amount')</b> {{formatPrice($EmailData->total + $EmailData->total_tax + $EmailData->total_shipping).getCurrency()['symbole']}}</p>
    <p><b style="margin-right:40px;">@lang('mails/orders.bank_transfer_reference')</b> <span style="border:1px solid green;padding:4px;border-radius:4px;">{{$EmailData->serial_number}}</span></p>
    <p>@lang('mails/orders.bank_transfer_enter_reference') <b>@lang('mails/orders.bank_transfer_payment_reference')</b> @lang('mails/orders.bank_transfer_reference_text')</p>
    <p><b>@lang('mails/orders.bank_transfer_please_note'):</b> @lang('mails/orders.bank_transfer_last_paragraph')</p>
    @lang('mails/mails.thanks'),<br>
    @lang('mails/mails.sender')
  </div>
  @endcomponent
