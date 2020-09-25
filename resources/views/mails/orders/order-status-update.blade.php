@component('mail::message')
# Order Status Updated
Hello {{$TheOrder->first_name}}, Your Order Status Has Been Updated<br>
Your Current Order Status is <b>{{$TheOrder->status}}</b>
@if($TheOrder->tracking_link)
  <br>
  You Can Track Your Order Shipping From This Link
@component('mail::button', ['url' => $TheOrder->tracking_link])
Track & Trace
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
