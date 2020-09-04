@include('admin.layout.header')
<body class="app">
    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10">Orders ({{$Orders->count()}})</h4>
                        <p>Double Click the Delete Button to Delete a Product</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-30">
                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>Is Paid</th>
                                                <th>Payment Method</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($Orders as $Single)
                                            <tr>
                                                <td>{{$Single->serial_number}}</td>
                                                <td>{{$Single->status}}</td>
                                                <td>{{$Single->is_paid}}</td>
                                                <td>{{$Single->payment_method}}</td>
                                                <td>{{formatPrice($Single->final_total).getCurrency()['symbole']}}</td>
                                                <td>
                                                    <a href="{{route('admin.orders.single' , $Single->id)}}" class="btn btn-primary">View</a>
                                                </td>
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
            </main>
        </div>
    </div>
    @include('admin.layout.scripts')
    <script>
        $('#delete-btn').dblclick(function(){
            var Elem = $(this);
            var ItemId = $(this).attr('item-id');
            var ActionRoute = $(this).attr('action-route');
            $(this).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                method : 'POST',
                url: ActionRoute ,
                data: {item_id : ItemId},
                success: function(response){
                    Elem.parent().parent().fadeOut('fast');
                    ShowNoto('noto-success' , response , 'Success');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    ShowNoto('noto-danger' , errorThrown , 'Error');
                    Elem.html('Delete');
                }
            });
        });

    </script>
</body>

</html>
