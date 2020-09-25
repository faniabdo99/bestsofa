<header class="header_area">
    <div class="top_menu row m0">
        <div class="container-fluid">
            <div class="float-left">
                <p>@lang('layout.call-us'): <a href="tel:+3252201018">+32 52 20 10 18</a></p>
            </div>
            <div class="float-right">
                <ul class="right_side">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" id="languagesDropdown" data-toggle="dropdown" >{{app()->getLocale()}}</a>
                        <div class="dropdown-menu navbar-dropdown-menu" aria-labelledby="languagesDropdown">
                            <a class="dropdown-item" href="{{route('changeLang' ,'en')}}">EN</a>
                            <a class="dropdown-item" href="{{route('changeLang' ,'fr')}}">FR</a>
                            <a class="dropdown-item" href="{{route('changeLang' ,'nl')}}">NL</a>
                          </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" id="currencyDropdown" data-toggle="dropdown">@if(session()->has('currency')) {{session()->get('currency') .' '. session()->get('currency_code')}} @else EUR € @endif</a>
                        <div class="dropdown-menu navbar-dropdown-menu" aria-labelledby="currencyDropdown">
                            <a class="dropdown-item" href="{{route('currency.change' , ['EUR' , '€'])}}">EUR €</a>
                            <a class="dropdown-item" href="{{route('currency.change' , ['GBP' , '£'])}}">GBP £</a>
                          </div>
                    </li>
                    @auth
                    @if (auth()->user()->role == 2)
                    <li>
                        <a href="{{route('admin.home')}}">
                            @lang('layout.admin-panel')
                        </a>
                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </div>
    </div>
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{route('home')}}">
                    <img src="{{url('public/img')}}/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <div class="row w-100">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                              <li class="nav-item @if(request()->path() == '/') active @endif"><a class="nav-link" href="{{route('home')}}">@lang('layout.home')</a></li>
                              <li class="nav-item @if(request()->path() == 'about') active @endif"><a class="nav-link" href="{{route('about')}}">@lang('layout.about-us')</a></li>
                              <li class="nav-item @if(str_contains(request()->path() , 'products')) active @endif"><a href="{{route('product.home')}}" class="nav-link">@lang('layout.shop')</a></li>
                                {{-- <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">Blog</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="blog.html">Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="single-blog.html">Blog Details</a>
                                        </li>
                                    </ul>
                                </li> --}}
                                <li class="nav-item @if(str_contains(request()->path() , 'contact')) active @endif"><a class="nav-link" href="{{route('contact.get')}}">@lang('layout.contact')</a></li>
                                  @guest
                                    <li class="nav-item"><a class="nav-link" href="{{route('login.get')}}">@lang('layout.login')</a></li>
                                  @endguest
                                  @auth
                                    <li class="nav-item @if(str_contains(request()->path() , 'profile')) active @endif"><a class="nav-link" href="{{route('profile')}}">@lang('layout.my-account')</a></li>
                                  @endauth
                            </ul>
                        </div>
                        <div class="col-lg-5">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                <hr>
                                <li class="nav-item">
                                    @auth
                                    <a href="javascript:;" class="icons open-sidebar">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                    @endauth
                                    @guest
                                    <a href="{{route('login.get')}}" class="icons">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                    @endguest
                                </li>
                                @auth
                                <div class="sidebar-item">
                                    <div class="sidebar-header">
                                        <span class="close-sidebar"><i class="fas fa-chevron-right"></i></span>
                                    </div>
                                    <div class="sidebar-body">
                                        <div class="logged-in-user-data d-flex">
                                            <div class="data-container d-flex flex-column justify-content-center">
                                                <h4>{{auth()->user()->name}}</h4>
                                                <p>{{auth()->user()->email}}</p>
                                            </div>
                                            <div class="image-container">
                                                <img src="{{auth()->user()->profile_image}}" alt="{{auth()->user()->name}}">
                                            </div>
                                        </div>
                                        <div class="logged-in-user-actions-list">
                                            <a class="stretched-link" href="{{route('profile')}}">@lang('layout.my-account')</a>
                                            <a class="stretched-link" href="{{route('myOrders')}}">@lang('layout.my-orders')</a>
                                            <a class="stretched-link" href="{{route('logout')}}">@lang('layout.logout')</a>
                                        </div>
                                    </div>
                                </div>
                                @endauth
                                <hr>
                                @auth
                                <li class="nav-item">
                                    <a href="javascript:;" class="icons open-sidebar">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <div class="sidebar-item">
                                    <div class="sidebar-header">
                                        <span class="close-sidebar"><i class="fas fa-chevron-right"></i></span>
                                    </div>
                                    <div class="sidebar-body">
                                        @forelse(auth()->user()->LikedProducts() as $LikedItem)
                                        <div class="logged-in-user-liked-item d-flex">
                                                <div class="data-container d-flex flex-column justify-content-center">
                                                    <h4>{{$LikedItem->Product->local_title}}</h4>
                                                    <p>{{$LikedItem->Product->price}}€</p>
                                                    <p class="{{$LikedItem->Product->status_class['text']}}">{{$LikedItem->Product->status}}</p>
                                                    <a href="{{route('product.single' , [$LikedItem->Product->id , $LikedItem->Product->slug])}}">View Product</a>
                                                </div>
                                                <div class="image-container">
                                                    <img src="{{$LikedItem->Product->main_image}}" alt="{{$LikedItem->Product->local_title}}">
                                                </div>
                                        </div>
                                        @empty
                                        <p>@lang('layout.no-liked-items')</p>
                                        @endforelse

                                    </div>
                                </div>
                                <hr>
                                @endauth

                                <li class="nav-item">
                                    <a href="javascript:;" class="icons open-sidebar">
                                        <i class="fas fa-shopping-cart"></i>
                                        @php
                                        if(auth()->check()){
                                            $UserId = auth()->user()->id;
                                        }else{
                                            $UserId = Cookie::get('guest_id');
                                        }
                                        $CartItems = \App\Cart::where('user_id' , $UserId)->where('status','active')->whereDate('created_at' , Carbon\Carbon::today())->get();
                                        @endphp
                                        @if($CartItems->count() != 0 )
                                           <span class="navbar-cart-badge">{{$CartItems->count()}}</span>
                                        @endif
                                    </a>
                                </li>
                                <div class="sidebar-item">
                                    <div class="sidebar-header">
                                        <span class="close-sidebar"><i class="fas fa-chevron-right"></i></span>
                                    </div>
                                    <div class="sidebar-body">
                                        <h3 class="cart-sidebar-title">@lang('layout.your-shopping-cart') ({{$CartItems->count()}})</h3>
                                            @forelse ($CartItems as $CartItem)
                                                <div class="navbar-cart-item">
                                                    <div class="img-container">
                                                        <img src="{{$CartItem->Product->main_image}}" >
                                                    </div>
                                                    <div class="data-container">
                                                        <h4>{{$CartItem->Product->local_title}}</h4>
                                                        <p class="mb-0">X{{$CartItem->qty}} - {{$CartItem->total_price.getCurrency()['symbole']}}</p>
                                                    </div>
                                                </div>
                                            @empty
                                            <p>@lang('layout.no-items-in-cart')</p>
                                            @endforelse
                                            @if($CartItems->count() !=0)
                                             <a class="main_btn d-block" href="{{route('cart')}}">@lang('layout.proceed-with-purchase')</a>
                                            @endif
                                    </div>
                                </div>
                                <hr>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
@if(session()->has('success'))
<div class="noto noto-success">
    {{session('success')}}
</div>
@endif
@if ($errors->any())
<div class="noto noto-danger">
    @foreach ($errors->all() as $error)
    {!! $error . '<br>' !!}
    @endforeach
</div>
@endif
