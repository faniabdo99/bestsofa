@include('layout.header', ['PageTitle' => $post->title ,'PageDescription'=>$post->description])
@include('layout.navbar')
    <section class="blog_area single-post-area p_120 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" height="400px" width="400px" src="{{url('public/storage/blog/'.$post->photo)}}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
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
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2>{{ $post->title }}</h2>
                            <p>{{ $post->description }}</p>
                            <p class="excert">{!! $post->body !!}</p>
                        </div>
                    </div><hr>
                    <div class="comments-area">
                        <h4>{{ $post->Comments->count() }} &nbsp; Comments</h4>
                        @foreach ($post->comments as $comment)
                            <div class="comment-list">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="desc">
                                            <h5><a href="#">{{ $comment->user->name }}</a></h5>
                                            <p class="date">{{ $comment->created_at->diffForHumans() }}</p>
                                            <p class="comment">{{ $comment->body }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="comment-form">
                        <h4>Add Comment</h4>
                        <form action="{{route('admin.create_comment')}}" method="post">
                            @csrf
                            <div class="form-group form-inline">
                                <div class="form-group col-lg-6 col-md-6 name">
                                    <input type="hidden" class="form-control" name="post_id" value="{{ $post->id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control mb-10" rows="5" name="comment" placeholder="Type a comment..." required></textarea>
                            </div>
                                <button type="submit" {{ !Auth::user()?'disabled':'' }} class="btn btn-primary">Post Comment</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget author_widget">
                            <img class="author_img rounded-circle" width="150px" height="150px" src="{{url('public/storage/blog/'.$post->user->image)}}" alt="">
                            <h4>{{ $post->user->name }}</h4>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Popular Posts</h3>
                            @foreach ($post_views as $view)
                                <div class="media post_item">
                                    <img src="{{url('public/storage/blog/'.$view->photo)}}" style="border-radius:50%" width="80px" height="80px" alt="post">
                                    <div class="media-body">
                                        <a href="{{ route('blog.show',$view->id) }}">
                                            <h3>{{ $view->title }}</h3>
                                        </a>
                                        <p>{{ $view->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="br"></div>
                        </aside>

                        <aside class="single_sidebar_widget ads_widget">
                            <a href="#">
                                <img class="img-fluid" src="img/blog/add.jpg" alt="">
                            </a>
                            <div class="br"></div>
                        </aside>

                        {{-- <aside class="single-sidebar-widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>
                            <p>
                                Here, I focus on a range of items and features that we useed in life without giving them a second thought.
                            </p>
                            <div class="form-group d-flex flex-row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email'">
                                </div>
                                <a href="#" class="bbtns">Subcribe</a>
                            </div>
                            <p class="text-bottom">You can unsubscribe at any time</p>
                            <div class="br"></div>
                        </aside> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>

@include('layout.footer')

