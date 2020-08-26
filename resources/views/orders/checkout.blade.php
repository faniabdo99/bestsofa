@include('layout.header')
<body>
@include('layout.navbar')
<!--================Home Banner Area =================-->
	<section class="banner_area section_gap">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<h1>Checkout</h1>
          <p class="text-white">Your Have 10 Items in Your Cart</p>
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
						<form class="row contact_form" action="#" method="post">
							<div class="col-md-6 form-group p_star">
                <label for="first">First Name: <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" placeholder="Enter Your First Name" id="first" name="name" value="@auth {{auth()->user()->name}} @endauth">
							</div>
							<div class="col-md-6 form-group p_star">
                <label for="last">Last Name: <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" placeholder="Enter Your Last Name" id="last" name="name">
							</div>
							<div class="col-md-12 form-group">
                <label for="last">Company / Store Name:</label>
								<input type="text" class="form-control" id="company" name="company" value="@auth{{auth()->user()->company_name}}@endauth" placeholder="Enter Company / Store name">
							</div>
							<div class="col-md-6 form-group p_star">
                <label for="number">Phone Number: <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" id="number" value="@auth{{auth()->user()->phone_number}}@endauth" name="number" placeholder="Enter Your Phone Number">
							</div>
							<div class="col-md-6 form-group p_star">
                <label for="number">Email Address: <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" value="@auth{{auth()->user()->email}}@endauth"  id="email" name="compemailany" placeholder="Enter Your Email Address">
							</div>
							<div class="col-md-12 form-group p_star">
                <label for="country">Shipping Country: <span class="text-danger">*</span></label>
								<select required name="country" id="country" class="form-control">
                  <option value="">Choose Your Country</option>
									@forelse ($ShippingCostCountries as $Country)
										<option value="{{$Country}}">{{getCountryNameFromISO($Country)}}</option>
									@empty
									@endforelse
								</select>
							</div>
							<div class="col-md-12 form-group p_star">
                <label for="add1">Address: <span class="text-danger">*</span></label>
								<input required type="text" value="@auth{{auth()->user()->street_address}}@endauth" placeholder="Enter Your Address Here" class="form-control" id="add1" name="add1">
							</div>
							<div class="col-md-12 form-group p_star">
                <label for="add2">Address 2:</label>
								<input type="text" placeholder="Enter Your Second Address Here"  class="form-control" id="add2" name="add2">
							</div>
							<div class="col-md-12 form-group p_star">
                <label for="city">City: <span class="text-danger">*</span></label>
								<input required type="text" value="@auth{{auth()->user()->city}}@endauth"  class="form-control" id="city" name="city">
							</div>
							<div class="col-md-12 form-group">
                <label for="city">ZIP Code: <span class="text-danger">*</span></label>
								<input required type="text" class="form-control" value="@auth{{auth()->user()->zip_code}}@endauth"  id="zip" name="zip" placeholder="Enter Your Postcode/ZIP">
							</div>
              <div class="col-md-12 form-group">
                <label for="vat">VAT Number: <span class="text-danger">*</span> <a id="validate_vat_number" href="javascript:;">Click to Validate Your VAT</a></label>
                <input required type="text" class="form-control" value="@auth{{auth()->user()->vat_number}}@endauth"  id="vat" name="vat_number" placeholder="Enter Your VAT Number">
                <input type="text" name="is_vat_valid" value="no" hidden>
              </div>
              <div class="col-md-12">
                <p id="vat_validation_resulte" class="text-danger pl-0">Your VAT Number is not Valid!</p>
              </div>
              <div class="col-md-12 form-group">
                <label for="message">Order Notes:</label>
                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Please Add Any Additional Information to Your Order"></textarea>
              </div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" checked id="create_account" name="selector">
									<label for="create_account">Create an account?</label>
								</div>
							</div>
              <div class="col-md-12 form-group">
                <div class="creat_account">
                  <input type="checkbox" id="toc" name="selector">
                  <label for="toc">I've Read and Accepted Privacy Policy and Terms & Conditions</label>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <button class="main_btn" type="submit" name="button">Porcced to Payments</button>
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
										<span class="last">{{$CartItem->total_price.getCurrency()['symbole']}}</span>
									</a>
								</li>
              @empty
              @endforelse

							</ul>
							<ul class="list list_2 mb-5">
								<li><a href="#">Subtotal<span>{{$Total.getCurrency()['symbole']}}</span></a></li>
                <li><a href="#">Tax<span>{{$CartTax.getCurrency()['symbole']}}</span></a></li>
								<li><a href="#">Shipping<span>{{$CartTax.getCurrency()['symbole']}}</span></a></li>
								<li><a href="#">Total<span>$2210.00</span></a>
								</li>
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
