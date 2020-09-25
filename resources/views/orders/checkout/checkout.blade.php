@include('layout.header', ['PageTitle' => __('titles.checkout')])
<body>
	@include('layout.navbar')
	<!--================Home Banner Area =================-->
	<section class="banner_area section_gap">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<h1>Checkout</h1>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Checkout Area =================-->
	<section class="checkout_area">
		<div class="container">
			<div class="billing_details">
				<div class="row">
					<div class="col-lg-7">
						<h3>Billing Details</h3>
						<form class="row contact_form" action="{{route('checkout.post')}}" method="post">
							@csrf
							<div class="col-md-6 form-group p_star">
								<label for="first">First Name: <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" placeholder="Enter Your First Name" id="first" name="first_name" value="@auth {{auth()->user()->first_name}} @endauth">
							</div>
							<div class="col-md-6 form-group p_star">
								<label for="last">Last Name: <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" placeholder="Enter Your Last Name" id="last" name="last_name" value="@auth {{auth()->user()->last_name}} @endauth">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="company_name">Company Name:</label>
								<input type="text" class="form-control" id="company_name" value="@auth{{auth()->user()->company_name}}@endauth" name="company_name" placeholder="Enter Your Company Name">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="vat_number">VAT Number:</label>
								<input type="text" class="form-control" id="vat_number" value="@auth{{auth()->user()->vat_number}}@endauth" name="vat_number" placeholder="Enter Your VAT To Get Tax Free Order">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="number">Phone Number: <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" id="number" value="@auth{{auth()->user()->phone_number}}@endauth" name="phone_number" placeholder="Enter Your Phone Number">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="email">Email Address: <span class="text-danger">*</span></label>
								<input required type="email" class="form-control" value="@auth{{auth()->user()->email}}@endauth" id="email" name="email" placeholder="Enter Your Email Address">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="email_confirmation">Confirm Email Address: <span class="text-danger">*</span></label>
								<input required type="email" class="form-control" autocomplete="disabled" id="email_confirmation" name="email_confirmation" placeholder="Enter Your Email Address Again">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="country">Shipping Country: <span class="text-danger">*</span></label>
								<select required name="country" id="country" class="form-control shipping-country">
									<option value="">Choose Your Country</option>
									@forelse ($ShippingCostCountries as $Country)
									<option value="{{$Country}}">{{getCountryNameFromISO($Country)}}</option>
									@empty
									@endforelse
								</select>
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="add1">Address: <span class="text-danger">*</span></label>
								<input required type="text" value="@auth{{auth()->user()->street_address}}@endauth" placeholder="Enter Your Address Here" class="form-control" id="add1" name="address">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="add2">Address 2:</label>
								<input type="text" placeholder="Enter Your Second Address Here" class="form-control" id="add2" name="address_2">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="city">City: <span class="text-danger">*</span></label>
								<input required type="text" value="@auth{{auth()->user()->city}}@endauth" class="form-control" id="city" name="city" placeholder="Please Enter Your City">
							</div>
							<div class="col-md-12 form-group mb-5">
								<label for="city">ZIP Code: <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" value="@auth{{auth()->user()->zip_code}}@endauth" id="zip" name="zip_code" placeholder="Enter Your Postcode/ZIP">
							</div>
							<div class="col-md-12">
								<h3>Shipping Details</h3>
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
                                    <p class="pl-0">How You Want to Collect Your Order?</p>
                                    <input type="radio" id="store_yes" required name="pickup_at_store" value="yes"> <label for="store_yes" class="mr-5">Pickup at Warhouse</label>
									<input type="radio" id="store_no" required name="pickup_at_store" value="no"> <label for="store_no">Ship to My Country</label>
								</div>
                            </div>
							<div id="shipping_address" class="col-md-12 form-group d-none">
								<div class="creat_account">
                                    <p class="pl-0">Do You Have Diffrent Shipping Address ?</p>
                                    <input type="radio" id="yes" name="diff_shipping_address" value="yes"> <label for="yes" class="mr-5">Yes</label>
									<input type="radio" id="no" selected name="diff_shipping_address" value="no"> <label for="no">No</label>
								</div>
                            </div>
							<div id="shipping_details" class="d-none">
							<div class="col-md-12">
								<h3>Shipping Details</h3>
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="shipping_add1">Address: <span class="text-danger">*</span></label>
								<input type="text" value="@auth{{auth()->user()->street_address}}@endauth" placeholder="Enter Your Address Here" class="form-control" id="shipping_add1" name="shipping_address">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="shipping_add2">Address 2:</label>
								<input type="text" placeholder="Enter Your Second Address Here" class="form-control" id="shipping_add2" name="shipping_address_2">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="shipping_city">City: <span class="text-danger">*</span></label>
								<input type="text" value="@auth{{auth()->user()->city}}@endauth" class="form-control" id="shipping_city" name="shipping_city" placeholder="Please Enter Your City">
							</div>
							<div class="col-md-12 form-group mb-5">
								<label for="shipping_zip">ZIP Code: <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="@auth{{auth()->user()->zip_code}}@endauth" id="shipping_zip" name="shipping_zip_code" placeholder="Enter Your Postcode/ZIP">
							</div>
						</div>
							<div class="col-md-12 form-group">
								<label for="message">Order Notes:</label>
								<textarea class="form-control" name="order_notes" id="message" rows="1" placeholder="Please Add Any Additional Information to Your Order"></textarea>
							</div>
							@guest
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" checked id="create_account" name="create_account">
									<label for="create_account">Create an account?</label>
								</div>
							</div>
							@endguest
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="toc" required name="accepted_toc">
									<label for="toc">I've Read and Accepted <a href="{{route('privacyPolicy')}}" target="_blank">Privacy Policy</a> and <a href="{{route('toc')}}" target="_blank">Terms & Conditions</a></label>
								</div>
							</div>
							<input hidden name="order_weight" value="{{$OrderWeight}}">
							<input hidden name="order_tax_rate" value="{{$CartTaxAvg}}">
							<input hidden name="total_amount" value="{{$TotalWithoutTax}}">
							<input hidden name="total_tax_amount" value="{{$CartTax}}">
							<input hidden name="total_shipping_cost" value="0">
							<input hidden name="total_shipping_tax" value="0">
							<div class="col-md-12 form-group">
								<button class="main_btn" type="submit">Porcced to Summary</button>
							</div>
						</form>
					</div>
					<div class="col-lg-5">
						<div class="order_box p-0">
							<h2>Your Order</h2>
							<ul class="list">
								@forelse ($CartItems as $CartItem)
								<li>
									<a href="#">{{$CartItem->Product->local_title}} <b class="text-primary">X{{$CartItem->qty}}</b>
										<span class="last">{{formatPrice($CartItem->total_price).getCurrency()['symbole']}}</span>
									</a>
								</li>
								@empty
								@endforelse
								@if($CouponDiscount)
									<li>
										<a href="#">Coupon Discount <span class="last text-success">- {{formatPrice($CouponDiscount).getCurrency()['symbole']}}</span></a>
									</li>
								@endif
							</ul>
							<ul class="list list_2 mb-5">
									<li><a href="#">Subtotal<span>{{formatPrice($TotalWithoutTax).getCurrency()['symbole']}}</span></a></li>
							</ul>
						</div>
						<div class="order_box p-0">
							<h2>Order Shpping</h2>
							<p class="pl-0">Select the country you want us to ship the order to</p>
							<ul class="list list_2 mb-5">
								<li><a href="#">Shipping Total<span id="order_shipping_total">Select Country First</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Checkout Area =================-->
	@include('layout.footer')
	@include('layout.scripts')
	<script type="text/javascript">
		$('.shipping-country').change(function() {
			var ActionRoute = $('meta[name=base_url]').attr('content') + '/api/calculate-shipping-cost';
			var CountryName = $(this).val();
			var Weight = $('input[name="order_weight"]').val();
			var CartTax = $('input[name="order_tax_rate"]').val();
			var SiteCurrency = '{{session()->get('currency')}}';
			$.ajax({
				'method': 'post',
				'url': ActionRoute,
				'data': {
					'country_name': CountryName,
					'order_weight': Weight,
					'cart_tax_avg': CartTax
				},
				success: function(response) {
					//Apply The Data to the View
					//total_shipping_cost
					//total_shipping_tax
					if(SiteCurrency == 'GBP'){
					 	$('#order_shipping_cost').html(response.actual_cost_gbp + '{{getCurrency()['symbole']}}');
						$('input[name="total_shipping_cost"]').val(response.actual_cost_gbp);
						$('#order_shipping_tax').html(response.shipping_tax_gbp + '{{getCurrency()['symbole']}}');
						$('input[name="total_shipping_tax"]').val(response.shipping_tax_gbp);
						$('#order_shipping_total').html(response.final_cost_gbp + '{{getCurrency()['symbole']}}');
					}else{
						console.log(response.actual_cost_euro);
						$('#order_shipping_cost').html(response.actual_cost_euro + '{{getCurrency()['symbole']}}');
						$('input[name="total_shipping_cost"]').val(response.actual_cost_euro);
						$('#order_shipping_tax').html(response.shipping_tax_euro + '{{getCurrency()['symbole']}}');
						$('input[name="total_shipping_tax"]').val(response.shipping_tax_euro);
						$('#order_shipping_total').html(response.final_cost_euro + '{{getCurrency()['symbole']}}');
					}
				},
				error: function(response) {
					console.log(response);
				}
			});
		});
		$('input[name="pickup_at_store"]').change(function(){
			if($(this).val() == 'no'){
				$('#shipping_address').removeClass('d-none');
			}else{
				$('#shipping_address').addClass('d-none');
				$('#shipping_details').addClass('d-none');
			}
		});
		$('input[name="diff_shipping_address"]').change(function(){
			if($(this).val() == 'yes'){
				//Show the list
				$('#shipping_details').removeClass('d-none');
			}else{
				//Hide the list
				$('#shipping_details').addClass('d-none');
			}
		});
	</script>
