@include('layout.header')

<body>
    @include('layout.navbar')
    <!--================Home Banner Area =================-->
    <section class="banner_area section_gap">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h1>Payments</h1>
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
                        <h3>Payments Details</h3>
                        <form class="row contact_form pl-0" action="{{route('checkout.payment.post' , $TheOrder->id)}}" method="post">
                            <div class="col-md-12 form-group">
                                @csrf
                                <input hidden name="user_id" value="{{$TheOrder->user_id}}" required>
                                <div class="form-group">
                                    <label for="pm">Choose Payment Method</label>
                                    <select class="form-control" name="payment_method" id="pm" required>
                                        <option value="">Select...</option>
                                        <option value="banktransfer">Bank transfer</option>
                                        <option value="bancontact">Bancontact / MisterCash</option>
                                        <option value="ideal">iDEAL</option>
                                        @if($TheOrder->pickup_at_store == 'yes')
                                          <option value="paymentoncollection">Payment on collection</option>
                                        @endif
                                        <option value="paypal">PayPal (3.5%)</option>
                                        <option value="sofort">Sofortbanking</option>
                                        <option value="creditcard">Credit card (3.5%)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="main_btn" type="submit">Submit</button>
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
