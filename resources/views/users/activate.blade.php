@include('layout.header' , ['PageTitle' => __('titles.account-activation')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Login Box Area =================-->
    <section class="p_120 mt-5 activated_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>
                        @if($OldState == "Confirmed")
                            @lang('users.already_activated')
                        @else
                            @lang('users.activated')
                        @endif
                    </h1>
                    <p >
                        @if ($OldState == "NotConfirmed")
                            @lang('users.now_active')
                        @else
                            @lang('users.active')
                        @endif
                        
                    </p>
                    <a class="main_btn" href="{{route('product.home')}}">@lang('users.browse_products')</a>
                </div>
            </div>
        </div>
    </section>
    <!--================ start footer Area  =================-->
    @include('layout.footer')
    <!--================ End footer Area  =================-->



    <!-- Optional JavaScript -->
    @include('layout.scripts')
</body>

</html>
