@component('mail::message')
# Welcome to UK Fashion Shop
Welcome to UK Fashion Shop, Your are one step behind of getting your account, you just need to choose a password! <br>
Click the link below to do so.
@component('mail::button', ['url' => route('setPassword.get' , $EmailData->id)])
Set Your Password
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
