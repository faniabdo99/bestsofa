<div style="padding:40px;">
  <h1>@lang('mails.pages.contact_email_received')</h1>
  <p>@lang('mails.pages.contact_email_received_paragraph')<br>
  <b>@lang('mails.pages.contact_email_received_your_message') :</b><br>
  {{$EmailData['message']}}
  <br>
  </p>
  @lang('mails.mails.thanks'),<br>
  @lang('mails.mails.sender')
</div>
