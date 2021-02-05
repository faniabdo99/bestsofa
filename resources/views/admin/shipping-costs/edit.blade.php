@include('admin.layout.header')
<body class="app">
    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2>Edit Discount <b>{{$TheSCData->coupoun_code}}</b></h2>
                                <div class="bgc-white p-20 bd">
                                    <div class="mT-30">
                                        <form action="{{route('admin.shippingCosts.postEdit' , $TheSCData->id)}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label>Shipping Method:</label>
                                                <select class="form-control" name="shipping_method" required>
                                                  <option value="{{$TheSCData->shipping_method}}" selected>{{$TheSCData->shipping_method}}</option>
                                                    <option value="Pickup in the store">Pickup in the store</option>
                                                    <option value="Standard delivery">Standard delivery</option>
                                                    <option value="Collect on delivery">Collect on delivery</option>
                                                    <option value="Pickup at collection point">Pickup at collection point</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select name="country_name" class="form-control" required>
                                                  <option value="{{$TheSCData->country_name}}" selected>{{$TheSCData->country_name}}</option>
                                                  <option value="DE">Germany</option>
                                                  <option value="SYD">SYD - Denmark</option>
                                                  <option value="VEST">VEST - Denmark</option>
                                                  <option value="OST">OST - Denmark</option>
                                                  <option value="SE">Sweden</option>
                                                  <option value="NL">Netherlands</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Wight From</label>
                                                <input type="number" class="form-control" name="weight_from" value="{{old('weight_from') ?? $TheSCData->weight_from}}" placeholder="Enter a Number Here ..." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Wight To</label>
                                                <input type="number" class="form-control" name="weight_to" value="{{old('weight_to') ?? $TheSCData->weight_to}}" placeholder="Enter a Number Here ..." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Cost in Euro</label>
                                                <input type="number" step="0.1" class="form-control" name="cost" value="{{old('cost') ?? $TheSCData->cost}}" placeholder="Enter a Number Here ..." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Additional Notes (optional)</label>
                                                <textarea name="comments" class="form-control" rows="6" placeholder="Enter Your Notes Here">{{old('comments') ?? $TheSCData->comments}}</textarea>
                                            </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
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
    <script>
        //Auto Create Clean Slug...
        var SlugValue;
        $('input[name="title"]').keyup(function () {
            SlugValue = $(this).val().replace(/\s+/g, '-').replace(/[^a-zA-Z ]/g, "-").toLowerCase();
            //Assign the value to the input
            $('input[name="slug"]').val(SlugValue);
        });

    </script>
</body>

</html>
