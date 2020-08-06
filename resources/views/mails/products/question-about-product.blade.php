<div style="padding:40px;">
    <h1>New Email From UK Fashion Shop</h1>
    <p>You have new message from UK Fashion Shop About a Product.<br>
    <b>The Message : </b><br>
    {{$EmailData['message']}}
    <br>
    <b style="margin-top:50px;display:block;">{{$EmailData['name']}}</b> {{$EmailData['email']}} <br>
    {{$EmailData['country']}} - {{$EmailData['phone_number']}}
    <br>
    The Product : <a href="{{route('product.single' , [$EmailData['product_id'] , $EmailData['product_slug']])}}">{{route('product.single' , [$EmailData['product_id'] , $EmailData['product_slug']])}}</a>
    </p>
    Thanks,<br>
    UK Fashion Shop LLC
  </div>
  