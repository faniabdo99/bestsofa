<div style="padding:40px;">
  <h1>@lang('mails/pages.contact_us')</h1>
  <p>@lang('mails/pages.contact_us_paragraph')<br>
  <b>{{$EmailData['subject']}}</b><br>
  {{$EmailData['message']}}
  <br>
  <b style="margin-top:50px;display:block;">{{$EmailData['name']}}</b> {{$EmailData['email']}} <br>
  {{$EmailData['country']}} - {{$EmailData['phone_number']}}
  </p>
  @lang('mails/mails.thanks'),<br>
  @lang('mails/mails.sender')
</div>
