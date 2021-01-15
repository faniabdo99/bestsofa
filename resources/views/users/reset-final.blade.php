@include('layout.header' , ['PageTitle' => __('titles.reset-final')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Login Box Area =================-->
    <section class="login_box_area p_120 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="{{url('public/img')}}/login.jpg" alt="@lang('users.login_image')">
                        <div class="hover">
                            <h4>@lang('users.no_account') </h4>
                            <a class="main_btn" href="{{route('signup.get')}}">@lang('users.signup')</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner reg_form">
                        <h3>@lang('users.choose_password')</h3>
                        <form class="row login_form" action="{{route('reset.finalStep.post' , $code)}}" method="post">
                          @csrf
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email') ?? ''}}"  placeholder="@lang('users.your_email')" required >
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password" value="{{old('email') ?? ''}}"  placeholder="@lang('users.choose_password')" required >
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password_conf" value="{{old('email') ?? ''}}"  placeholder="@lang('users.password_confirm')" required >
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn submit_btn">@lang('users.update_password')</button>
                            </div>
                        </form>
                    </div>
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
