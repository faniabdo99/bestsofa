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
                                        <label>Customer Description</label>
                                        <textarea class="form-control"  name="customer_desc" rows="10">{{$TheInvoice->customer_desc}}</textarea>
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
