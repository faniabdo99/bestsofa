@include('layout.header' , ['PageTitle' => 'My Orders'])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Login Box Area =================-->
    <section class="feature_product_area section_gap mt-5">
		<div class="main_box">
			<div class="container-fluid">
				<div class="row">
					<div class="main_title">
						<h2>My Orders</h2>
					</div>
				</div>
				<div class="row">
                    <div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th style="width:35%">Order ID</th>
									<th style="width:15%">Status</th>
									<th style="width:15%">Collection</th>
									<th style="width:15%">Weight</th>
									<th style="width:10%">Payment Method</th>
									<th style="width:10%">Total Price</th>
								</tr>
							</thead>
							<tbody>
                                @forelse($TheUser->Orders() as $Order)
                                <tr>
                                    <td>{{$Order->serial_number}}</td>
                                    <td>{{$Order->status}}</td>
                                    <td>@if($Order->pickup_at_store == 'yes') Pickup at Warehouse @else Shipping To {{getCountryNameFromISO($Order->country).', '.$Order->shipping_city}} @endif</td>
                                    <td>{{$Order->order_weight}} KG</td>
                                    <td>@if($Order->payment_method == '0') N/A @else {{$Order->payment_method }} @endif</td>
                                    <td>{{formatPrice($Order->final_total).getCurrency()['symbole']}}</td>
                   
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
