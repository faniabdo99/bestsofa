@include('layout.header', ['PageTitle' => __('titles.contact-us')])
<body>
    @include('layout.navbar')

    <section class="contact_area p_120 mt-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <h1>@lang('homepage.transfer_price')</h1>
            </div>
            <div class="row mb-5">
                <div class="col-lg-8">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>@lang('homepage.in_denemark')</th>
                                <th>@lang('homepage.duration')</th>
                                <th>@lang('orders.price')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>@lang('homepage.syd_delivery')</td>
                                <td>1-2 @lang('homepage.bus_days')</td>
                                <td>650 Dkk</td>
                            </tr>
                            <tr>
                                <td>@lang('homepage.vest_delivery')</td>
                                <td>2-3 @lang('homepage.bus_days')</td>
                                <td>850 Dkk</td>
                            </tr>
                            <tr>
                                <td>@lang('homepage.ost_delivery')</td>
                                <td>3-4 @lang('homepage.bus_days')</td>
                                <td>1200 Dkk</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>@lang('homepage.in_deutsch')</th>
                                <th>@lang('homepage.duration')</th>
                                <th>@lang('orders.price')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>@lang('homepage.alle_deut')</td>
                                <td>3-4 @lang('homepage.bus_days')</td>
                                <td>400 Dkk</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <img style="height:350px;width:500px" class="img-fluid" src="{{ asset('public/img/banner/home.jpg') }}" alt="hi">
                </div>
            </div>
            <div>
                <h3>@lang('homepage.heavey_goods')</h3><br>
                <p>@lang('homepage.pollet_delivered')</p>
            </div>
        </div>
    </section>

    @include('layout.footer')
    @include('layout.scripts')
</body>
</html>
