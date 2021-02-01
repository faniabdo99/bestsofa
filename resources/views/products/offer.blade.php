@include('layout.header', ['PageTitle' => __('titles.products-all')])
<body>
    @include('layout.navbar')
    <section class="container cat_product_area section_gap mt-5">
        <div class="row flex-row-reverse">
            <div class="form-group col-lg-3">
                <form action="{{ route('offer') }}" method="get">
                    <h3>Sort by Price</h3>
                    <select class="form-control" name="filter">
                        <option value="1" @if(request()->has('filter') && request()->filter == 1) selected @endif>lowest first</option>
                        <option value="2" @if(request()->has('filter') && request()->filter == 2) selected @endif>highest first </option>
                    </select>
                    <span>
                        <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
                    </span>
                </form>
            </div>
            
            <div class="col-lg-9">
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
        </div>
    </section>

    @include('layout.footer')

    @include('layout.scripts')
</body>
</html>
