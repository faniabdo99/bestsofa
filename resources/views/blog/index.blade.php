@include('layout.header',['PageTitle' => 'Blog','PageDescription'=> 'Blog Description'])
@include('layout.navbar')

    <!--================Home Banner Area =================-->
    <section class="home_banner_area blog_banner">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="blog_b_text text-center">
                    <h2>Dude You’re Getting
                        <br /> a Telescope</h2>
                    <p>There is a moment in the life of any aspiring astronomer that it is time to buy that first</p>
                    <a class="white_bg_btn" href="#">View More</a>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Blog Area =================-->
    <section class="blog_area mt-5">
        <div class="container">
            <div class="row">
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
                                            <a href="{{ route('blog.show',$post->id) }}">
                                                <h2>{{ $post->title }}</h2>
                                            </a>
                                            <p>{{ $post->description }}</p>
                                            <p class="excert">{!! $post->body !!}</p>
                                            <a href="{{ route('blog.show',$post->id) }}" class="white_bg_btn">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach

                        <div class="d-flex justify-content-center">
                            {!! $posts->links() !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        {{-- <aside class="single_sidebar_widget search_widget">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Posts">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="lnr lnr-magnifier"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                            <div class="br"></div>
                        </aside> --}}

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
                                <img class="img-fluid" src="{{url('public/img/blog')}}/add.jpg" alt="">
                            </a>
                            <div class="br"></div>
                        </aside>



                        {{-- <aside class="single-sidebar-widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>
                            <p>
                                Here, I focus on a range of items and features that we used in life without giving them a second thought.
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
    <!--================Blog Area =================-->

@include('layout.footer')

