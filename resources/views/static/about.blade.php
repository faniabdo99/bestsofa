@include('layout.header' , ['PageTitle' => __('titles.about')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Header Menu Area =================-->
    <section class="banner_area" id="about-us-hero">
      <div class="banner_inner">
          <div class="container">
              <div class="banner_content text-center">
                  <h1>@lang('static.about-us-header')</h1>
              </div>
          </div>
        </div>
    </section>
    <section class="about_us_content_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h2 class="text-primary">@lang('static.about-us-header-1')</h2>
            @lang('static.about-us-body-1')
          </div>
        </div>
      </div>
    </section>
    @include('layout.footer')
    @include('layout.scripts')
</body>

</html>
