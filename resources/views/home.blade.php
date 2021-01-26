@include('layout.header', ['PageTitle' => __('titles.home')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Header Menu Area =================-->
	<!--================Home Banner Area =================-->
	<section class="owl-carousel full-width-carousel">
		<div class="banner_area owl-item" id="homepage-hero">
			<div class="banner_inner">
				<div class="container">
					<div class="banner_content text-center">
						<h1>Made in Denmark</h1>
						<p>Great Stuff Made in Denmark, Other Stuff Here</p>
						<a class="white_bg_btn" href="{{route('product.home')}}">@lang('homepage.cta')</a>
					</div>
				</div>
			</div>
		</div>
		<div class="banner_area  owl-item" id="homepage-hero">
			<div class="banner_inner">
				<div class="container">
					<div class="banner_content text-center">
						<h1>Straight From Factory</h1>
						<p>From Factory to Your Home!</p>
						<a class="white_bg_btn" href="{{route('product.home')}}">@lang('homepage.cta')</a>
					</div>
				</div>
			</div>
		</div>
	</section>

    <!--================End Home Banner Area =================-->
    <!--================Feature Product Area =================-->
    <section class="feature_product_area section_gap">
        <div class="main_box">
            <div class="container-fluid">
                <div class="row">
                    <div class="main_title">
                        <h2>@lang('homepage.featured-products-header')</h2>
                        <p>@lang('homepage.featured-products-subheader')</p>
                    </div>
                </div>
                <div class="row">
                    @forelse($PromotedProducts as $Product)
                 
                    <div class="col col10">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{$Product->main_image}}" alt="{{$Product->title}}">
                                <div class="p_icon">
                                    @auth
                                    <a class="icon_btn like_item @if($Product->LikedByUser()) bg-primary text-white @endif"
                                        product-id="{{$Product->id}}" href="javascript:;">
                                        <i class="lnr lnr lnr-heart"></i>
                                    </a>
                                    @endauth
                                </div>
                            </div>
                            <a href="{{route('product.single' , [$Product->id , $Product->local_slug])}}">
                                <h4>{{$Product->local_title}}</h4>
                            </a>
                            @if($Product->HasDiscount())
                            <span class="product-price-before-discount">{{$Product->price}}</span>
                            <h5 class="text-success">{{$Product->FinalPrice.getCurrency()['symbole'] }}</h5>
                            @else
                            <h5>{{$Product->FinalPrice.getCurrency()['symbole'] }}</h5>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p>
                        @lang('homepage.featured-products-no-items')</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!--================End Feature Product Area =================-->
    <!--================About Us Section =================-->
    <section class="about_us_section section_gap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h2 class="text-dark">
                        @lang('homepage.about-us-header')</h2>
                    <p class="text-muted">
                        @lang('homepage.about-us-subheader')</p>
                    <p>
                        @lang('homepage.about-us-content')</p>
                </div>
                <div class="col-12 col-lg-6">
                    <iframe src="//www.youtube.com/embed/rRFIoI1sBMw" frameborder="0" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </section>
    <!--================End About Us Section =================-->
    <!--================ start footer Area  =================-->
    @include('layout.footer')
    <!--================ End footer Area  =================-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('layout.scripts')
</body>
</html>
