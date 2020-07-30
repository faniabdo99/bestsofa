@include('layout.header' , ['PageTitle' => 'Login'])
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
                            <h4>Don't have an account yet ? </h4>
                            <a class="main_btn" href="{{route('signup.get')}}">Signup</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner reg_form">
                        <h3>Login</h3>
                        <form class="row login_form" action="{{route('login.post')}}" method="post" id="contactForm">
                          @csrf
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email') ?? ''}}"  placeholder="Email Address" required >
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required >
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="keep_login">
                                    <label for="f-option2">Keep me logged in</label>
                                </div>
                            </div>
                            <div class="col-md-12 text-left">
                                <p>Frogot Your Password ? <a href="{{route('reset.get')}}" class="forgot_password_link">Click Here</a></p>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn submit_btn">Login</button>
                                <p class="font-weight-bold text-left mt-4">Login With Social Media</p>
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
