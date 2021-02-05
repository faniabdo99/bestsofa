@include('layout.header' , ['PageTitle' => __('titles.cart')])
<body>
	<!--================Header Menu Area =================-->
	@include('layout.navbar')
	<!--================Header Menu Area =================-->
	<!--================Cart Area =================-->
	<section class="cart_area mt-5">
		<div class="container">
			<div class="cart_inner">
				@if($CartItems->count() > 0)
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th style="width:30%">@lang('orders.product')</th>
									<th style="width:15%">@lang('orders.price')</th>
									<th style="width:15%">@lang('orders.qty')</th>
									<th style="width:10%">@lang('orders.act')</th>
									<th style="width:15%">@lang('orders.unit_price')</th>
									<th style="width:5%">Unit Tax</th>
									<th style="width:10%">@lang('orders.total')</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($CartItems as $Item)
								<tr>
									<td>
										<div class="media">
											<div class="d-flex">
												<img src="{{$Item->Product->main_image}}" alt="{{$Item->Product->title}}">
											</div>
											<div class="media-body">
												<p>{{$Item->Product->title}}</p>
											</div>
										</div>
									</td>
									<td>
										<h5>{{formatPrice($Item->Product->final_price).getCurrency()['symbole']}}</h5>
									</td>
									<td>
										<div class="product_count">
											<input type="number" class="cart-qty input-text qty" data-id="{{$Item->id}}" data-user="{{$Item->user_id}}" data-target="{{route('cart.update')}}" maxlength="12" value="{{$Item->qty}}">
										</div>
									</td>
									<td>
										<a href="{{route('cart.delete' ,[$Item->id , $Item->user_id])}}" class="text-danger mr-4" title="@lang('orders.cart_remove')"><i class="fas fa-trash"></i></a>
										<a href="{{route('cart')}}" class="text-success update-cart-icon d-none" title="@lang('orders.update_cart')"><i class="fas fa-refresh"></i></a>
									</td>
									<td><h5>{{formatPrice($Item->Product->final_price).getCurrency()['symbole']}}</h5></td>
									<td><h5>{{formatPrice($Item->Product->TaxAmount).getCurrency()['symbole']}}</h5></td>
									<td><h5>{{formatPrice($Item->total_price+$Item->TotalTax).getCurrency()['symbole'] }}</h5></td>
								</tr>
								@endforeach
								<tr class="bottom_button">
									<td>@lang('orders.have_coupon')</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>
										<div class="cupon_text">
											@auth
											<form action="{{route('coupon.apply')}}" method="post">
												@csrf
												<input class="mr-3" type="text" name="coupuon_code" placeholder="@lang('orders.coupon_code')">
												<input type="submit" class="main_btn text-white" value="@lang('orders.apply')">
											</form>
											@endauth
											@guest
											<p class="text-danger">@lang('orders.login_to_coupon')</p>
											@endguest
										</div>
									</td>
								</tr>
								<tr>
									<td style="width:15%"><a class="gray_btn update-cart-btn" href="{{route('cart')}}">@lang('orders.update_cart')</a></td>
									<td style="width:0%"></td>
									<td style="width:0%"></td>
									<td style="width:0%"></td>
									<td style="width:0%"></td>
									<td style="width:50%;">
										<h5 class="mb-4">@lang('orders.total')</h5>
										<h5 class="mb-4">Order Tax</h5>
										@if($CouponDiscount)
											<h5 class="mb-4 text-success">@lang('orders.coupon') : {{$CartItems->first()->applied_coupon}}</h5>
										@endif
										<h5>@lang('orders.subtotal')</h5>
									</td>
									<td style="width:40%;">
										<h5 class="mb-4">{{formatPrice($Total).getCurrency()['symbole']}}</h5>
										<h5 class="mb-4">{{formatPrice($CartTax).getCurrency()['symbole']}}</h5>
										@if($CouponDiscount)
											<h5 class="mb-5 text-success">-{{formatPrice($CouponDiscount).getCurrency()['symbole']}}</h5>
										@endif
										<h5>{{formatPrice($SubTotal+$CartTax).getCurrency()['symbole']}}</h5>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="checkout_btn_inner">
							<a class="gray_btn" href="{{route('product.home')}}">@lang('orders.continue')</a>
							<a class="main_btn" href="{{route('checkout')}}">@lang('orders.to_checkout')</a>
						</div>
					</div>
					@else
					<p class="text-center">@lang('orders.cart_empty')</p>
					<div class="text-center">
						<a class="gray_btn" href="{{route('product.home')}}">@lang('orders.continue')</a>
					</div>
					@endif
			</div>
		</div>
	</section>
	<!--================End Cart Area =================-->
	<!--================ start footer Area  =================-->
	@include('layout.footer')
	<!--================ End footer Area  =================-->
	@include('layout.scripts')
</body>

</html>
