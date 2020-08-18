@include('admin.layout.header')

<body class="app">
    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10">Coupouns ({{$Coupouns->count()}})</h4>
                        <p>Double Click the Delete Button to Delete a Coupouns</p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('admin.coupoun.getNew')}}" class="btn btn-success">Add New Coupouns</a>
                                <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-30">
                                    <table id="dataTable" class="table table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>Coupoun Code</th>
                                                <th>Discount Amount</th>
                                                <th>Active on # Products</th>
                                                <th>Available Coupons Left</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($Coupouns as $Single)
                                            <tr>
                                                <td>{{$Single->coupoun_code}}</td>
                                                <td>{{$Single->discount_amount}} @if($Single->discount_type == 'percent') % @else ‏€ @endif</td>
                                                <td>25</td>
                                                <td>@if($Single->amount == 0) Infinite @else {{$Single->amount}} @endif</td>
                                                <td>
                                                    <a href="{{route('admin.coupoun.getEdit' , $Single->id)}}" class="btn btn-primary">Edit</a>
                                                    <a id="delete-btn" href="javascript:;" item-id="{{$Single->id}}" action-route="{{ route('admin.coupoun.delete') }}" class="btn btn-danger">Delete</a>
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
