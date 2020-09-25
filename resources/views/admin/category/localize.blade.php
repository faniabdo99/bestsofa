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
                                <h2>Edit Localized Data</h2>
                                @foreach ($SystemLangs as $Single)
                                @php
                                //Current Item Local Values (if exists)
                                $CurrentLocalValues = \App\Category_local::where('category_id' , $Category->id)->where('lang_code' , $Single)->first();
                                @endphp
                                <div class="bgc-white p-20 bd mB-40">
                                    <h6 class="c-grey-900">{{$Single}}</h6>
                                    <div class="mT-30">
                                        <form action="{{route('admin.categories.postNew')}}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" hidden name="lang_code" value="{{$Single}}">
                                            <input type="text" hidden name="category_id" value="{{$Category->id}}">
                                            <div class="form-group">
                                                <label>{{$Single}} Title</label>
                                                <input type="text" class="form-control" name="title_value" value="{{$CurrentLocalValues->title_value ?? ''}}" placeholder="{{$Category->title}}">
                                            </div>
                                            <div class="form-group">
                                                <label>{{$Single}} Description</label>
                                                <textarea class="form-control" name="description_value" rows="6" placeholder="{{$Category->description}}">{{$CurrentLocalValues->description_value ?? ''}}</textarea>
                                            </div>
                                    </div>
                                    <button class="btn btn-primary submit-form" action-route="{{route('admin.categories.postLocalize')}}">Submit {{$Single}} Translation</button>
                                    </form>
                                </div>
                                @endforeach
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
        $('.submit-form').click(function (e) {
            var Elem = $(this);
            var ActionRoute = Elem.attr('action-route');
            e.preventDefault();
            var FormData = Elem.parent().find('form').serialize();
            $.ajax({
                method: 'POST',
                url: ActionRoute,
                data: FormData,
                success: function(response){
                    if(response.error){
                        ShowNoto('noto-danger' , response.list , 'Error');
                    }else{
                        ShowNoto('noto-success' , response.list , 'Success');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    ShowNoto('noto-danger' , errorThrown , 'Error');
                }
            });
        });

    </script>
</body>

</html>
