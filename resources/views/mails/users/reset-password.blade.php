@component('mail::message')
# @lang('mails/users.reset_password')
@lang('mails/mails.hello'), {{$email_data->name}} , <br>
@lang('mails/users.reset_password_first_paragraph') <br>
@lang('mails/users.reset_password_second_paragraph')
@component('mail::button', ['url' => route('reset.finalStep' , $email_data->code)])
@lang('mails/users.reset_password')
@endcomponent

@lang('mails/mails.thanks'),<br>
{{ config('app.name') }}
@endcomponent
