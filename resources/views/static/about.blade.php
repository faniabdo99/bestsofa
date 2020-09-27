@include('layout.header' , ['PageTitle' => __('titles.about')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Header Menu Area =================-->
    <section class="banner_area section_gap">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h1>@lang('static.about-us-header')</h1>
                    <p class="text-white">@lang('static.about-us-subheader')</p>
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
            <br><br>
            <h2 class="text-primary">@lang('static.about-us-header-2')</h2>
            <p>@lang('static.about-us-contact-gt')</p>
            <ul class="contact_info">
              <li>@lang('static.about-us-gt-contact-vat')</li>
              <li>@lang('static.about-us-gt-contact-location')</li>
              <li>@lang('static.about-us-gt-contact-phone-number')</li>
            </ul>

          </div>
        </div>
      </div>
    </section>
    @include('layout.footer')
    @include('layout.scripts')
</body>

</html>
