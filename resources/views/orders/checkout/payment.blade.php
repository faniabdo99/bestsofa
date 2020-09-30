@include('layout.header', ['PageTitle' => __('titles.payment')])
<body>
    @include('layout.navbar')
    <!--================Home Banner Area =================-->
    <section class="banner_area" id="orders-hero">
        <div class="banner_inner">
            <div class="container">
                <div class="banner_content text-center">
                    
                    <h1>@lang('orders.payments')</h1>
                    <p>@lang('orders.secure_and_reliable')</p>
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
                        <h3>@lang('orders.payments_details')</h3>
                        <form class="row contact_form pl-0" action="{{route('checkout.payment.post' , $TheOrder->id)}}" method="post">
                            <div class="col-md-12 form-group">
                                @csrf
                                <input hidden name="user_id" value="{{$TheOrder->user_id}}" required>
                                <div class="form-group">
                                    <label for="pm">@lang('orders.choose_payment_method')</label>
                                    <select class="form-control" name="payment_method" id="pm" required>
                                        <option value="">@lang('orders.select')...</option>
                                        {{getPaymentMethods($TheOrder->pickup_at_store)}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="main_btn" type="submit">@lang('orders.submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
    @include('layout.footer')
    @include('layout.scripts')
