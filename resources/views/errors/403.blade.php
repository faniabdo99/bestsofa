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
        <h1>@lang('errors.403_should_not_be_here')</h1>
        <p>@lang('errors.403_access_forbidden')</p>
        <b>@lang('errors.403_possible_reasons')</b>
        <ul>
          <li>@lang('errors.403_not_logged_in')</li>
          <li>@lang('errors.403_data_access')</li>
        </ul>
        <a class="main_btn" href="{{route('product.home')}}">@lang('errors.continue_shopping')</a>
      </div>
    </div>
  </div>
</section>
	@include('layout.scripts')
</body>

</html>
