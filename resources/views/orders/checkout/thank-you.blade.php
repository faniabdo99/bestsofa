@include('layout.header')
<body>
    @include('layout.navbar')
	<!--================Order Details Area =================-->
	<section class="billing_details p_120 mt-5">
		<div class="container">
      @if($TheOrder->AlreadyPaid())
            <h4 class="text-success text-center mb-5">Thank you. Your order has been received.</h4>
          @else
            <h4 class="text-danger text-center mb-5">Sorry, Payment Failed !</h4>
          @endif
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
                        <td>{{formatPrice($OrderItem->Product->final_price).getCurrency()['symbole']}}
                        </td>
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
            <p class="pl-0">Collect From Warehouse (Be Sure to call one day ahead)</p>
            <p class="pl-0">Globale trading Zone 5 Mollem 13 1730 Asse , Belgium +32 487 24 45 99</p>
            @else
            <table class="table mb-5">
                <tbody>
                  <tr>
                      <th>Country</th>
                      <td>{{getCountryNameFromISO($TheOrder->country)}}</td>
                  </tr>
                  <tr>
                    <th>City</th>
                    <td>{{$TheOrder->city}}</td>
                </tr>
                  <tr>
                    <th>Address</th>
                    <td>{{$TheOrder->address}}</td>
                </tr>
                <tr>
                    <th>ZIP / Postal Code</th>
                    <td>{{$TheOrder->zip_code}}</td>
                </tr>
                </tbody>
            </table>
            @endif
            <h3>Payments Details</h3>
            <table class="table mb-5">
                <tbody>
                  <tr>
                      <th>Payment Method</th>
                      <td>{{$TheOrder->PaymentMethodData['name']}}</td>
                  </tr>
                  <tr>
                    <th>Payment Status</th>
                    <td>{{$TheOrder->is_paid}}</td>
                </tr>
                  <tr>
                    <th>Order Status</th>
                    <td>{{$TheOrder->status}}</td>
                </tr>
                <tr>
                    <th>Order ID</th>
                    <td>{{$TheOrder->serial_number}}</td>
                </tr>
                <tr>
                    <th>Transaction ID</th>
                    <td>{{$TheOrder->payment_id}}</td>
                </tr>
                <tr>
                    <th>Order Total</th>
                    <td>{{formatPrice($TheOrder->final_total).getCurrency()['symbole']}}</td>
                </tr>
                </tbody>
            </table>
            <button id="print_page" class="main_btn no-print" href="#">Print This Page</button>
            @auth
                <a href="{{route('myOrders')}}" class="main_btn no-print" href="#">Veiw Your Orders</a>
            @endauth
        </div>
	</section>
	@include('layout.footer')
    @include('layout.scripts')
    <script>
        $('#print_page').click(function(){
            window.print();
        });
    </script>
