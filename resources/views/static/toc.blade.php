@include('layout.header', ['PageTitle' => __('titles.toc')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Header Menu Area =================-->
    <section class="banner_area section_gap">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h1>@lang('static.toc-header')</h1>
                    <p class="text-white">@lang('static.toc-subheader')</p>
                </div>
            </div>
        </div>
    </section>
    <section class="about_us_content_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @lang('static.toc-body')
          </div>
        </div>
      </div>
    </section>
    @include('layout.footer')
    @include('layout.scripts')
</body>

</html>
