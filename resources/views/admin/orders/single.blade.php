@include('admin.layout.header')
<style>
    .single-item-in-list{
        background: #ececec;
        padding: 10px;
        margin-bottom: 15px;
    }
</style>
<body class="app">
    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100 mb-5">
                <div id="mainContent">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2>Order Details: <b>{{$TheOrder->serial_number}}</b></h2>
                                <div class="bgc-white p-20 bd mb-5">
                                    <h6>Order Items ({{$TheOrder->Items()->count()}})</h6>
                                        @forelse($TheOrder->Items() as $Item)
                                        <div class="single-item-in-list">
                                            <p class="mb-0"><b>Product Title :</b> {{$Item->Product->title}}</p>
                                            <p class="mb-0"><b>Quantity :</b> {{$Item->qty}}</p>
                                            <p class="mb-0"><b>Product Link :</b> <a href="{{route('product.single' , [$Item->Product->id , $Item->Product->slug])}}" target="_blank">Click Here</a></p>
                                        </div>
                                        
                                        @empty 
                                        <p>There is no items in this order</p>
                                        @endforelse
                                    </div>
                                    <div class="bgc-white p-20 bd mb-5">
                                        <h6>Customer Data</h6>
                                        <p class="mb-0"><b>First Name :</b> {{$TheOrder->first_name}}</p>
                                        <p class="mb-0"><b>Last Name :</b> {{$TheOrder->last_name}}</p>
                                        <p class="mb-0"><b>Company Name :</b> {{$TheOrder->company_name ?? 'N/A'}}</p>
                                        <p class="mb-0"><b>VAT Number :</b> {{$TheOrder->vat_number ?? 'N/A'}}</p>
                                        <p class="mb-0"><b>VAT Valid :</b> {{$TheOrder->is_vat_valid}}</p>
                                        <p class="mb-0"><b>Email :</b> {{$TheOrder->email}}</p>
                                        <p class="mb-0"><b>Phone Number :</b> {{$TheOrder->phone_number}}</p>
                                        <p class="mb-0"><b>is Registerd ?</b> @if(preg_match("/[a-z]/i", $TheOrder->user_id)) No @else Yes @endif</p>
                                    </div>
                                    <div class="bgc-white p-20 bd mb-5">
                                        <h6>Shipping Data</h6>
                                        @if($TheOrder->pickup_at_store == 'yes')
                                        <p><b>Pickup :</b> At Store</p>
                                        @else 
                                        <p class="mb-0"><b>Country :</b> {{getCountryNameFromISO($TheOrder->country)}}</p>
                                        <p class="mb-0"><b>City :</b> {{$TheOrder->shipping_city}}</p>
                                        <p class="mb-0"><b>Address 1 :</b> {{$TheOrder->shipping_address}}</p>
                                        <p class="mb-0"><b>Address 2 :</b> {{$TheOrder->shipping_address_2 ?? 'N/A'}}</p>
                                        <p class="mb-0"><b>ZIP Code :</b> {{$TheOrder->shipping_zip_code}}</p>
                                        @endif
                                    </div>
                                    <div class="bgc-white p-20 bd mb-5">
                                        <h6>Payment Data</h6>
                                        <p class="mb-0"><b>Transaction ID :</b> {{$TheOrder->payment_id ?? 'N/A'}}</p>
                                        <p class="mb-0"><b>Status :</b> {{$TheOrder->is_paid}}</p>
                                        <p class="mb-0"><b>Method :</b> {{$TheOrder->payment_method}}</p>
                                        <p class="mb-0"><b>Total Paid :</b> {{formatPrice($TheOrder->final_total).getCurrency()['symbole']}}</p>
                                        <p class="mb-0"><b>Order Tax :</b> {{formatPrice($TheOrder->total_tax_amount).getCurrency()['symbole']}}</p>
                                        <p class="mb-0"><b>Order Shipping Cost :</b> {{formatPrice($TheOrder->total_shipping_cost + $TheOrder->total_shipping_tax).getCurrency()['symbole']}}</p>
                                    </div>
                                    <div class="bgc-white p-20 bd mb-5">
                                        <h6>Additional Data</h6>
                                        <p class="mb-0"><b>Order Weight :</b> {{$TheOrder->order_weight}}</p>
                                        <p class="mb-0"><b>Order Additional Notes :</b><br>
                                            {{$TheOrder->order_notes ?? 'N/A'}}
                                        </p>
                                    </div>
                                    <form class="mb-5" action="{{route('admin.orders.updateStatus' , $TheOrder->id)}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label>Order Status *</label>
                                            <select name="order_status" class="form-control" required>
                                                <option value="">Choose Order Status</option>
                                                <option value="Shipped">Shipped</option>
                                                <option value="Refuded">Refunded</option>
                                                <option value="Complete">Complete</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Update Order Status</button>
                                    </form>
                                    <a href="#" class="btn btn-primary">Print Invoice</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('admin.layout.scripts')
</body>

</html>
