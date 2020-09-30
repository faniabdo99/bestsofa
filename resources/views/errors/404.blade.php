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
          <img src="{{url('public/img/icons/not-found.png')}}" alt="Page Not Found">
        </div>
        <h2>404</h2>
      </div>
      <div class="col-lg-6 col-12 error-content">
        <h1>Lost You'r Way There?</h1>
        <p>Error 404, This Page Cannot Be Found!</p>
        <b>Possible Reasons</b>
        <ul>
          <li>This Page Has Been Moved / Deleted</li>
          <li>The Order You'r Looking For is not Available</li>
          <li>There is Missing Data in the Chain</li>
        </ul>
        <a class="main_btn" href="{{route('product.home')}}">Continue Shopping</a>
      </div>
    </div>
  </div>
</section>
	@include('layout.scripts')
</body>

</html>
