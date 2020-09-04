@include('layout.header')
@if($TheOrder->is_vat_valid == 'yes')
@else
<style>
    #vat_number_form {
        display: none;
    }

</style>
@endif

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
                    <div class="col-lg-12">
                        <h3>Order Summary</h3>
                        <table class="table mb-5">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($OrderItems as $OrderItem)
                                <tr>
                                    <td>{{$OrderItem->Product->local_title}}</td>
                                    <td>{{$OrderItem->qty}}</td>
                                    <td>{{formatPrice($OrderItem->Product->final_price).getCurrency()['symbole']}}</td>
                                    <td>{{formatPrice($OrderItem->qty*$OrderItem->Product->final_price).getCurrency()['symbole']}}
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th>Order Total</th>
                                    <td>{{formatPrice($TheOrder->total).getCurrency()['symbole']}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th>Order Tax</th>
                                    <td>{{formatPrice($TheOrder->total_tax).getCurrency()['symbole']}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th>Order Shipping Cost</th>
                                    <td>{{formatPrice($TheOrder->total_shipping).getCurrency()['symbole']}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th>Total</th>
                                    <td>{{formatPrice($TheOrder->final_total).getCurrency()['symbole']}}</td>
                                </tr>
                            </tbody>
						</table>
						<h3>Your Details</h3>
						<table class="table mb-5">
                            <tbody>
                              <tr>
								  <th>First Name</th>
								  <td>{{$TheOrder->first_name}}</td>
							  </tr>
							  <tr>
								<th>Last Name</th>
								<td>{{$TheOrder->last_name}}</td>
                            </tr>
                            @if($TheOrder->company_name)
                            <tr>
								<th>Company Name</th>
								<td>{{$TheOrder->company_name}}</td>
                            </tr>
                            @endif
                            @if($TheOrder->vat_number)
                            <tr>
								<th>VAT Number</th>
								<td>{{$TheOrder->vat_number}}</td>
                            </tr>
                            <tr>
								<th>is VAT Number Valid ?</th>
								<td>{{$TheOrder->is_vat_valid}}</td>
                            </tr>
                            @endif
							<tr>
								<th>Phone Number</th>
								<td>{{$TheOrder->phone_number}}</td>
							</tr>
							<tr>
								<th>Email Address</th>
								<td>{{$TheOrder->email}}</td>
							</tr>
                            </tbody>
                        </table>
                        
                        <h3>Shipping Details</h3>
                        @if($TheOrder->pickup_at_store == 'yes')
                        <p class="pl-0">Collect From Warehouse</p>
                        <p class="pl-0">Add Warehouse Location Here</p>
                        @else
						<table class="table mb-5">
                            <tbody>
                              <tr>
								  <th>Country</th>
								  <td>{{getCountryNameFromISO($TheOrder->country)}}</td>
							  </tr>
							  <tr>
								<th>City</th>
								<td>{{$TheOrder->shipping_city}}</td>
							</tr>
							  <tr>
								<th>Address</th>
								<td>{{$TheOrder->shipping_address}}</td>
							</tr>
							<tr>
								<th>ZIP / Postal Code</th>
								<td>{{$TheOrder->shipping_zip_code}}</td>
							</tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
				</div>
				<div class="row">
					<div class="col-12">
						<a href="{{route('checkout.payment' , $TheOrder->id)}}" class="btn btn-primary" id="next_step">Looks Good , Next Step</a>
						{{-- <a href="{{route('checkout' , $TheOrder->id)}}" class="btn btn-warning" id="next_step">Go Back</a> --}}
					</div>
				</div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
    @include('layout.footer')
    @include('layout.scripts')
