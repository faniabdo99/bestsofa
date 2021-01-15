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
        <h1>@lang('errors.404_lost')</h1>
        <p>@lang('errors.404_not_found')</p>
        <b>@lang('errors.404_possible_reasons')</b>
        <ul>
          <li>@lang('errors.404_moved_deleted')</li>
          <li>@lang('errors.404_order_not_available')</li>
          <li>@lang('errors.404_missing_data')</li>
        </ul>
        <a class="main_btn" href="{{route('product.home')}}">@lang('errors.continue_shopping')</a>
      </div>
    </div>
  </div>
</section>
	@include('layout.scripts')
</body>

</html>
