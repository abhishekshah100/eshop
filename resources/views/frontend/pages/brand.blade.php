@extends('frontend.product_theme')
@section('content')
<x-breadcrumb heading="Product" />
<div class="product-tab bg-white pt-80 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mb-30">
                <div class="grid-nav-wraper bg-lighten2 mb-30">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 position-relative">
                        </div>
                        <div class="col-12 col-md-6 position-relative">
                            <div class="shop-grid-button d-flex align-items-center">
                                <span class="sort-by">Sort by:</span>
                                <button class="btn-dropdown rounded d-flex justify-content-between" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Relevance <span class="ion-android-arrow-dropdown"></span>
                                </button>
                                <div class="dropdown-menu shop-grid-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item">Relevance</a>
                                    <a class="dropdown-item"> Name, A to Z</a>
                                    <a class="dropdown-item" href="#"> Name, Z to A</a>
                                    <a class="dropdown-item" href="#"> Price, low to high</a>
                                    <a class="dropdown-item" href="#"> Price, high to low</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product-tab-nav end -->
                <div class="tab-content" id="pills-tabContent">
                    <!-- first tab-pane -->
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="row grid-view theme1">

                        	@foreach($product as $products)
                            <div class="col-sm-6 col-lg-4 col-xl-3 mb-30">
                                <div class="card product-card">
                                    <div class="card-body">
                                        <div class="product-thumbnail position-relative">
                                        	@if(!empty($products->discount))<span class="badge badge-success top-left">{{ $products->discount }} %</span>@endif
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="/product-detail/{{ $products->id }}">
                                                <img class="first-img" src="../{{ $products->feature_image }}" alt="thumbnail">
                                            </a>
                                            <!-- product links -->
                                            <ul class="product-links d-flex justify-content-center">
                                                <li>
                                                    <a href="wishlist.html">
                                                        <span data-toggle="tooltip" data-placement="bottom"
                                                            title="add to wishlist" class="icon-heart"> </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#quick-view">
                                                        <span data-toggle="tooltip" data-placement="bottom"
                                                            title="Quick view" class="icon-magnifier"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- product links end-->
                                        </div>
                                        <div class="product-desc py-0">
                                            <h3 class="title"><a href="/product-detail/{{ $products->id }}">{{ $products->product_name }}</a></h3>
                                            <div class="star-rating">
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="product-price">
                                                    @if(!empty($products->old_price))<del class="del">INR {{ $products->old_price }}</del>
                                                    @endif
                                                    <span class="onsale">INR {{ $products->new_price }}</span></h6>
                                                <button class="pro-btn" data-toggle="modal" data-productid="{{ $products->id }}"
                                                    data-target="#add-to-cart"><i class="icon-basket"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- product-list End -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <nav class="pagination-section mt-30">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="ion-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-30 order-lg-first">
                <aside class="left-sidebar theme1">
                    <!-- search-filter start -->
                    <div class="search-filter">
                        <div class="check-box-inner pt-0">
                            <h4 class="title">Categories</h4>
                        </div>

                    </div>

                    <ul id="offcanvas-menu2" class="blog-ctry-menu">
                        @foreach($category as $categories)
                        <li><a href="{{ url('category',$categories->slug) }}">{{ $categories->categoryname }}</a>
                        </li>
                        @endforeach
                        <!-- <li><a href="javascript:void(0)">Luggage &amp; Bags</a>
                            <ul class="category-sub-menu">
                                <li><a href="#">Stylish Backpacks</a></li>
                                <li><a href="#">Shoulder Bags</a></li>
                                <li><a href="#">Crossbody Bags</a></li>
                                <li><a href="#">Briefcases</a></li>
                                <li><a href="#">Luggage &amp; Travel</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Accessories</a>
                            <ul class="category-sub-menu">
                                <li><a href="#">Cosmetic Bags &amp; Cases</a></li>
                                <li><a href="#">Wallets &amp; Card Holders</a></li>
                                <li><a href="#">Luggage Covers</a></li>
                                <li><a href="#">Passport Covers</a></li>
                                <li><a href="#">Bag Parts &amp; Accessories</a></li>
                            </ul>
                        </li> -->
                    </ul>

                    <div class="search-filter">
                        <form action="#">
                            <div class="check-box-inner mt-10">
                                <h4 class="title">Filter By</h4>
                                <h4 class="sub-title pt-10">Categories</h4>
                                <div class="filter-check-box">
                                    <input type="checkbox" id="20820">
                                    <label for="20820">Digital Cameras <span>(13)</span></label>
                                </div>
                                <div class="filter-check-box">
                                    <input type="checkbox" id="20821">
                                    <label for="20821">Camcorders <span>(13)</span></label>
                                </div>
                                <div class="filter-check-box">
                                    <input type="checkbox" id="20822">
                                    <label for="20822">Camera Drones<span>(13)</span></label>
                                </div>
                            </div>
                            <!-- check-box-inner -->
                            <div class="check-box-inner mt-10">
                                <h4 class="sub-title">Price</h4>
                                <div class="price-filter mt-10">
                                    <div class="price-slider-amount">
                                        <input type="text" id="amount" name="price" readonly
                                            placeholder="Add Your Price" />
                                    </div>
                                    <div id="slider-range"></div>
                                </div>
                            </div>
                            <div class="check-box-inner mt-10">
                                <h4 class="sub-title">Size</h4>
                                <div class="filter-check-box">
                                    <input type="checkbox" id="test9">
                                    <label for="test9">s <span>(2)</span></label>
                                </div>
                                <div class="filter-check-box">
                                    <input type="checkbox" id="test10">
                                    <label for="test10">m <span>(2)</span></label>
                                </div>
                                <div class="filter-check-box">
                                    <input type="checkbox" id="test11">
                                    <label for="test11">l <span>(2)</span></label>
                                </div>
                                <div class="filter-check-box">
                                    <input type="checkbox" id="test12">
                                    <label for="test12">xl <span>(2)</span></label>
                                </div>
                            </div>
                            <!-- check-box-inner -->
                            <div class="check-box-inner mt-10">
                                <h4 class="sub-title">color</h4>
                                <div class="filter-check-box color-grey">
                                    <input type="checkbox" id="20826">
                                    <label for="20826">grey <span>(4)</span></label>
                                </div>
                                <div class="filter-check-box color-white">
                                    <input type="checkbox" id="20827">
                                    <label for="20827">white <span>(3)</span></label>
                                </div>
                                <div class="filter-check-box color-black">
                                    <input type="checkbox" id="20828">
                                    <label for="20828">black <span>(6)</span></label>
                                </div>
                                <div class="filter-check-box color-camel">
                                    <input type="checkbox" id="20829">
                                    <label for="20829">camel <span>(2)</span></label>
                                </div>
                            </div>
                            <!-- check-box-inner -->
                            <div class="check-box-inner mt-10">
                                <h4 class="sub-title">Brand</h4>
                                <div class="filter-check-box">
                                    <input type="checkbox" id="20824">
                                    <label for="20824">Graphic Corner<span>(5)</span></label>
                                </div>
                                <div class="filter-check-box">
                                    <input type="checkbox" id="20825">
                                    <label for="20825">Studio Design<span>(8)</span></label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- search-filter end -->
                    <div class="product-widget mb-60 mt-30">
                        <h3 class="title">Product Tags</h3>
                        <ul class="product-tag d-flex flex-wrap">
                            <li><a href="#">shopping</a></li>
                            <li><a href="#">New products</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">sale</a></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
@include('frontend.layouts.product_modal')
@endsection