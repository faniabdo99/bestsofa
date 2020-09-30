@include('layout.header',['PageTitle' => __('titles.thank-you')])
<body>
    @include('layout.navbar')
	<!--================Order Details Area =================-->
	<section class="billing_details p_120 mt-5">
		<div class="container">
      @if($TheOrder->AlreadyPaid())
            <h4 class="text-success text-center mb-5">@lang('orders.order_received')</h4>
          @else
            <h4 class="text-danger text-center mb-5">@lang('orders.payment_failed')</h4>
          @endif
            <h3>@lang('orders.order_summary')</h3>
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th>@lang('orders.product')</th>
                        <th>@lang('orders.qty')</th>
                        <th>@lang('orders.unit_price')</th>
                        <th>@lang('orders.total')</th>
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
                        <th>@lang('orders.order_total')</th>
                        <td>{{formatPrice($TheOrder->total).getCurrency()['symbole']}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>@lang('orders.order_tax')</th>
                        <td>{{formatPrice($TheOrder->total_tax).getCurrency()['symbole']}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>@lang('orders.order_shipping_cost')</th>
                        <td>{{formatPrice($TheOrder->total_shipping).getCurrency()['symbole']}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>@lang('orders.total')</th>
                        <td>{{formatPrice($TheOrder->final_total).getCurrency()['symbole']}}</td>
                    </tr>
                </tbody>
            </table>
            <h3>@lang('orders.your_details')</h3>
            <table class="table mb-5">
                <tbody>
                  <tr>
                      <th>@lang('users.first_name')</th>
                      <td>{{$TheOrder->first_name}}</td>
                  </tr>
                  <tr>
                    <th>@lang('users.last_name')</th>
                    <td>{{$TheOrder->last_name}}</td>
                </tr>
                <tr>
                    <th>@lang('users.phone')</th>
                    <td>{{$TheOrder->phone_number}}</td>
                </tr>
                <tr>
                    <th>@lang('users.email')</th>
                    <td>{{$TheOrder->email}}</td>
                </tr>
                </tbody>
            </table>
            <h3>@lang('orders.shipping_details')</h3>
            @if($TheOrder->pickup_at_store == 'yes')
            <p class="pl-0">@lang('orders.collect_from_warehouse')</p>
            <p class="pl-0">@lang('orders.warehouse_address')</p>
            @else
            <table class="table mb-5">
                <tbody>
                  <tr>
                      <th>@lang('users.country')</th>
                      <td>{{getCountryNameFromISO($TheOrder->country)}}</td>
                  </tr>
                  <tr>
                    <th>@lang('users.city')</th>
                    <td>{{$TheOrder->city}}</td>
                </tr>
                  <tr>
                    <th>@lang('orders.address')</th>
                    <td>{{$TheOrder->address}}</td>
                </tr>
                <tr>
                    <th>@lang('users.z_code')</th>
                    <td>{{$TheOrder->zip_code}}</td>
                </tr>
                </tbody>
            </table>
            @endif
            <h3>@lang('orders.payments_details')</h3>
            <table class="table mb-5">
                <tbody>
                  <tr>
                      <th>@lang('orders.payments_details')</th>
                      <td>{{$TheOrder->PaymentMethodData['name']}}</td>
                  </tr>
                  <tr>
                    <th>@lang('orders.payment_status')</th>
                    <td>{{$TheOrder->is_paid}}</td>
                </tr>
                  <tr>
                    <th>@lang('orders.order_status')</th>
                    <td>{{$TheOrder->status}}</td>
                </tr>
                <tr>
                    <th>@lang('orders.order_ID')</th>
                    <td>{{$TheOrder->serial_number}}</td>
                </tr>
                <tr>
                    <th>@lang('orders.trans_ID')</th>
                    <td>{{$TheOrder->payment_id}}</td>
                </tr>
                <tr>
                    <th>@lang('orders.order_total')</th>
                    <td>{{formatPrice($TheOrder->final_total).getCurrency()['symbole']}}</td>
                </tr>
                </tbody>
            </table>
            <button id="print_page" class="main_btn no-print" href="#">@lang('orders.print')</button>
            @auth
                <a href="{{route('myOrders')}}" class="main_btn no-print" href="#">@lang('orders.view_orders')</a>
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
