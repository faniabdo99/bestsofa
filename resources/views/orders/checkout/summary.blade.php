@include('layout.header', ['PageTitle' => __('titles.summary')])

<body>
    @include('layout.navbar')
    <!--================Home Banner Area =================-->
    <!--================Home Banner Area =================-->
    <section class="banner_area" id="orders-hero">
        <div class="banner_inner">
            <div class="container">
                <div class="banner_content text-center">
                    @if(isset(request()->route()->parameters()['processed']) && request()->route()->parameters()['processed'])
                        <h1>@lang('orders.order_details')</h1>
                        <p>@lang('orders.your_order_data')</p>
                        @else
                        <h1>@lang('orders.checkout')</h1>
                        <p>@lang('orders.one_more_step') ...</p>
                        @endif
                </div>
            </div>
        </div>
    </section>
    <!--================Checkout Area =================-->
    <section class="checkout_area">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-12">
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
                                    <td>{{formatPrice($OrderItem->Product->final_price).getCurrency()['symbole']}}</td>
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
                                    <th>Total</th>
                                    <td>{{formatPrice($TheOrder->final_total).getCurrency()['symbole']}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h3>@lang('orders.order_details')</h3>
                        <table class="table mb-5">
                            <tbody>
                              <tr>
                                  <th>@lang('orders.order_ID')</th>
                                  <td>{{$TheOrder->serial_number}}</td>
                              </tr>
                                <tr>
                                    <th>@lang('orders.order_status')</th>
                                    <td>{{$TheOrder->status}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('orders.payment_status')</th>
                                    <td>{{$TheOrder->is_paid}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('orders.payment_method')</th>
                                    <td>{{$TheOrder->PaymentMethodData['name']}}</td>
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
                                @if($TheOrder->company_name)
                                    <tr>
                                        <th>@lang('users.company_name')</th>
                                        <td>{{$TheOrder->company_name}}</td>
                                    </tr>
                                    @endif
                                    @if($TheOrder->vat_number)
                                        <tr>
                                            <th>@lang('users.vat_num')</th>
                                            <td>{{$TheOrder->vat_number}}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('orders.is_vat_valid')</th>
                                            <td>{{$TheOrder->is_vat_valid}}</td>
                                        </tr>
                                        @endif
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
                        <h3>@lang('orders.ship_details')</h3>
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
                                        <td>{{$TheOrder->shipping_city}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('orders.address')</th>
                                        <td>{{$TheOrder->shipping_address}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('users.z_code')</th>
                                        <td>{{$TheOrder->shipping_zip_code}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                    </div>
                </div>
                @if(!isset(request()->route()->parameters()['processed']))
                    <div class="row">
                        <div class="col-12">
                            <a href="{{route('checkout.payment' , $TheOrder->id)}}" class="btn btn-primary" id="next_step">@lang('orders.next_step')</a>
                        </div>
                    </div>
                    @endif
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
    @include('layout.footer')
    @include('layout.scripts')
