@include('admin.layout.header' , ['PageTitle' => 'New Blog Post'])
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
                                <h2>Edit Blog Post</h2>
                                <div class="bgc-white p-20 bd">
                                    <h6 class="c-grey-900">Main Data</h6>
                                    <div class="mT-30">
                                        <form action="{{route('admin.blog.update',$post->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Title *</label>
                                                <input type="text" class="form-control" name="title" value="{{ $post->title }}" placeholder="Enter Title Here">
                                            </div>
                                            <div class="form-group">
                                                <label>Main Image</label>
                                                <input type="file" class="form-control" name="photo">
                                            </div>
                                            <div class="form-group">
                                                <label>Description *</label>
                                                <textarea class="form-control" name="description" rows="6" placeholder="Enter Description Here">{{ $post->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Body *</label>
                                                <textarea class="form-control editor" name="body" rows="6" placeholder="Enter Description Here">{{ $post->body }}</textarea>
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
</body>

</html>
