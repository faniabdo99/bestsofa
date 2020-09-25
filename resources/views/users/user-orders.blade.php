@include('layout.header' , ['PageTitle' => __('titles.user-orders')])

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
                                    <th style="width:20%">Order ID</th>
                                    <th style="width:15%">Status</th>
                                    <th style="width:15%">Collection</th>
                                    <th style="width:10%">Weight</th>
                                    <th style="width:15%">Payment Method</th>
                                    <th style="width:10%">Total Price</th>
                                    <th style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($TheUser->Orders() as $Order)
                                    <tr>
                                        <td style="width:20%">{{$Order->serial_number}}</td>
                                        <td style="width:15%">{{$Order->status}}</td>
                                        <td style="width:15%">
                                            @if($Order->pickup_at_store == 'yes') Pickup at Warehouse
                                                @else Shipping To {{getCountryNameFromISO($Order->country).', '.$Order->shipping_city}}
                                                @endif</td>
                                        <td style="width:10%">{{$Order->order_weight}} KG</td>
                                        <td style="width:15%">{{$Order->PaymentMethodData['name']}}</td>
                                        <td style="width:10%">{{formatPrice($Order->final_total).getCurrency()['symbole']}}</td>
                                        <td style="width:15%"><a href="{{route('checkout.summary' , [$Order->id , true])}}">Summary</a> @if(!$Order->AlreadyPaid()) - <a href="{{route('checkout.payment' , $Order->id)}}">Pay</a>@endif</td>
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
