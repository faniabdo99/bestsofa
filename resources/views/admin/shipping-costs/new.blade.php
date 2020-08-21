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
                                <h2>Add New Shipping Cost Data</h2>
                                <div class="bgc-white p-20 bd">
                                    <div class="mT-30">
                                        <form action="{{route('admin.shippingCosts.postNew')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label>Shipping Method:</label>
                                                <select class="form-control" name="shipping_method" required>
                                                    <option value="Pickup in the store">Pickup in the store</option>
                                                    <option value="Standard delivery" selected="">Standard delivery</option>
                                                    <option value="Collect on delivery">Collect on delivery</option>
                                                    <option value="Pickup at collection point">Pickup at collection point</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select name="country_name" class="form-control" required>
                                                    <option value="GB">United Kingdom</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AT">Austria</option>
                                                    <option value="BY">Belarus</option>
                                                    <option value="BE">Belgium</option>
                                                    <option value="BA">Bosnia and Herzegovina</option>
                                                    <option value="BG">Bulgaria</option>
                                                    <option value="HR">Croatia (Hrvatska)</option>
                                                    <option value="CY">Cyprus</option>
                                                    <option value="CZ">Czech Republic</option>
                                                    <option value="FR">France</option>
                                                    <option value="GI">Gibraltar</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="GR">Greece</option>
                                                    <option value="VA">Holy See (Vatican City State)</option>
                                                    <option value="HU">Hungary</option>
                                                    <option value="IT">Italy</option>
                                                    <option value="LI">Liechtenstein</option>
                                                    <option value="LU">Luxembourg</option>
                                                    <option value="MK">Macedonia</option>
                                                    <option value="MT">Malta</option>
                                                    <option value="MD">Moldova</option>
                                                    <option value="MC">Monaco</option>
                                                    <option value="ME">Montenegro</option>
                                                    <option value="NL">Netherlands</option>
                                                    <option value="PL">Poland</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="RO">Romania</option>
                                                    <option value="SM">San Marino</option>
                                                    <option value="RS">Serbia</option>
                                                    <option value="SK">Slovakia</option>
                                                    <option value="SI">Slovenia</option>
                                                    <option value="ES">Spain</option>
                                                    <option value="UA">Ukraine</option>
                                                    <option value="DK">Denmark</option>
                                                    <option value="EE">Estonia</option>
                                                    <option value="FO">Faroe Islands</option>
                                                    <option value="FI">Finland</option>
                                                    <option value="GL">Greenland</option>
                                                    <option value="IS">Iceland</option>
                                                    <option value="IE">Ireland</option>
                                                    <option value="LV">Latvia</option>
                                                    <option value="LT">Lithuania</option>
                                                    <option value="NO">Norway</option>
                                                    <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                                    <option value="SE">Sweden</option>
                                                    <option value="CH">Switzerland</option>
                                                    <option value="TR">Turkey</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Wight From</label>
                                                <input type="number" class="form-control" name="weight_from" value="{{old('weight_from') ?? ''}}" placeholder="Enter a Number Here ..." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Wight To</label>
                                                <input type="number" class="form-control" name="weight_to" value="{{old('weight_to') ?? ''}}" placeholder="Enter a Number Here ..." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Cost in Euro</label>
                                                <input type="number" step="0.1" class="form-control" name="cost" value="{{old('cost') ?? ''}}" placeholder="Enter a Number Here ..." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Additional Notes (optional)</label>
                                                <textarea name="comments" class="form-control" rows="6" placeholder="Enter Your Notes Here"></textarea>
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
        $('input[name="title"]').keyup(function() {
            SlugValue = $(this).val().replace(/\s+/g, '-').replace(/[^a-zA-Z ]/g, "-").toLowerCase();
            //Assign the value to the input
            $('input[name="slug"]').val(SlugValue);
        });
    </script>
</body>

</html>
