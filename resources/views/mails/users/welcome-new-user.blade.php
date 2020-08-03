<div style="padding:40px;">
  <h1>Welcome</h1>
  <p>Welcome to UK Fashion Shop , <b>{{$EmailData['name']}}</b><br>
  Please take a moment to confirm your email , you won't be able to place orders or buy any items unless you do this .</p>
  @component('mail::button', ['url' => route('account.activate' , $EmailData['code'])])
  Confirm My Account
  @endcomponent
  Thanks,<br>
  UK Fashion Shop LLC
</div>
