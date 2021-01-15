@include('layout.header', ['PageTitle' => __('titles.privacy-policy')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Header Menu Area =================-->
    <section class="banner_area" id="homepage-hero">
      <div class="banner_inner">
        <div class="container">
          <div class="banner_content text-center">
            <h1>@lang('static.privacy-policy-header')</h1>
            <p class="text-white">@lang('static.privacy-policy-subheader')</p>
          </div>
        </div>
      </div>
    </section>
    <section class="about_us_content_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <p>@lang('static.privacy-policy-body')</p>
          </div>
        </div>
      </div>
    </section>
    @include('layout.footer')
    @include('layout.scripts')
</body>

</html>
