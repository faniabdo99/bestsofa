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
                                                <div class="text-success font-weight-bold">255</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="layers bd bgc-white p-20">
                                        <div class="layer w-100 mB-10">
                                            <h6 class="lh-1"><i class="fas fa-dollar-sign"></i> Life Time Sales</h6>
                                        </div>
                                        <div class="layer w-100">
                                            <div class="peers ai-sb fxw-nw">
                                                <div class="font-weight-bold">250,000 $</div>
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
                                                <div class="text-primary font-weight-bold">254</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="layers bd bgc-white p-20">
                                        <div class="layer w-100 mB-10">
                                            <h6 class="lh-1"><i class="fas fa-users"></i> Today's Visitors</h6>
                                        </div>
                                        <div class="layer w-100">
                                            <div class="peers ai-sb fxw-nw">
                                                <div>450</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="masonry-item col-md-6">
                            <div class="bd bgc-white">
                                <div class="layers">
                                    <div class="layer w-100 p-20">
                                        <h6 class="lh-1">Sales Report</h6>
                                    </div>
                                    <div class="layer w-100">
                                        <div class="bgc-light-blue-500 c-white p-20">
                                            <div class="peers ai-c jc-sb gap-40">
                                                <div class="peer peer-greed">
                                                    <h5>November 2017</h5>
                                                    <p class="mB-0">Sales Report</p>
                                                </div>
                                                <div class="peer">
                                                    <h3 class="text-right">$6,000</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive p-20">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="bdwT-0">Name</th>
                                                        <th class="bdwT-0">Status</th>
                                                        <th class="bdwT-0">Date</th>
                                                        <th class="bdwT-0">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-600">Item #1 Name</td>
                                                        <td><span class="badge bgc-red-50 c-red-700 p-10 lh-0 tt-c badge-pill">Unavailable</span></td>
                                                        <td>Nov 18</td>
                                                        <td><span class="text-success">$12</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-600">Item #2 Name</td>
                                                        <td><span class="badge bgc-deep-purple-50 c-deep-purple-700 p-10 lh-0 tt-c badge-pill">New</span></td>
                                                        <td>Nov 19</td>
                                                        <td><span class="text-info">$34</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-600">Item #3 Name</td>
                                                        <td><span class="badge bgc-pink-50 c-pink-700 p-10 lh-0 tt-c badge-pill">New</span></td>
                                                        <td>Nov 20</td>
                                                        <td><span class="text-danger">-$45</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-600">Item #4 Name</td>
                                                        <td><span class="badge bgc-green-50 c-green-700 p-10 lh-0 tt-c badge-pill">Unavailable</span></td>
                                                        <td>Nov 21</td>
                                                        <td><span class="text-success">$65</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-600">Item #5 Name</td>
                                                        <td><span class="badge bgc-red-50 c-red-700 p-10 lh-0 tt-c badge-pill">Used</span></td>
                                                        <td>Nov 22</td>
                                                        <td><span class="text-success">$78</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-600">Item #6 Name</td>
                                                        <td><span class="badge bgc-orange-50 c-orange-700 p-10 lh-0 tt-c badge-pill">Used</span></td>
                                                        <td>Nov 23</td>
                                                        <td><span class="text-danger">-$88</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-600">Item #7 Name</td>
                                                        <td><span class="badge bgc-yellow-50 c-yellow-700 p-10 lh-0 tt-c badge-pill">Old</span></td>
                                                        <td>Nov 22</td>
                                                        <td><span class="text-success">$56</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="ta-c bdT w-100 p-20"><a href="#">Check all the sales</a></div>
                            </div>
                        </div>
                        <div class="masonry-item col-md-6">
                            <div class="bd bgc-white p-20">
                                <div class="layers">
                                    <div class="layer w-100 mB-20">
                                        <h6 class="lh-1">Weather</h6>
                                    </div>
                                    <div class="layer w-100">
                                        <div class="peers ai-c jc-sb fxw-nw">
                                            <div class="peer peer-greed">
                                                <div class="layers">
                                                    <div class="layer w-100">
                                                        <div class="peers fxw-nw ai-c">
                                                            <div class="peer mR-20">
                                                                <h3>32<sup>°F</sup></h3>
                                                            </div>
                                                            <div class="peer"><canvas class="sleet" width="44" height="44"></canvas></div>
                                                        </div>
                                                    </div>
                                                    <div class="layer w-100"><span class="fw-600 c-grey-600">Partly Clouds</span></div>
                                                </div>
                                            </div>
                                            <div class="peer">
                                                <div class="layers ai-fe">
                                                    <div class="layer">
                                                        <h5 class="mB-5">Monday</h5>
                                                    </div>
                                                    <div class="layer"><span class="fw-600 c-grey-600">Nov, 01 2017</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layer w-100 mY-30">
                                        <div class="layers bdB">
                                            <div class="layer w-100 bdT pY-5">
                                                <div class="peers ai-c jc-sb fxw-nw">
                                                    <div class="peer"><span>Wind</span></div>
                                                    <div class="peer ta-r"><span class="fw-600 c-grey-800">10km/h</span></div>
                                                </div>
                                            </div>
                                            <div class="layer w-100 bdT pY-5">
                                                <div class="peers ai-c jc-sb fxw-nw">
                                                    <div class="peer"><span>Sunrise</span></div>
                                                    <div class="peer ta-r"><span class="fw-600 c-grey-800">05:00 AM</span></div>
                                                </div>
                                            </div>
                                            <div class="layer w-100 bdT pY-5">
                                                <div class="peers ai-c jc-sb fxw-nw">
                                                    <div class="peer"><span>Pressure</span></div>
                                                    <div class="peer ta-r"><span class="fw-600 c-grey-800">1B</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layer w-100">
                                        <div class="peers peers-greed ai-fs ta-c">
                                            <div class="peer">
                                                <h6 class="mB-10">MON</h6><canvas class="sleet" width="30" height="30"></canvas><span class="d-b fw-600">32<sup>°F</sup></span>
                                            </div>
                                            <div class="peer">
                                                <h6 class="mB-10">TUE</h6><canvas class="clear-day" width="30" height="30"></canvas><span class="d-b fw-600">30<sup>°F</sup></span>
                                            </div>
                                            <div class="peer">
                                                <h6 class="mB-10">WED</h6><canvas class="partly-cloudy-day" width="30" height="30"></canvas><span class="d-b fw-600">28<sup>°F</sup></span>
                                            </div>
                                            <div class="peer">
                                                <h6 class="mB-10">THR</h6><canvas class="cloudy" width="30" height="30"></canvas><span class="d-b fw-600">32<sup>°F</sup></span>
                                            </div>
                                            <div class="peer">
                                                <h6 class="mB-10">FRI</h6><canvas class="snow" width="30" height="30"></canvas><span class="d-b fw-600">24<sup>°F</sup></span>
                                            </div>
                                            <div class="peer">
                                                <h6 class="mB-10">SAT</h6><canvas class="wind" width="30" height="30"></canvas><span class="d-b fw-600">28<sup>°F</sup></span>
                                            </div>
                                            <div class="peer">
                                                <h6 class="mB-10">SUN</h6><canvas class="sleet" width="30" height="30"></canvas><span class="d-b fw-600">32<sup>°F</sup></span>
                                            </div>
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
