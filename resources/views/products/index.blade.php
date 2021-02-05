@include('layout.header', ['PageTitle' => __('titles.products-all')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Header Menu Area =================-->
    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap mt-5">
        <div class="container-fluid">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="form-group row mt-3 mb-2">
                        <div class="col-md-2">
                            <h5>Sort by Price</h5>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="order">
                                <option selected value="1">Lowest first</option>
                                <option value="2">Highest first </option>
                            </select>
                        </div>
                    </div>
                    <div class="latest_product_inner row">
                        @forelse ($Products as $Product)
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="f_p_item">
                                <div class="f_p_img">
                                    <img class="img-fluid" src="{{$Product->main_image}}" alt="{{$Product->title}}">
                                    <div class="p_icon">
                                        @auth
                                        <a class="icon_btn like_item @if($Product->LikedByUser()) bg-primary text-white @endif" product-id="{{$Product->id}}" href="javascript:;">
                                        <i class="lnr lnr lnr-heart"></i>
                                        </a>
                                        @endauth
                                        <a href="javascript:;" class="add-to-cart" data-id="{{$Product->id}}"><i class="lnr lnr-cart"></i></a>
                                    </div>
                                </div>
                                <a href="{{route('product.single' , [$Product->id , $Product->local_slug])}}">
                                    <h4>{{$Product->local_title}}</h4>
                                </a>
                                @if($Product->HasDiscount())
                                    <span class="product-price-before-discount">{{$Product->price}}</span>
                                    <h5 class="text-success">{{$Product->FinalPrice.getCurrency()['symbole'] }}</h5>
                                @else
                                    <h5>{{$Product->FinalPrice.getCurrency()['symbole'] }}</h5>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            @lang('products.no_products')
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets cat_widgets">
                            <div class="l_w_title">
                                <h3>Products</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <form action="{{route('product.home')}}" method="GET">
                                        <li><input name="category_filters" type="radio" checked value=""> @lang('products.all')</li>
                                        @forelse ($Categories as $Category)
                                        <li><input name="category_filters" type="radio" @if(request()->has('category_filters') && request()->category_filters == $Category->slug) checked
                                            @endif value="{{$Category->slug}}"> {{$Category->local_title}}</li>
                                        @empty
                                        <li><a href="#">@lang('products.no_categories')</a></li>
                                        @endforelse
                                </ul>
                            </div>
                        </aside>
                        <aside class="left_widgets cat_widgets">
                            <div class="l_w_title">
                                <h3>@lang('products.product_fabrics')</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <li><input class="mr-3" name="product_fabrics" checked type="radio" value="">@lang('products.all')</li>
                                    <li><input class="mr-3" name="product_fabrics" @if(request()->has('product_fabrics') && request()->product_fabrics == 'leather') checked @endif type="radio" value="leather">@lang('products.leather')</li>
                                    <li><input class="mr-3" name="product_fabrics" @if(request()->has('product_fabrics') && request()->product_fabrics == 'fabric') checked @endif type="radio" value="leather">@lang('products.fabric')</li>
                                    <li><input class="mr-3" name="product_fabrics" @if(request()->has('product_fabrics') && request()->product_fabrics == 'mix_leather_with_fabric') checked @endif type="radio" value="mix_leather_with_fabric">@lang('products.mix_leather_with_fabric')</li>
                                </ul>
                            </div>
                        </aside>
                        <aside class="left_widgets cat_widgets">
                            <div class="l_w_title">
                                <h3>Price</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <li><input class="mr-3" name="price_filters" checked type="radio" value="">All</li>
                                    <li><input class="mr-3" name="price_filters" @if(request()->has('price_filters') && request()->price_filters == 'under') checked @endif type="radio" value="under">Under 3750kr</li>
                                    <li><input class="mr-3" name="price_filters" @if(request()->has('price_filters') && request()->price_filters == 'between') checked @endif type="radio" value="between">Between 3750kr-5000kr</li>
                                    <li><input class="mr-3" name="price_filters" @if(request()->has('price_filters') && request()->price_filters == 'above') checked @endif type="radio" value="above">Above 5000kr</li>
                                </ul>
                            </div>

                        </aside>
                        <aside class="left_widgets cat_widgets">
                            <button class="main_btn d-block w-100" type="submit">@lang('products.apply_filters')</button>
                            </form>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->
    <!--================ Subscription Area ================-->
    {{-- <section class="subscription-area section_gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h2>Subscribe for Our Newsletter</h2>
                        <span>We won’t send any kind of spam</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div id="mc_embed_signup">
                        <form target="_blank" novalidate action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&id=92a4423d01" method="get" class="subscription relative">
                            <input type="email" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required="">
                            <!-- <div style="position: absolute; left: -5000px;">
									<input type="text" name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="">
								</div> -->
                            <button type="submit" class="newsl-btn">Get Started</button>
                            <div class="info"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--================ End Subscription Area ================-->
    @include('layout.footer')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('layout.scripts')
</body>

</html>
