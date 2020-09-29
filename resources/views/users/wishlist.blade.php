@include('layout.header' , ['PageTitle' => __('titles.whishlist')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Login Box Area =================-->
    <section class="feature_product_area section_gap mt-5">
		<div class="main_box">
			<div class="container-fluid">
				<div class="row">
					<div class="main_title">
						<h2>@lang('users.wish')</h2>
						<p>@lang('users.prod_love')</p>
					</div>
				</div>
				<div class="row">
					@forelse($TheUser->LikedProducts() as $Product)
						@if($Product->Product->status == 'Customers only')
							@auth
							<div class="col col10">
								<div class="f_p_item">
									<div class="f_p_img">
										<img class="img-fluid" src="{{$Product->Product->main_image}}" alt="{{$Product->Product->title}}">
										<div class="p_icon">
											@auth
											<a class="icon_btn like_item @if($Product->Product->LikedByUser()) bg-primary text-white @endif" product-id="{{$Product->Product->id}}" href="javascript:;">
												<i class="lnr lnr lnr-heart"></i>
											</a>
											@endauth
											<a href="#"><i class="lnr lnr-cart"></i></a>
										</div>
									</div>
									<a href="{{route('product.single' , [$Product->Product->id , $Product->Product->local_slug])}}">
										<h4>{{$Product->Product->local_title}}</h4>
									</a>
									@if($Product->Product->HasDiscount())
									<span class="product-price-before-discount">{{$Product->Product->price}}</span>
									<h5 class="text-success">{{$Product->Product->FinalPrice.getCurrency()['symbole'] }}</h5>
									@else
										<h5>{{$Product->Product->FinalPrice.getCurrency()['symbole'] }}</h5>
									@endif
								</div>
							</div>
							@endauth
						@else
						<div class="col col10">
							<div class="f_p_item">
								<div class="f_p_img">
									<img class="img-fluid" src="{{$Product->Product->main_image}}" alt="{{$Product->Product->title}}">
									<div class="p_icon">
										@auth
											<a class="icon_btn like_item @if($Product->Product->LikedByUser()) bg-primary text-white @endif" product-id="{{$Product->Product->id}}" href="javascript:;">
												<i class="lnr lnr lnr-heart"></i>
											</a>
										@endauth
									</div>
								</div>
								<a href="{{route('product.single' , [$Product->Product->id , $Product->Product->local_slug])}}">
									<h4>{{$Product->Product->local_title}}</h4>
								</a>
								@if($Product->Product->HasDiscount())
								<span class="product-price-before-discount">{{$Product->Product->price}}</span>
								<h5 class="text-success">{{$Product->Product->FinalPrice.getCurrency()['symbole'] }}</h5>
								@else
									<h5>{{$Product->Product->FinalPrice.getCurrency()['symbole'] }}</h5>
								@endif
							</div>
						</div>
						@endif
                    @empty
                    <div class="col-12">
                        <p class="text-center">@lang('users.no_prod_love')</p>
                    </div>
					@endforelse
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
