@component('mail::message')
# @lang('mails.mails.welcome')
@lang('mails.mails.welcome'), @lang('mails.users.one_step_behind') <br>
@lang('mails.users.click_the_link')
@component('mail::button', ['url' => route('setPassword.get' , $EmailData->id)])
@lang('mails.users.set_your_password')
@endcomponent
@lang('mails.mails.thanks'),<br>
{{ config('app.name') }}
@endcomponent
