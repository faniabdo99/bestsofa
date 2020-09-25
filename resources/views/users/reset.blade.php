@include('layout.header' , ['PageTitle' => __('titles.reset')])
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
                        <h3>Reset Password</h3>
                        <form class="row login_form" action="{{route('reset.post')}}" method="post" id="contactForm">
                          @csrf
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email') ?? ''}}"  placeholder="Email Address" required >
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn submit_btn">Send Reset Link</button>
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
