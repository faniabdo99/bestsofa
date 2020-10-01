@component('mail::message')
# @lang('mails.orders.status_updated')
@lang('mails.mails.hello') {{$TheOrder->first_name}}, @lang('mails.orders.status_updated_first_paragraph')<br>
@lang('mails.orders.status_updated_current_status') <b>{{$TheOrder->status}}</b>
@if($TheOrder->tracking_link)
  <br>
  @lang('mails.orders.status_updated_tracking_link')
@component('mail::button', ['url' => $TheOrder->tracking_link])
@lang('mails.orders.status_updated_track_and_trace')
@endcomponent
@endif

@lang('mails.mails.thanks'),<br>
{{ config('app.name') }}
@endcomponent
