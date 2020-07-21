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
                                <h2>Edit Category <b>{{$Category->title}}</b></h2>
                                <div class="bgc-white p-20 bd">
                                    <h6 class="c-grey-900">Global Data</h6>
                                    <div class="mT-30">
                                        <form action="{{route('admin.categories.postEdit' , $Category->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Fallback Title</label>
                                                <input type="text" class="form-control" name="title" value="{{$Category->title}}" placeholder="Enter Title Here">
                                            </div>
                                            <div class="form-group">
                                                <label>Category Image (UnChanged)</label>
                                                <input type="file" class="form-control" name="image">
                                            </div>
                                            <div class="form-group">
                                                <label>Fallback Description</label>
                                                <textarea class="form-control" name="description" rows="6" placeholder="Enter Description Here">{{$Category->description}}</textarea>
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
        $('input[name="title"]').keyup(function(){
            SlugValue = $(this).val().replace(/\s+/g, '-').replace(/[^a-zA-Z ]/g, "-").toLowerCase();
            //Assign the value to the input
            $('input[name="slug"]').val(SlugValue);
        });
    </script>
</body>

</html>
