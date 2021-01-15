@include('admin.layout.header' , ['PageTitle' => 'Dashboard'])
<body class="app">
    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="row gap-20 masonry pos-r">
                        <div class="masonry-sizer col-md-6"></div>
                        <div class="masonry-item w-100">
                            <div class="row gap-20">
                                <div class="col-md-3">
                                    <div class="layers bd bgc-white p-20">
                                        <div class="layer w-100 mB-10">
                                            <h6 class="lh-1"><i class="fas fa-sitemap text-success"></i> Live Products</h6>
                                        </div>
                                        <div class="layer w-100">
                                            <div class="peers ai-sb fxw-nw">
                                                <a href="{{route('admin.products.home')}}"><div class="text-success font-weight-bold">{{$TotalProductsCount}}</div></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="layers bd bgc-white p-20">
                                        <div class="layer w-100 mB-10">
                                            <h6 class="lh-1"><i class="fas fa-dollar-sign"></i> Lifetime Orders</h6>
                                        </div>
                                        <div class="layer w-100">
                                            <div class="peers ai-sb fxw-nw">
                                                <div class="font-weight-bold">{{$TotalOrdersCount}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="layers bd bgc-white p-20">
                                        <div class="layer w-100 mB-10">
                                            <h6 class="lh-1"><i class="fas fa-user text-primary"></i> Total Users</h6>
                                        </div>
                                        <div class="layer w-100">
                                            <div class="peers ai-sb fxw-nw">
                                                <div class="text-primary font-weight-bold">{{$TotalUsersCount}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="layers bd bgc-white p-20">
                                        <div class="layer w-100 mB-10">
                                            <h6 class="lh-1"><i class="fas fa-users"></i> This Month Sales</h6>
                                        </div>
                                        <div class="layer w-100">
                                            <div class="peers ai-sb fxw-nw">
                                                <div>{{formatPrice($ThisMonthSales)}}€</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="masonry-item col-md-12">
                            <div class="bd bgc-white">
                                <div class="layers">
                                    <div class="layer w-100 p-20">
                                        <h6 class="lh-1">Pending Orders</h6>
                                    </div>
                                    <div class="layer w-100">
                                        <div class="table-responsive p-20">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="bdwT-0">ID</th>
                                                        <th class="bdwT-0">Date</th>
                                                        <th class="bdwT-0">Status</th>
                                                        <th class="bdwT-0">Payment Status</th>
                                                        <th class="bdwT-0">Payment Method</th>
                                                        <th class="bdwT-0">Total</th>
                                                        <th class="bdwT-0"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($LatestOrders as $Order)
                                                    <tr>
                                                        <td class="fw-600">{{$Order->serial_number}}</td>
                                                        <td>{{$Order->created_at->format('Y-m-d')}}</td>
                                                        <td><span class="badge bg-warning badge-pill">{{$Order->status}}</span></td>
                                                        <td>{{$Order->is_paid}}</td>
                                                        <td>{{$Order->PaymentMethodData['name']}}</td>
                                                        <td>{{formatPrice($Order->final_total).getCurrency()['symbole']}}</td>
                                                        <td><a href="{{route('admin.orders.single' , $Order->id)}}" class="text-success">Order Details</a></td>
                                                    </tr>
                                                    @empty

                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
