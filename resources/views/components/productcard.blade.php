<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
<div class="col-sm-6 col-lg-4 col-xl-3 mb-30">
	<div class="card product-card">
		<div class="card-body">
			<div class="product-thumbnail position-relative">
            @if(!empty($products->discount))
				<span class="badge badge-success top-left">{{ $products->discount }} %</span>
			@endif
                                            
				<span class="badge badge-danger top-right">New</span>
				<a href="/product-detail/{{ $products->slug }}">
					<img class="first-img" src="/images/products/{{ $products->feature_image }}" alt="thumbnail">
					</a>
					<!-- product links -->
					<ul class="product-links d-flex justify-content-center">
            @if(session()->has('customer_auth'))
                                                
						<li>
							<a data-wishlist="{{ $products->id }}" class="wishlistproduct">
								<span data-toggle="tooltip" data-placement="bottom" title="add to wishlist" class="icon-heart"></span>
							</a>
						</li>
            @endif
                                                
						<li>
							<a href="#" data-toggle="modal" data-target="#quick-view{{ $products->id }}">
								<span data-toggle="tooltip" data-placement="bottom"
                                                            title="Quick view" class="icon-magnifier"></span>
							</a>
						</li>
					</ul>
					<!-- product links end-->
				</div>
				<div class="product-desc py-0">
					<h3 class="title mt-2" style="height: 2rem;">
						<a href="/product-detail/{{ $products->slug }}">{{ $products->product_name }} </a>
					</h3>
					<div class="star-rating">
						<span class="ion-ios-star"></span>
						<span class="ion-ios-star"></span>
						<span class="ion-ios-star"></span>
						<span class="ion-ios-star"></span>
						<span class="ion-ios-star de-selected"></span>
					</div>
					<div class="d-flex align-items-center justify-content-between">
                @if($products->remaining_stock>0)
                                                    
						<h6 class="product-price">
                    @if(!empty($products->old_price))
                                                            
							<del class="del">INR {{ $products->old_price }}</del>
                    @endif
                                                            
							<span class="onsale">INR {{ $products->new_price }}</span>
						</h6>
						<button class="pro-btn" data-toggle="modal" data-productid="{{ $products->id }}"
                                                        data-target="#add-to-cart">
							<i class="icon-basket"></i>
						</button>
                @else
                                                        
						<h6 class="product-price">
							<span class="onsale">Out of Stock</span>
						</h6> 
                @endif
                                            
					</div>
				</div>
			</div>
		</div>
		<!-- product-list End -->
	</div>
	<div class="modal fade theme2 style1" id="quick-view{{ $products->id }}" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8 mx-auto col-lg-5 mb-5 mb-lg-0">
							<div class="product-sync-init mb-20">
								<div class="single-product">
									<div class="product-thumb">
										<img src="/images/products/{{ $products->feature_image }}" alt="product-thumb">
										</div>
									</div>
									<!-- single-product end -->
									@php
                        		$multiple_images=json_decode($products->product_images, true);
                    				@endphp
                    			@foreach($multiple_images as $single_images)
									<div class="single-product">
										<div class="product-thumb">
											<img src="/images/products/{{ $single_images }}" alt="product-thumb">
										</div>
									</div>
									@endforeach
										<!-- single-product end -->		
								</div>
											<div class="product-sync-nav">
												<div class="single-product">
													<div class="product-thumb">
														<a href="javascript:void(0)">
															<img src="/images/products/{{ $products->feature_image }}"
                                                                        alt="product-thumb">
															</a>
														</div>
													</div>
													@foreach($multiple_images as $single_images)
													<!-- single-product end -->
													<div class="single-product">
														<div class="product-thumb">
															<a href="javascript:void(0)">
																<img src="/images/products/{{ $single_images }}"
                                                                        alt="product-thumb">
																</a>
															</div>
														</div>
														<!-- single-product end -->
														@endforeach
																<!-- single-product end -->
															</div>
														</div>
														<div class="col-lg-7 mt-5 mt-md-0">
															<div class="modal-product-info">
																<div class="product-head">
																	<h2 class="title" style="height: 2rem;">{{ $products->product_name }}</h2>
																	<div class="star-content mb-20">
																		<span class="star-on">
																			<i class="fas fa-star"></i>
																		</span>
																		<span class="star-on">
																			<i class="fas fa-star"></i>
																		</span>
																		<span class="star-on">
																			<i class="fas fa-star"></i>
																		</span>
																		<span class="star-on">
																			<i class="fas fa-star"></i>
																		</span>
																		<span class="star-on">
																			<i class="fas fa-star"></i>
																		</span>
																	</div>
																</div>
																<div class="product-body">
																	<div class="d-flex align-items-center mb-30">
																		<h6 class="product-price">@if(!empty($products->old_price))
																			<del class="del">INR {{ $products->old_price }}</del>
																		@endif
                                                                    
																			<span class="onsale">INR {{ $products->new_price }}</span>
																		</h6>
                                                                @if(!empty($products->discount))
																		<span class="badge position-static bg-dark p-2 rounded-0 ml-2">Save {{ $products->discount }}%</span>
																@endif
                                                            
																	</div>
																	<p>{{ $products->product_description }}</p>
																	<ul>
																		<li>Predecessor: None.</li>
																		<li>Support Type: Neutral.</li>
																		<li>Cushioning: High energizing cushioning.</li>
																	</ul>
																</div>
																<div class="product-footer">
																	<div class="product-count style d-flex flex-column flex-sm-row my-4">
																		<!-- <div class="count d-flex"><input type="number" class="modal-quantity" data-quantity="{{ $products->id }}" min="1" max="10" step="1" value="1"><div class="button-group"><button class="count-btn increment"><i
                                                                                class="fas fa-chevron-up"></i></button><button class="count-btn decrement"><i
                                                                                class="fas fa-chevron-down"></i></button></div></div> -->
																		<div>
																			<button class="btn theme-btn--dark2 btn--xl mt-5 mt-sm-0 rounded-5 modal-cart" data-productid="{{ $products->id }}">
																				<span class="mr-2">
																					<i class="ion-android-add"></i>
																				</span>
                                                                        Add to cart
                                                                    
																			</button>
																		</div>
																	</div>
																	<div class="addto-whish-list">
                                                                @if(session()->has('customer_auth'))
																		<a data-wishlist="{{ $products->id }}" class="wishlistproduct">
																			<i class="icon-heart"></i> Add to wishlist
																		</a>
																@endif
                                                            
																	</div>
																	<!-- <div class="pro-social-links mt-10"><ul class="d-flex align-items-center"><li class="share">Share</li><li><a href="#"><i class="ion-social-facebook"></i></a></li><li><a href="#"><i class="ion-social-twitter"></i></a></li><li><a href="#"><i class="ion-social-google"></i></a></li><li><a href="#"><i class="ion-social-pinterest"></i></a></li></ul></div> -->
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>