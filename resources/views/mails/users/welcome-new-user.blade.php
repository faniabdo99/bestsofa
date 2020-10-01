<div style="padding:40px;">
  <h1>@lang('mails.users.welcome')</h1>
  <p>@lang('mails.mails.welcome'), <b>{{$EmailData['first_name']}}</b><br>
    @lang('mails.users.new_user_first_paragraph')</p>
  @component('mail::button', ['url' => route('account.activate' , $EmailData['code'])])
  @lang('mails.users.confirm')
  @endcomponent
  @lang('mails.users.thanks'),<br>
  @lang('mails.users.sender')
</div>
