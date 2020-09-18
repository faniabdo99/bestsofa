@include('admin.layout.header')
<body class="app">
    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10">Users ({{$Users->count()}})</h4>
                        <p>Double Click the Delete Button to Delete a User</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-30">
                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Confirmed</th>
                                                <th>Code</th>
                                                <th>Country</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($Users as $Single)
                                            <tr>
                                                <td>{{$Single->name}}</td>
                                                <td>{{$Single->email}}</td>
                                                <td>@if($Single->confirmed) Yes @else No @endif</td>
                                                <td>{{$Single->code}}</td>
                                                <td>{{$Single->country}}</td>
                                                <td>
                                                    <a href="javascript:;" item-id="{{$Single->id}}" action-route="{{route('admin.user.toggleActive')}}" class="btn btn-primary activate-btn">@if($Single->confirmed) Deactivate @else Activate @endif</a>
                                                    <a href="javascript:;" item-id="{{$Single->id}}" action-route="{{ route('admin.user.delete') }}" class="btn btn-danger delete-btn">Delete</a>
                                                    {{-- <a href="{{route('admin.products.getLocalize' , $Single->id)}}" class="btn btn-success">Add to Group</a> --}}
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

        $('.activate-btn').click(function(){
            var Elem = $(this);
            var ItemId = $(this).attr('item-id');
            var ActionRoute = $(this).attr('action-route');
            $(this).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                method : 'POST',
                url: ActionRoute ,
                data: {item_id : ItemId},
                success: function(response){
                    ShowNoto('noto-success' , response.successMessage , 'Success');
                    Elem.html(response.btnMessage);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    ShowNoto('noto-danger' , errorThrown , 'Error');
                    Elem.html('Activate');
                }
            });
        });
        
    </script>
</body>

</html>
