@include('layout.header' , ['PageTitle' => 'Cart'])
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
								<th scope="col">Product</th>
								<th scope="col">Price</th>
								<th scope="col">Quantity</th>
								<th scope="col">Action</th>
								<th scope="col">Total</th>
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
									<h5>{{$Item->Product->final_price}}€</h5>
								</td>
								<td>
									<div class="product_count">
										<input type="number" class="cart-qty input-text qty" data-id="{{$Item->id}}" data-user="{{$Item->user_id}}" data-target="{{route('cart.update')}}" maxlength="12" value="{{$Item->qty}}">
									</div>
                                </td>
                                <td>
                                    <a href="{{route('cart.delete' ,[$Item->id , $Item->user_id])}}" class="text-danger" title="Remove From Cart"><i class="fas fa-trash"></i></a>
                                </td>
								<td>
									<h5>{{$Item->total_price}}€</h5>
								</td>
                            </tr>
						
                            @endforeach
				
							{{-- <tr class="bottom_button">
								<td>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									<div class="cupon_text">
										<input type="text" placeholder="Coupon Code">
										<a class="main_btn" href="#">Apply</a>
										<a class="gray_btn" href="#">Close Coupon</a>
									</div>
								</td>
							</tr> --}}
							<tr>
								<td>
                                    <a class="gray_btn update-cart-btn" href="{{route('cart')}}">Update Cart Data</a>
                                </td>
								<td></td>
								<td></td>
								<td>
                                    <h5 class="mb-4">Tax</h5>
                                    <h5>Subtotal</h5>
								</td>
								<td>
                                    <h5 class="mb-4">{{$CartTax}}€</h5>
									<h5>{{$SubTotal}}€</h5>
								</td>
							</tr>
						</tbody>
                    </table>
                    <div class="shipping_area mb-5">
                        <div class="shipping_box text-left">
                            <h5 class="mb-3">Calculate Shipping Fees</h5>
                            <select class="shipping_select">
                                <option value="1">Choose Your Country</option>
                                <option value="1">Bangladesh</option>
                                <option value="2">India</option>
                                <option value="4">Pakistan</option>
                            </select>
                            <a class="gray_btn" href="#">Calculate</a>
                        </div>
                    </div>
                    <!-- End Shipping -->
                    <div class="checkout_btn_inner">
						<a class="gray_btn" href="{{route('product.home')}}">Continue Shopping</a>
                        <a class="main_btn" href="#">Proceed to checkout</a>
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
