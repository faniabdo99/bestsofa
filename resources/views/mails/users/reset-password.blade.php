@component('mail::message')
# Reset Your Password
Hello , {{$email_data->name}} , <br>
You requested to reset your password on UK Fashion Shop , Please click the link below to do so . <br>
if you don't know about this request , you can safley ignore this message and your account will be secure .
@component('mail::button', ['url' => route('reset.finalStep' , $email_data->code)])
Reset Your Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
