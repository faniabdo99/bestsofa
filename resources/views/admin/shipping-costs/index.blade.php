@include('admin.layout.header')
<body class="app">
    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10">Shipping Costs ({{$SCData->count()}})</h4>
                        <p>Double Click the Delete Button to Delete a Data Filed</p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('admin.shippingCosts.getNew')}}" class="btn btn-success">Add New Data</a>
                                <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-30">
                                    <table id="dataTable" class="table table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>Method</th>
                                                <th>Country</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Cost</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($SCData as $Single)
                                            <tr>
                                                <td>{{$Single->shipping_method}}</td>
                                                <td>{{$Single->country_name}}</td>
                                                <td>{{$Single->weight_from}}</td>
                                                <td>{{$Single->weight_to}}</td>
                                                <td>{{$Single->cost}}</td>
                                                <td>
                                                    <a href="{{route('admin.shippingCosts.getEdit' , $Single->id)}}" class="btn btn-primary">Edit</a>
                                                    <a id="delete-btn" href="javascript:;" item-id="{{$Single->id}}" action-route="{{ route('admin.shippingCosts.delete') }}" class="btn btn-danger">Delete</a>
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
