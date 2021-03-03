@extends('frontend.home_theme')
@section('content')
@php
use Carbon\Carbon;
@endphp
<!-- main slider start -->
<section class="bg-light position-relative">
    <div class="main-slider dots-style theme2">
      @foreach($homeslider as $homesliders)
        <div class="slider-item bg-img bg-img3" style="background-image: url({{ $homesliders->slider_image }}) ">
            <div class="container">
                <div class="row align-items-center slider-height">
                    <div class="col-12">
                        <div class="slider-content slider-content-width text-center pl-xl-5 ml-auto">
                            <p class="text text-lighten text-uppercase animated mb-25" data-animation-in="fadeInDown">
                                {{ $homesliders->main_heading }}</p>
                            <h4 class="title text-dark animated text-capitalize mb-25" data-animation-in="fadeInLeft"
                                data-delay-in="1">{{ $homesliders->sub_heading }}</h4>
                            <h2 class="sub-title text-dark animated" data-animation-in="fadeInRight" data-delay-in="2">{{ $homesliders->sub_sub_heading }}</h2>
                            <a href="{{ $homesliders->link }}"
                                class="btn theme--btn2 btn--lg text-uppercase rounded-5 animated mt-45 mt-sm-25"
                                data-animation-in="zoomIn" data-delay-in="3">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       @endforeach 
        <!-- slider-item end -->
    </div>
    <!-- slick-progress -->
    <div class="slick-progress">
        <span></span>
    </div>
    <!-- slick-progress end-->
</section>
<!-- main slider end -->
<!-- brand slider start -->
<div class="brand-slider-section theme2 bg-white py-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="brand-init theme2 slick-nav-brand">
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="{{ route('home') }}" class="brand-thumb">
                                <img src="{{ asset('frontend/assets/img/brand/1.jpg') }}" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="{{ route('home') }}" class="brand-thumb">
                                <img src="{{ asset('frontend/assets/img/brand/2.jpg') }}" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="{{ route('home') }}" class="brand-thumb">
                                <img src="{{ asset('frontend/assets/img/brand/3.jpg') }}" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="{{ route('home') }}" class="brand-thumb">
                                <img src="{{ asset('frontend/assets/img/brand/4.jpg') }}" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="{{ route('home') }}" class="brand-thumb">
                                <img src="{{ asset('frontend/assets/img/brand/5.jpg') }}" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="{{ route('home') }}" class="brand-thumb">
                                <img src="{{ asset('frontend/assets/img/brand/2.jpg') }}" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="{{ route('home') }}" class="brand-thumb">
                                <img src="{{ asset('frontend/assets/img/brand/3.jpg') }}" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand slider end -->
<!-- common banner  start -->
<div class="common-banner bg-white">
    <div class="container">
        <div class="row">
            @for($p=0;$p<3;$p++)
            <div class="col-sm-6 col-md-4 mb-30">
                <div class="banner-thumb common-bthumb1">
                    <a href="{{ $array_premium_link[$p] }}" class="zoom-in d-block overflow-hidden">
                        <img src="{{ $array_premium_images[$p] }}" alt="banner-thumb-naile">
                    </a>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
