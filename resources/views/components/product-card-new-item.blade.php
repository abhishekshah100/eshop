<!-- The only way to do great work is to love what you do. - Steve Jobs -->
<!-- section-title start -->
                <!-- section-title end -->
                <div class="product-slider2-init slick-nav">
                    @foreach($products as $new_arrival_products)
                    <div class="slider-item">
                        <div class="product-list">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="product-detail/{{ $new_arrival_products->slug }}">
                                                <img class="first-img" src="/images/products/{{ $new_arrival_products->feature_image }}" alt="thumbnail">
                                            </a>
                                            <!-- product links -->
                                            <ul class="product-links d-flex justify-content-center">
                                                @if(session()->has('customer_auth'))
                                                <li>
                                                    <a>
                                                        <span data-toggle="tooltip" class="wishlistproduct icon-heart" data-wishlist="{{ $new_arrival_products->id }}" data-placement="bottom"
                                                            title="add to wishlist"> </span>
                                                    </a>
                                                </li>
                                                @endif
                                                <li>
                                                    <!-- <a href="#" class="quickView" data-toggle="modal" data-target="#quick-view{{ $new_arrival_products->id }}">
                                                        <span data-toggle="tooltip" data-placement="bottom"
                                                            title="Quick view" class="icon-magnifier"></span>
                                                    </a> -->
                                                </li>
                                            </ul>
                                            <!-- product links end-->
                                        </div>
                                        <div class="media-body">
                                            <div class="product-desc">
                                                <h3 class="title"><a href="product-detail/{{ $new_arrival_products->slug }}">{{ $new_arrival_products->product_name }}</a></h3>
                                                <div class="star-rating">
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star de-selected"></span>
                                                </div>
                                                @if($new_arrival_products->remaining_stock>0)
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="product-price">INR {{ $new_arrival_products->new_price }}</h6>
                                                    <button class="pro-btn" data-productid="{{ $new_arrival_products->id }}" data-toggle="modal"
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
                            <!-- product-list End -->
                        </div>
                        
                    </div>
                    <!-- slider-item end -->
                    @endforeach
                </div>