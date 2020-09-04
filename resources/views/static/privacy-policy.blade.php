@include('layout.header')
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Header Menu Area =================-->
    <section class="banner_area section_gap">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h1>Privacy Policy</h1>
                    <p class="text-white">Last Update on 9/2/2020</p>
                </div>
            </div>
        </div>
    </section>
    <section class="about_us_content_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <p>
                From 25 May 2018, any organization that processes or controls personally identifiable material about EU citizens must have implemented rigorous organizational and technical measures to comply with the General Data Protection Regulation (GDPR) or also known as the General Data Protection Regulation (AVG). Failure to comply with the GDPR entails high fines. Fines can amount to 4 percent of sales or to 20 million euros.
            </p>
          </div>
        </div>
      </div>
    </section>
    @include('layout.footer')
    @include('layout.scripts')
</body>

</html>
