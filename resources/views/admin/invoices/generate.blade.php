@include('admin.layout.header')
<style>
    .single-item-in-list {
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
                                <form class="mb-5" action="{{route('admin.invoice.update' , $TheInvoice->id)}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Invoice Prefix Number*</label>
                                        <input required class="form-control" type="text" name="invoice_prefix" value="{{$TheInvoice->invoice_prefix ?? '2020-01005'}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Invoice Number*</label>
                                        <input required class="form-control" type="text" name="id" value="{{$TheInvoice->id}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Customer Name*</label>
                                        <input required class="form-control" type="text" name="customer_name" value="{{$TheInvoice->customer_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Shipping Address</label>
                                        <input class="form-control" type="text" name="address" value="{{$TheInvoice->address}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Shipping City</label>
                                        <input class="form-control" type="text" name="city" value="{{$TheInvoice->city}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select name="country" class="form-control" required>
                                          <option value="{{$TheInvoice->country}}" selected>{{getCountryNameFromISO($TheInvoice->country)}}</option>
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
                                        <label>Phone Number</label>
                                        <input class="form-control" type="text" name="phone_number" value="{{$TheInvoice->phone_number}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="email" value="{{$TheInvoice->email}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Customer Description</label>
                                        <textarea class="form-control" name="customer_desc" rows="10">{{$TheInvoice->customer_desc}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>VAT Number</label>
                                        <input class="form-control" type="text" name="vat_number" value="{{$TheInvoice->vat_number}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Payment Method*</label>
                                        <select required class="form-control" name="payment_method">
                                            {{getPaymentMethods($TheOrder->pickup_at_store , $TheOrder->payment_method)}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Date*</label>
                                        <input required class="form-control" type="date" name="created_at" value="{{$TheInvoice->created_at->format('Y-m-d')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Due Date</label>
                                        @if($TheInvoice->due_date)
                                           <input class="form-control" type="date" name="due_date" value="{{$TheInvoice->due_date->format('Y-m-d')}}">
                                        @else
                                           <input class="form-control" type="date" name="due_date">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Order Serial Number (Ref)*</label>
                                        <input required class="form-control" type="text" name="order_serial_number" value="{{$TheInvoice->order_serial_number}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="is_paid" @if($TheInvoice->is_paid) checked @endif >
                                        <label>Paid ?</label>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update Invoice Data</button>
                                </form>
                                <a href="{{route('invoice.download.get' , $TheInvoice->id)}}" class="btn btn-primary">Download PDF</a>
                                <a href="{{route('invoice.generate.get' , $TheOrder->id)}}" class="btn btn-primary">Email to Customer</a>
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
