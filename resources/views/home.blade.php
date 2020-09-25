@include('layout.header', ['PageTitle' => __('titles.home')])

<body>
	<!--================Header Menu Area =================-->
	@include('layout.navbar')
	<!--================Header Menu Area =================-->
	<!--================Home Banner Area =================-->
	<section class="home_banner_area">
		<div class="overlay"></div>
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content row">
					<div class="offset-lg-2 col-lg-8">
						<h3>Fashion for<br>Upcoming Winter</h3>
						<p>Are Your Ready For The New Year Sales ?</p>
						<a class="white_bg_btn" href="{{route('product.home')}}">Visit Our Shop</a>
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
						<h2>Featured Products</h2>
						<p>Get Your Goods of These Hot Products.</p>
					</div>
				</div>
				<div class="row">
					@forelse($PromotedProducts as $Product)
					@if($Product->status == 'Customers only')
						@auth
						<div class="col col10">
							<div class="f_p_item">
								<div class="f_p_img">
									<img class="img-fluid" src="{{$Product->main_image}}" alt="{{$Product->title}}">
									<div class="p_icon">
										@auth
										<a class="icon_btn like_item @if($Product->LikedByUser()) bg-primary text-white @endif" product-id="{{$Product->id}}" href="javascript:;">
										<i class="lnr lnr lnr-heart"></i>
										</a>
										@endauth
										<a href="javascript:;" class="add-to-cart" data-id="{{$Product->id}}"><i class="lnr lnr-cart"></i></a>
									</div>
								</div>
								<a href="{{route('product.single' , [$Product->id , $Product->local_slug])}}">
									<h4>{{$Product->local_title}}</h4>
								</a>
								<h5 class="product-price-before-discount">{{$Product->price}}</h5>
							</div>
						</div>
						@endauth
						@else
						<div class="col col10">
							<div class="f_p_item">
								<div class="f_p_img">
									<img class="img-fluid" src="{{$Product->main_image}}" alt="{{$Product->title}}">
									<div class="p_icon">
										@auth
										<a class="icon_btn like_item @if($Product->LikedByUser()) bg-primary text-white @endif" product-id="{{$Product->id}}" href="javascript:;">
										<i class="lnr lnr lnr-heart"></i>
										</a>
										@endauth
										<a href="javascript:;" class="add-to-cart" data-id="{{$Product->id}}"><i class="lnr lnr-cart"></i></a>
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
						@endif
						@empty
						<p>No Promoted Products Yet</p>
						@endforelse
				</div>
			</div>
		</div>
	</section>
	<!--================End Feature Product Area =================-->
	<!--================Hot Deals Area =================-->
	<section class="hot_deals_area section_gap">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="hot_deal_box">
						<img class="img-fluid" src="{{url('public/img')}}/product/hot_deals/deal1.jpg" alt="">
						<div class="content">
							<h2>20% Off For New Users</h2>
							<p>Signup NOW</p>
						</div>
						<a class="hot_deal_link" href="{{route('signup.get')}}"></a>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="hot_deal_box">
						<img class="img-fluid" src="{{url('public/img')}}/product/hot_deals/deal1.jpg" alt="">
						<div class="content">
							<h2>New Website Offers</h2>
							<p>shop now</p>
						</div>
						<a class="hot_deal_link" href="{{route('product.home')}}"></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Hot Deals Area =================-->
	<!--================About Us Section =================-->
	<section class="about_us_section section_gap">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-lg-6">
					<h2 class="text-dark">UK Fashion Shop</h2>
					<p class="text-muted">a <a class="font-weight-bold" href="https://www.globale-trading.be" target="_blank">Globale Trading</a> Company</p>
					<p>We are a company that has more than 25 years experience in import & export of second-hand clothing & shoes.<br>
						We are wholesale specialized, one of the major leaders in this sector and the only company that  works with high quality UK C4C original in Belgium.<br>
						We share our worldwide experience through business relationships with our regular customers. We have created this webshop to be able to easily and efficiently fulfill the needs of the  customer based in Europe. (for other countries please contact us for more information)<br>
						All our goods are the best cash 4 clothes collections from in/around London area.<br>
						We wish you a lot of shopping pleasure.</p>
				</div>
				<div class="col-12 col-lg-6">
					<iframe src="//www.youtube.com/embed/rRFIoI1sBMw" frameborder="0" allowfullscreen=""></iframe>
				</div>
			</div>
		</div>
	</section>
	<!--================End About Us Section =================-->

	<!--================Clients Logo Area =================-->
	<section class="clients_logo_area">
		<div class="container-fluid">
			<div class="clients_slider owl-carousel">
				<div class="item">
					<img src="{{url('public/img')}}/clients-logo/c-logo-1.png" alt="">
				</div>
				<div class="item">
					<img src="{{url('public/img')}}/clients-logo/c-logo-2.png" alt="">
				</div>
				<div class="item">
					<img src="{{url('public/img')}}/clients-logo/c-logo-3.png" alt="">
				</div>
				<div class="item">
					<img src="{{url('public/img')}}/clients-logo/c-logo-4.png" alt="">
				</div>
				<div class="item">
					<img src="{{url('public/img')}}/clients-logo/c-logo-5.png" alt="">
				</div>
			</div>
		</div>
	</section>
	<!--================End Clients Logo Area =================-->



	{{-- <!--================ Subscription Area ================-->
	<section class="subscription-area section_gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="section-title text-center">
						<h2>Subscribe for Our Newsletter</h2>
						<span>We won’t send any kind of spam</span>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div id="mc_embed_signup">
						<form target="_blank" novalidate action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&id=92a4423d01"
						 method="get" class="subscription relative">
							<input type="email" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'"
							 required="">
							<!-- <div style="position: absolute; left: -5000px;">
								<input type="text" name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="">
							</div> -->
							<button type="submit" class="newsl-btn">Get Started</button>
							<div class="info"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Subscription Area ================--> --}}

	<!--================ start footer Area  =================-->
	@include('layout.footer')
	<!--================ End footer Area  =================-->



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	@include('layout.scripts')
</body>

</html>
