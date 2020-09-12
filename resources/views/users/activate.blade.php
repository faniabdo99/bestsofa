@include('layout.header' , ['PageTitle' => 'Account Activation'])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Login Box Area =================-->
    <section class="p_120 mt-5 activated_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Account @if($OldState == "Confirmed") Already @endif Activated ! </h1>
                    <p >Congratulations! Your Account is @if($OldState == "NotConfirmed")Now @endif Active , You Have Access to All UK Fashion Shop Feauters ! </p>
                    <a class="main_btn" href="{{route('product.home')}}">Browse Products</a>
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
