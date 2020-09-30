@include('layout.header', ['PageTitle' => 'Error 404 - Page Not Found'])
<body>
	<!--================Header Menu Area =================-->
	@include('layout.navbar')
	<!--================Header Menu Area =================-->
<section class="error-page error-404">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-12 error-illustration">
        <div class="error-icon">
          <img src="{{url('public/img/icons/forbidden.png')}}" alt="Access Forbidden">
        </div>
        <h2>403</h2>
      </div>
      <div class="col-lg-6 col-12 error-content">
        <h1>You Shouldn't be Here!</h1>
        <p>Error 403, Access Forbidden</p>
        <b>Possible Reasons</b>
        <ul>
          <li>Your Are Not Logged in</li>
          <li>The Data Your Trying to Access Belongs to Someone Else</li>
        </ul>
        <a class="main_btn" href="{{route('product.home')}}">Continue Shopping</a>
      </div>
    </div>
  </div>
</section>
	@include('layout.scripts')
</body>

</html>
