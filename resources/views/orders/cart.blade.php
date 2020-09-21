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
									<th style="width:35%">Product</th>
									<th style="width:15%">Price</th>
									<th style="width:15%">Quantity</th>
									<th style="width:10%">Action</th>
									<th style="width:10%">Unit Price</th>
									<th style="width:15%">Total</th>
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
										<a href="{{route('cart.delete' ,[$Item->id , $Item->user_id])}}" class="text-danger mr-4" title="Remove From Cart"><i class="fas fa-trash"></i></a>
										<a href="{{route('cart')}}" class="text-success update-cart-icon d-none" title="Update Cart"><i class="fas fa-refresh"></i></a>
									</td>
									<td><h5>{{formatPrice($Item->Product->final_price).getCurrency()['symbole']}}</h5></td>
									<td><h5>{{formatPrice($Item->total_price).getCurrency()['symbole'] }}</h5></td>
								</tr>
								@endforeach
								<tr class="bottom_button">
									<td>Do You Have a Coupon Code?</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>
										<div class="cupon_text">
											@auth
											<form action="{{route('coupon.apply')}}" method="post">
												@csrf
												<input class="mr-3" type="text" name="coupuon_code" placeholder="Coupon Code">
												<input type="submit" class="main_btn text-white" value="Apply">
											</form>
											@endauth
											@guest
											<p class="text-danger">Please Login to Use Coupon Codes !</p>
											@endguest
										</div>
									</td>
								</tr>
								<tr>
									<td style="width:15%"><a class="gray_btn update-cart-btn" href="{{route('cart')}}">Update Cart Data</a></td>
									<td style="width:0%"></td>
									<td style="width:0%"></td>
									<td style="width:0%"></td>
									<td style="width:50%;">
										@if($CouponDiscount)
										<h5 class="mb-4">Total</h5>
										<h5 class="mb-4 text-success">Coupon : {{$CartItems->first()->applied_coupon}}</h5>
										@endif
										<h5>Subtotal</h5>
									</td>
									<td style="width:35%;">
										@if($CouponDiscount)
										<h5 class="mb-4">{{formatPrice($Total).getCurrency()['symbole']}}</h5>
										<h5 class="mb-4 text-success">-{{formatPrice($CouponDiscount).getCurrency()['symbole']}}</h5>
										@endif
										<h5>{{formatPrice($SubTotal).getCurrency()['symbole']}}</h5>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="checkout_btn_inner">
							<a class="gray_btn" href="{{route('product.home')}}">Continue Shopping</a>
							<a class="main_btn" href="{{route('checkout')}}">Proceed to checkout</a>
						</div>
					</div>
					@else
					<p class="text-center">Your Shopping Cart is Empty</p>
					<div class="text-center">
						<a class="gray_btn" href="{{route('product.home')}}">Continue Shopping</a>
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
