@include('admin.layout.header')

<body class="app">
    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10">Discounts ({{$Discounts->count()}})</h4>
                        <p>Double Click the Delete Button to Delete a Discount</p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('admin.discount.getNew')}}" class="btn btn-success">Add New Discount</a>
                                <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-30">
                                    <table id="dataTable" class="table table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Amount</th>
                                                <th>Active on # Products</th>
                                                <th>Valid Until</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($Discounts as $Single)
                                            <tr>
                                                <td>{{$Single->title}}</td>
                                                <td>{{$Single->amount}} @if($Single->type == 'percent') % @else ‏€ @endif</td>
                                                <td>{{$Single->ActiveOnProducts->count()}}</td>
                                                <td>{{$Single->valid_until->format('Y-m-d')}}</td>
                                                <td>
                                                    <a href="{{route('admin.discount.getEdit' , $Single->id)}}" class="btn btn-primary">Edit</a>
                                                    <a href="javascript:;" item-id="{{$Single->id}}" action-route="{{ route('admin.discount.delete') }}" class="btn btn-danger delete-btn">Delete</a>
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
        $('.delete-btn').dblclick(function(){
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