<!-- common banner  end -->
<!-- product tab start -->
<section class="product-tab bg-white pt-50 pb-80">
    <div class="container">
        <div class="product-tab-nav mb-35">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="section-title text-center mb-30">
                        <h2 class="title text-dark text-capitalize">Our products</h2>
                        <p class="text mt-10">Add our products to weekly line up</p>
                    </div>
                </div>
                <div class="col-12">
                    <nav class="product-tab-menu theme2">
                        <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                            @foreach($our_product_category as $our_product_categories)  
                            @php 
                                $get_category_name = App\Category::where('id', $our_product_categories->product_category)->first();
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->iteration=='1'?'active':'' }}" id="pills-home-tab" data-toggle="pill" href="#pills-{{ $loop->iteration }}"
                                    role="tab" aria-controls="pills-home" aria-selected="{{ $loop->iteration=='1'?'true':'false' }}">{{ $get_category_name->categoryname }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- product-tab-nav end -->
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <!-- first tab-pane -->
                    @foreach($our_product_category as $our_product_categories)
                    <div class="tab-pane fade {{ $loop->iteration=='1'?'show active':'' }}" id="pills-{{ $loop->iteration }}" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="product-slider-init theme2 slick-nav">
                            @php
                            $get_category=DB::table('categories')
                            ->join('products', 'categories.id', '=', 'products.product_category')
                            ->where('product_category', $our_product_categories->product_category)->where('product_status','1')->select('*','products.slug as product_url')->get();
                            @endphp
                            @foreach($get_category as $get_categorys)
                            <div class="slider-item">
                                <div class="card product-card">
                                    <div class="card-body p-0">
                                        <div class="media flex-column">
                                            <div class="product-thumbnail position-relative">
                                                <span class="badge badge-danger top-right">New</span>
                                                <a href="/product-detail/{{ $get_categorys->product_url }}">
                                                    <img class="first-img" src="images/products/{{ $get_categorys->feature_image }}"
                                                        alt="thumbnail">
                                                </a>
                                                <!-- product links -->
                                                <ul class="product-links d-flex justify-content-center">
                                                    @if(session()->has('customer_auth'))
                                                    <li>
                                                        <a>
                                                            <span data-toggle="tooltip" data-wishlist="{{ $get_categorys->id }}" class="wishlistproduct icon-heart" data-placement="bottom"
                                                                title="add to wishlist"> </span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <!-- <a data-toggle="modal" data-target="#quick-view">
                                                            <span data-toggle="tooltip" data-placement="bottom"
                                                                title="Quick view" class="icon-magnifier"></span>
                                                        </a> -->
                                                    </li>
                                                </ul>
                                                <!-- product links end-->
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title"><a href="/product-detail/{{ $get_categorys->product_url }}">{{ $get_categorys->product_name }} </a></h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                     @if($get_categorys->remaining_stock>0)
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h6 class="product-price">INR {{ $get_categorys->new_price }}</h6>
                                                        <button class="pro-btn" data-toggle="modal"
                                                            data-target="#add-to-cart" data-productid="{{$get_categorys->id }}"><i
                                                                class="icon-basket"></i></button>
                                                    </div>
                                                    @else       
                                                    <h6 class="product-price">
                                                        <span class="onsale">Out of Stock</span>
                                                    </h6> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <!-- slider-item end -->
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- product tab end -->
<!-- popular-section  start -->
<div class="popular-section popular-bg1 theme2 bg-white pt-80 pb-50" style="background-image: url({{ $popular_categories_bg_image->websiteui_images }});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-white text-capitalize">Popular Categories</h2>
                    <p class="text text-white mt-10">Some of our popular categories include electronics</p>
                </div>
            </div>
            <div class="col-12">
                <div class="popular-slider-init dots-style">
                     @foreach($our_product_category as $popular_categories)
                     @php
                            $get_category_detail= DB::table('categories')->where('id', $popular_categories->product_category)->first();
                    @endphp
                    <div class="slider-item">
                        <div class="card popular-card zoom-in d-block overflow-hidden">
                            <div class="card-body">
                                <a href="{{ url('category/'.$get_category_detail->slug) }}" class="thumb-naile"> <img class="d-block mx-auto"
                                        src="/images/category/{{ $get_category_detail->category_image }}" alt="img"></a>
                                <h3 class="popular-title">
                                    <a href="{{ url('category/'.$get_category_detail->slug) }}"> {{ $get_category_detail->categoryname }} <span>({{ $popular_categories->total }})</span></a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- slider-item end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- popular-section  end -->
<!-- product tab repetation start -->
<section class="bg-white theme2 pt-80 pb-80">
    <div class="container">
        <div class="row">

            @if($count_hot_deal_products > 0)
            <div class="col-12 col-lg-5 col-xl-4 mb-5 mb-lg-0">
                <div class="card product-card no-shadow theme-border2">
                    <div class="product-ctry-init slick-nav-sync">

                        @foreach($hot_deal_products as $hot_deal_product)
                        <div class="slider-item">
                            <div class="card-body pt-4 px-4 pb-5 position-relative">
                                <div class="hot-deal d-flex align-items-center justify-content-between">
                                    <h3 class="title text-dark text-capitalize">hot deals</h3><span
                                        class="badge badge-success position-static cb6">{{ $hot_deal_product->discount }} %</span>
                                </div>
                                <!-- countdown-sync-init -->
                                <div class="countdown-sync-init">
                                    <div class="countdown-item">
                                        <div class="product-thumb">
                                            <img class="d-block mx-auto" src="{{ $hot_deal_product->feature_image }}"
                                                alt="product-thumb">
                                            <ul class="product-links d-flex justify-content-center">
                                                <li>
                                                    <a data-wishlist="{{ $hot_deal_product->id }}" class="wishlistproduct">
                                                        <span data-toggle="tooltip" data-placement="bottom"
                                                            data-original-title="add to wishlist"
                                                            class="icon-heart"></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <!-- <a href="#" data-toggle="modal" data-target="#quick-view">
                                                        <span data-toggle="tooltip" data-placement="bottom"
                                                            data-original-title="Quick view" class="icon-magnifier">
                                                        </span>
                                                    </a> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- single-product end -->
                                    @php
                        $multiple_images=json_decode($hot_deal_product->product_images, true);
                    @endphp
                    @foreach($multiple_images as $single_images)
                                    <div class="countdown-item">
                                        <div class="product-thumb">
                                            <img class="d-block mx-auto" src="/images/products/{{ $single_images }}"
                                                alt="product-thumb">
                                            <ul class="product-links d-flex justify-content-center">
                                                <li>
                                                    <a data-wishlist="{{ $hot_deal_product->id }}" class="wishlistproduct">
                                                        <span data-toggle="tooltip" data-placement="bottom"
                                                            data-original-title="add to wishlist"
                                                            class="icon-heart"></span>
                                                    </a>
                                                </li>
                                                <!-- <li>
                                                    <a href="#" data-toggle="modal" data-target="#compare">
                                                        <span data-toggle="tooltip" data-placement="bottom"
                                                            data-original-title="Add to compare" class="icon-shuffle">

                                                        </span>
                                                    </a>
                                                </li> -->
                                                <li>
                                                    <!-- <a href="#" data-toggle="modal" data-target="#quick-view">
                                                        <span data-toggle="tooltip" data-placement="bottom"
                                                            data-original-title="Quick view" class="icon-magnifier">
                                                        </span>
                                                    </a> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                    @endforeach   

                                </div>
                                <!-- countdown-sync-nav -->
                                <div class="countdown-sync-nav has-opacity">
                                    <div class="countdown-item">
                                        <div class="product-thumb">
                                            <a href="javascript:void(0)">
                                                <img src="{{ $hot_deal_product->feature_image }}" alt="product-thumb">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- single-product end -->
                                    @foreach($multiple_images as $single_images)
                                    <div class="countdown-item">
                                        <div class="product-thumb">
                                            <a href="javascript:void(0)"> <img src="/images/products/{{ $single_images }}"
                                                    alt="product-thumb"></a>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- single-product end -->
                                </div>
                                <div class="product-desc text-center p-0">
                                    <h3 class="title"><a href="shop-grid-4-column.html">{{ $hot_deal_product->product_name }}</a></h3>
                                    <div class="star-rating">
                                        <span class="ion-ios-star"></span>
                                        <span class="ion-ios-star"></span>
                                        <span class="ion-ios-star"></span>
                                        <span class="ion-ios-star"></span>
                                        <span class="ion-ios-star"></span>
                                    </div>
                                    <div class="text-center position-relative">
                                        @if($hot_deal_product->remaining_stock>0)
                                        <h6 class="product-price"><del class="del">INR {{ $hot_deal_product->old_price }}</del> <span
                                                class="onsale">INR {{ $hot_deal_product->new_price }}</span></h6>
                                        <button class="pro-btn pro-btn-right" data-productid="{{ $hot_deal_product->id }}" data-toggle="modal"
                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>
                                        @else
                                        <h6 class="product-price" style="color: red;">Out of Stock</h6>
                                        @endif
                                    </div>
                                    @if($hot_deal_product->remaining_stock>0)
                                    <div class="availability mt-15">
                                        <p>Availability: <span class="in-stock">{{ $hot_deal_product->remaining_stock }} In Stock</span></p>
                                    </div>
                                    @endif
                                </div>
                                <div class="clockdiv d-md-flex justify-content-center align-items-center">
                                    <div class="title">Hurry Up! Offers ends in:</div>
                                    <div class="text-center" data-countdown="{{ Carbon::parse($hot_deal_product->hot_deals_expiry_date)->format('Y/m/d') }}"></div>
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- slider-item End -->
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12 {{ $count_hot_deal_products > 0?'col-lg-7 col-xl-8':'col-lg-12 col-xl-12' }}">
                <!-- section-title start -->
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize">New Arrivals</h2>
                    <!-- <p class="text mt-10">Add new products to weekly line up</p> -->
                </div>
                <x-product-card-new-item :products="$new_arrival_product" />
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize">Best Sellers</h2>
                    <!-- <p class="text mt-10">Add new products to weekly line up</p> -->
                </div>
                <x-product-card-new-item :products="$best_sellers" />
            </div>
        </div>
    </div>
</section>
<!-- product tab repetation end -->
<!-- common banner  start -->
<div class="common-banner bg-white pb-50">
    <div class="container">
        <div class="row">
            @for($o=0;$o<2;$o++)
            <div class="col-lg-6 mb-30">
                <div class="banner-thumb common-bthumb1">
                    <a href="{{ $array_offer_banners_link[$o] }}" class="zoom-in d-block overflow-hidden">
                        <img src="{{ $array_offer_banners_images[$o] }}" alt="banner-thumb-naile">
                    </a>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
<!-- common banner  end -->
<!-- featured  slider start-->
<section class="featured-slider theme2 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title mb-30">
                    <h2 class="title text-dark text-capitalize">Featured products </h2>
                </div>
            </div>
            <div class="col-12">
                <div class="featured-init slick-nav">
                   @foreach($feature_product as $feature_products)
                    <div class="slider-item">
                        <div class="product-list mb-30">
                            <div class="card product-card no-shadow">
                                <div class="card-body p-0">
                                    <div class="media">
                                        <div class="product-thumbnail">
                                            <a href="/product-detail/{{ $feature_products->slug }}">
                                                <img class="first-img" src="/images/products/{{ $feature_products->feature_image }}" alt="thumbnail">
                                            </a>
                                        </div>
                                        <div class="media-body ml-3">
                                            <div class="product-desc">
                                                <h3 class="title"><a href="shop-grid-4-column.html"></a>{{ $feature_products->product_name }}</h3>
                                                <div class="star-rating">
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star de-selected"></span>
                                                </div>
                                                @if($feature_products->remaining_stock>0)
                                                <div class="d-flex align-items-center">
                                                    <h6 class="product-price">INR {{ $feature_products->new_price }}</h6>
                                                    <button class="pro-btn" data-productid="{{ $feature_products->id }}"data-toggle="modal"
                                                        data-target="#add-to-cart"><i class="icon-basket"></i></button>
                                                </div>
                                                @else
                                                    <h6 class="product-price">
                                                        <span class="onsale">Out of Stock</span>
                                                </h6>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- "product-list End -->
                    </div>
                    @endforeach
                    <!-- slider-item End -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- featured  slider end-->
<!-- staic media start -->
<section class="static-media-section bg-dark py-45">
    <div class="container">
        <div class="static-media-wrap p-0">
            <div class="row">
                <div class="col-lg-3 col-sm-6 py-3">
                    <div class="d-flex static-media2 flex-column flex-sm-row">
                        <img class="align-self-center mb-2 mb-sm-0 mr-auto  mr-sm-3" src="{{ asset('frontend/assets/img/icon/2.png') }}"
                            alt="icon">
                        <div class="media-body">
                            <h4 class="title text-capitalize text-white">Free Shipping</h4>
                            <p class="text text-white">On all orders over $75.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 py-3">
                    <div class="d-flex static-media2 flex-column flex-sm-row">
                        <img class="align-self-center mb-2 mb-sm-0 mr-auto  mr-sm-3" src="{{ asset('frontend/assets/img/icon/3.png') }}
                        "
                            alt="icon">
                        <div class="media-body">
                            <h4 class="title text-capitalize text-white">Free Returns</h4>
                            <p class="text text-white">Returns are free within 9 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 py-3">
                    <div class="d-flex static-media2 flex-column flex-sm-row">
                        <img class="align-self-center mb-2 mb-sm-0 mr-auto  mr-sm-3" src="{{ asset('frontend/assets/img/icon/5.png') }}"
                            alt="icon">
                        <div class="media-body">
                            <h4 class="title text-capitalize text-white">Support 24/7</h4>
                            <p class="text text-white">Contact us 24 hours a day</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 py-3">
                    <div class="d-flex static-media2 flex-column flex-sm-row">
                        <img class="align-self-center mb-2 mb-sm-0 mr-auto  mr-sm-3" src="{{ asset('frontend/assets/img/icon/4.png') }}"
                            alt="icon">
                        <div class="media-body">
                            <h4 class="title text-capitalize text-white">100% Payment Secure</h4>
                            <p class="text text-white">Your payment are safe with us.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- staic media end -->
<!-- brand slider start -->
<!-- modals start -->
<!-- first modal -->
@include('frontend.layouts.product_modal')
<!-- modals end -->

@endsection