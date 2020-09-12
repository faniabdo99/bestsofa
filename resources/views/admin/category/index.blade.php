@include('admin.layout.header')

<body class="app">
    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10">Categories ({{$Categories->count()}})</h4>
                        <p>Double Click the Delete Button to Delete a Category</p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('admin.categories.getNew')}}" class="btn btn-success">Add New Category</a>
                                <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-30">
                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Products</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($Categories as $Single)
                                            <tr>
                                                <td>{{$Single->local_title}}</td>
                                                <td>{{$Single->short_description}}</td>
                                                <td>{{$Single->Product->count()}}</td>
                                                <td>
                                                    <a href="{{route('admin.categories.getEdit' , $Single->id)}}" class="btn btn-primary">Edit</a>
                                                    <a href="javascript:;" item-id="{{$Single->id}}" action-route="{{ route('admin.category.delete') }}" class="btn btn-danger delete-btn">Delete</a>
                                                    <a href="{{route('admin.categories.getLocalize' , $Single->id)}}" class="btn btn-success">Localize</a>
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
