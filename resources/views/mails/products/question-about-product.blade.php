<div style="padding:40px;">
    <h1>@lang('mails/products.question')</h1>
    <p>@lang('mails/products.question_paragraph')<br>
    <b>@lang('mails/products.question_message') : </b><br>
    {{$EmailData['message']}}
    <br>
    <b style="margin-top:50px;display:block;">{{$EmailData['name']}}</b> {{$EmailData['email']}} <br>
    {{$EmailData['country']}} - {{$EmailData['phone_number']}}
    <br>
    @lang('mails/products.question_product') : <a href="{{route('product.single' , [$EmailData['product_id'] , $EmailData['product_slug']])}}">{{route('product.single' , [$EmailData['product_id'] , $EmailData['product_slug']])}}</a>
    </p>
    @lang('mails/mails.thanks'),<br>
    @lang('mails/mails.sender')
  </div>
