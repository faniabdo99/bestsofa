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

                                <a href="{{ route('admin.blog.create') }}" class="btn btn-success">Add Post</a><br><br>
                                <div class="col-lg-8">
                                    <div class="blog_left_sidebar">
                                        @foreach ($posts as $post)
                                            <article class="row blog_item">
                                                <div class="col-md-3">
                                                    <div class="blog_info text-right">
                                                        <ul class="blog_meta list">
                                                            <li>
                                                                <a href="#">{{ $post->user->name }}
                                                                    <i class="lnr lnr-user"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">{{ $post->created_at->diffForHumans() }}
                                                                    <i class="lnr lnr-calendar-full"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">{{ $post->views }}{{ $post->views==1?' View':' Views' }}
                                                                    <i class="lnr lnr-eye"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">{{ $post->Comments->count() }} Comments
                                                                    <i class="lnr lnr-bubble"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="blog_post">
                                                        <div class="col-lg-12">
                                                            <div class="feature-img">
                                                                <img height="300px" width="300px" src="{{url('public/storage/blog/'.$post->photo)}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="blog_details">
                                                            <a href="{{ route('admin.blog.edit',$post->id) }}">
                                                                <h2>{{ $post->title }}</h2>
                                                            </a>
                                                            <p>{{ $post->description }}</p>
                                                            <p class="excert">{!! $post->body !!}</p>
                                                            <a href="{{ route('admin.blog.edit',$post->id) }}" class="btn btn-success">View More</a>
                                                            <a href="{{ route('admin.blog.delete',$post->id) }}" class="btn btn-danger">Delete Post</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article><br>
                                        @endforeach

                                        <div class="d-flex justify-content-center">
                                            {!! $posts->links() !!}
                                        </div>
                                    </div>
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
