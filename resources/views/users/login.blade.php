@include('layout.header' , ['PageTitle' => __('titles.login')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Login Box Area =================-->
    <section class="login_box_area p_120 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid h-100" src="{{url('public/img')}}/login.jpg" alt="Login to UK Fashion Shop">
                        <div class="hover">
                            <h4>@lang('users.no_account') </h4>
                            <a class="main_btn" href="{{route('signup.get')}}">@lang('users.signup')</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner reg_form">
                        <h3>@lang('users.login')</h3>
                        <form class="row login_form" action="{{route('login.post')}}" method="post" id="contactForm">
                          @csrf
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email') ?? ''}}"  placeholder="@lang('users.email')" required >
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="@lang('users.password')" required >
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="keep_login">
                                    <label for="f-option2">@lang('users.keep_logged')</label>
                                </div>
                            </div>
                            <div class="col-md-12 text-left">
                                <p>@lang('users.forgot_password') <a href="{{route('reset.get')}}" class="forgot_password_link">@lang('users.click')</a></p>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn submit_btn">@lang('users.login')</button>
                                <p class="font-weight-bold text-left mt-4">@lang('users.social_login')</p>
                                <div class="social-login-icons">
                                  <ul>
                                    <li class="google"><a href="{{route('login.social' , 'google')}}"><i class="fab fa-google"></i></a></li>
                                    <li class="linkedin"><a href="{{route('login.social' , 'linkedin')}}"><i class="fab fa-linkedin"></i></a></li>
                                    <li class="facebook"><a href="{{route('login.social' , 'facebook')}}"><i class="fab fa-facebook"></i></a></li>
                                  </ul>
                                </div>
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
