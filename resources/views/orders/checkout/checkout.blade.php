@include('layout.header', ['PageTitle' => __('titles.checkout')])
<body>
	@include('layout.navbar')
	<!--================Home Banner Area =================-->
	<section class="banner_area" id="checkout-hero">
		<div class="banner_inner">
			<div class="container">
				<div class="banner_content text-center">
					<h1>@lang('orders.checkout')</h1>
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
						<h3>@lang('orders.bill')</h3>
						<form class="row contact_form" action="{{route('checkout.post')}}" method="post">
							@csrf
							<div class="col-md-6 form-group p_star">
								<label for="first">@lang('users.first_name'): <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" placeholder="@lang('users.first_name_ph')" id="first" name="first_name" value="@auth {{auth()->user()->first_name}} @endauth">
							</div>
							<div class="col-md-6 form-group p_star">
								<label for="last">@lang('users.last_name'): <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" placeholder="@lang('users.last_name_ph')" id="last" name="last_name" value="@auth {{auth()->user()->last_name}} @endauth">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="company_name">@lang('users.company_name'):</label>
								<input type="text" class="form-control" id="company_name" value="@auth{{auth()->user()->company_name}}@endauth" name="company_name" placeholder="@lang('users.company_name_ph')">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="vat_number">@lang('users.vat_num'):</label>
								<input type="text" class="form-control" id="vat_number" value="@auth{{auth()->user()->vat_number}}@endauth" name="vat_number" placeholder="@lang('orders.vat_num')">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="number">@lang('users.phone'): <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" id="number" value="@auth{{auth()->user()->phone_number}}@endauth" name="phone_number" placeholder="@lang('users.phone_ph')">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="email">@lang('users.email'): <span class="text-danger">*</span></label>
								<input required type="email" class="form-control" value="@auth{{auth()->user()->email}}@endauth" id="email" name="email" placeholder="@lang('users.email_ph')">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="email_confirmation">@lang('orders.email_confirm'): <span class="text-danger">*</span></label>
								<input required type="email" class="form-control" autocomplete="disabled" id="email_confirmation" name="email_confirmation" placeholder="@lang('orders.email_confirm_ph')">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="country">@lang('orders.ship_country'): <span class="text-danger">*</span></label>
								<select required name="country" id="country" class="form-control shipping-country">
									<option value="">@lang('users.country_choose')</option>
									@forelse ($ShippingCostCountries as $Country)
									<option value="{{$Country}}">{{getCountryNameFromISO($Country)}}</option>
									@empty
									@endforelse
								</select>
								<p class="mt-3 mb-0">@lang('orders.no_see_country') <a href="{{route('contact.get')}}">@lang('orders.contact')</a></p>
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="add1">@lang('orders.address'): <span class="text-danger">*</span></label>
								<input required type="text" value="@auth{{auth()->user()->street_address}}@endauth" placeholder="@lang('orders.first_address')" class="form-control" id="add1" name="address">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="add2">@lang('orders.address') 2:</label>
								<input type="text" placeholder="@lang('orders.second_address')" class="form-control" id="add2" name="address_2">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="city">@lang('users.city'): <span class="text-danger">*</span></label>
								<input required type="text" value="@auth{{auth()->user()->city}}@endauth" class="form-control" id="city" name="city" placeholder="@lang('users.city_ph')">
							</div>
							<div class="col-md-12 form-group mb-5">
								<label for="city">@lang('users.z_code'): <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" value="@auth{{auth()->user()->zip_code}}@endauth" id="zip" name="zip_code" placeholder="@lang('users.z_code_ph')">
							</div>
							<div class="col-md-12">
								<h3>@lang('orders.ship_details')</h3>
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
                                    <p class="pl-0">@lang('orders.collect_order')</p>
                                    <input type="radio" id="store_yes" required name="pickup_at_store" value="yes"> <label for="store_yes" class="mr-5">@lang('users.pickup')</label>
									<input type="radio" id="store_no" required name="pickup_at_store" value="no"> <label for="store_no">@lang('orders.to_country')</label>
								</div>
                            </div>
							<div id="shipping_address" class="col-md-12 form-group d-none">
								<div class="creat_account">
                                    <p class="pl-0">@lang('orders.diff_ship')</p>
                                    <input type="radio" id="yes" name="diff_shipping_address" value="yes"> <label for="yes" class="mr-5">@lang('orders.yes')</label>
									<input type="radio" id="no" selected name="diff_shipping_address" value="no"> <label for="no">@lang('orders.no')</label>
								</div></div>
							<div id="shipping_details" class="d-none">
							<div class="col-md-12">
								<h3>@lang('orders.ship_details')</h3>
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="shipping_add1">@lang('orders.address'): <span class="text-danger">*</span></label>
								<input type="text" value="@auth{{auth()->user()->street_address}}@endauth" placeholder="@lang('orders.first_address')" class="form-control" id="shipping_add1" name="shipping_address">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="shipping_add2">@lang('orders.address') 2:</label>
								<input type="text" placeholder="@lang('orders.second_address')" class="form-control" id="shipping_add2" name="shipping_address_2">
							</div>
							<div class="col-md-12 form-group p_star">
								<label for="shipping_city">@lang('users.city'): <span class="text-danger">*</span></label>
								<input type="text" value="@auth{{auth()->user()->city}}@endauth" class="form-control" id="shipping_city" name="shipping_city" placeholder="@lang('users.city_ph')">
							</div>
							<div class="col-md-12 form-group mb-5">
								<label for="shipping_zip">@lang('users.z_code'): <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="@auth{{auth()->user()->zip_code}}@endauth" id="shipping_zip" name="shipping_zip_code" placeholder="@lang('users.z_code_ph')">
							</div>
						</div>
							<div class="col-md-12 form-group">
								<label for="message">@lang('orders.order_notes'):</label>
								<textarea class="form-control" name="order_notes" id="message" rows="1" placeholder="@lang('orders.order_notes_ph')"></textarea>
							</div>
							@guest
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" checked id="create_account" name="create_account">
									<label for="create_account">@lang('orders.create_account')</label>
								</div>
							</div>
							@endguest
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="toc" required name="accepted_toc">
									<label for="toc">@lang('orders.read_n_accepted') <a href="{{route('privacyPolicy')}}" target="_blank">@lang('orders.privacy_policy')</a> @lang('orders.and') <a href="{{route('toc')}}" target="_blank">@lang('orders.terms')</a></label>
								</div>
							</div>
							<input hidden name="order_weight" value="{{$OrderWeight}}">
							<input hidden name="order_tax_rate" value="{{$CartTaxAvg}}">
							<input hidden name="total_amount" value="{{$TotalWithoutTax}}">
							<input hidden name="total_tax_amount" value="{{$CartTax}}">
							<input hidden name="total_shipping_cost" value="0">
							<input hidden name="total_shipping_tax" value="0">
							<div class="col-md-12 form-group">
								<button class="main_btn" type="submit" disabled title="@lang('orders.choose_country_first')">@lang('orders.to_summary')</button>
							</div>
						</form>
					</div>
					<div class="col-lg-5">
						<div class="order_box p-3 mb-4">
							<h2>@lang('orders.ur_order')</h2>
							<ul class="list">
								@forelse ($CartItems as $CartItem)
								<li>
									<a href="#">{{$CartItem->Product->local_title}} <b class="text-primary">X{{$CartItem->qty}}</b>
										<span class="last">{{formatPrice($CartItem->total_price).getCurrency()['symbole']}}</span>
									</a>
								</li>
								<li>
									<a href="#">
										@lang('orders.order_tax')
										<span class="last">{{formatPrice($CartTax).getCurrency()['symbole']}}</span>
									</a>
								</li>
								@empty
								@endforelse
								@if($CouponDiscount)
									<li>
										<a href="#">@lang('orders.coupon_discount') <span class="last text-success">- {{formatPrice($CouponDiscount).getCurrency()['symbole']}}</span></a>
									</li>
								@endif
							</ul>
							<ul class="list list_2 mb-5">
									<li><a href="#">@lang('orders.subtotal')<span>{{formatPrice($TotalWithoutTax+$CartTax).getCurrency()['symbole']}}</span></a></li>
							</ul>
						</div>
						<div class="shipping-box order_box p-3">
							<h2>@lang('orders.order_shipping')</h2>
							<p class="pl-0">@lang('orders.select_country_ship')</p>
							<ul class="list list_2">
								<li><a href="#">@lang('orders.ship_total')<span id="order_shipping_total">@lang('orders.choose_country_first')</span></a></li>
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
			$('#order_shipping_total').html('<i class="fas fa-spinner fa-spin"></i>');
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
					if(SiteCurrency == 'EUR'){
						console.log(response.actual_cost_eur);
					 	$('#order_shipping_cost').html(response.actual_cost_eur + '{{getCurrency()['symbole']}}');
						$('input[name="total_shipping_cost"]').attr('value',response.actual_cost_eur);
						$('#order_shipping_tax').html(response.shipping_tax_eur + '{{getCurrency()['symbole']}}');
						$('input[name="total_shipping_tax"]').attr('value',response.shipping_tax_eur);
						$('#order_shipping_total').html(response.final_cost_eur + '{{getCurrency()['symbole']}}');
					}else if(SiteCurrency == 'SEK'){
						$('#order_shipping_cost').html(response.actual_cost_sek + '{{getCurrency()['symbole']}}');
						$('input[name="total_shipping_cost"]').attr('value',response.actual_cost_sek);
						$('#order_shipping_tax').html(response.shipping_tax_sek + '{{getCurrency()['symbole']}}');
						$('input[name="total_shipping_tax"]').attr('value',response.shipping_tax_sek);
						$('#order_shipping_total').html(response.final_cost_sek + '{{getCurrency()['symbole']}}');
					}else{
						$('#order_shipping_cost').html(response.actual_cost_dkk + '{{getCurrency()['symbole']}}');
						$('input[name="total_shipping_cost"]').attr('value',response.actual_cost_dkk);
						$('#order_shipping_tax').html(response.shipping_tax_dkk + '{{getCurrency()['symbole']}}');
						$('input[name="total_shipping_tax"]').attr('value',response.shipping_tax_dkk);
						$('#order_shipping_total').html(response.final_cost_dkk + '{{getCurrency()['symbole']}}');
					}
					$('button[type="submit"]').removeAttr('disabled').removeAttr('title');
				},
				error: function(response) {
					$('#order_shipping_total').html('Select Country First');
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
