@php
$website_settings=App\WebsiteSetting::where('id','1')->first();
@endphp
<footer class="bg-light theme1 position-relative">
    <!-- footer bottom start -->
    <div class="footer-bottom pt-80 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mb-30">
                    <div class="footer-widget mx-w-400">
                        <div class="footer-logo mb-35">
                            <a href="{{ route('home') }}">
                                <img src="/images/website/logo/{{ $website_settings->website_logo }}" alt="footer logo">
                            </a>
                        </div>
                        <p class="text mb-30">We are a team of designers and developers that create high quality
                            Magento, Prestashop, Opencart.</p>
                        <div class="address-widget mb-30">
                            <div class="media">
                                <span class="address-icon mr-3">
                                    <img src="{{ asset('frontend/assets/img/icon/phone.png') }}" alt="phone">
                                </span>
                                <div class="media-body">
                                    <p class="help-text text-uppercase">NEED HELP?</p>
                                    <h4 class="title text-dark"><a href="tel:{{ $website_settings->contactno }}">{{ $website_settings->contactno }}</a></h4>
                                </div>
                            </div>
                        </div>

                        <div class="social-network">
                            <ul class="d-flex">
                                @if(!empty($website_settings->facebook_url))
                                <li><a href="{{ url($website_settings->facebook_url) }}" target="_blank"><span class="icon-social-facebook"></span></a></li>
                                @endif
                                @if(!empty($website_settings->twitter_url))
                                <li><a href="{{ url($website_settings->twitter_url) }}" target="_blank"><span class="icon-social-twitter"></span></a></li>
                                @endif
                                @if(!empty($website_settings->youtube_url))
                                <li><a href="{{ url($website_settings->youtube_url) }}" target="_blank"><span class="icon-social-youtube"></span></a></li>
                                @endif
                                @if(!empty($website_settings->instagram_url))
                                <li class="mr-0"><a href="{{ url($website_settings->instagram_url) }}" target="_blank"><span class="icon-social-instagram"></span></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-30">
                    <div class="footer-widget">
                        <div class="border-bottom cbb1 mb-25">
                            <div class="section-title pb-20">
                                <h2 class="title text-dark text-uppercase">Information</h2>
                            </div>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="#">Delivery</a></li>
                            <li><a href="{{ route('about') }}">About us</a></li>
                            <li><a href="#">Secure payment</a></li>
                            <li><a href="{{ route('contact') }}">Contact us</a></li>
                            <li><a href="#">Sitemap</a></li>
                            <li><a href="#">Stores</a></li>
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-30">
                    <div class="footer-widget">
                        <div class="border-bottom cbb1 mb-25">
                            <div class="section-title pb-20">
                                <h2 class="title text-dark text-uppercase">Custom Links</h2>
                            </div>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="#">Legal Notice</a></li>
                            <li><a href="#">Prices drop</a></li>

                            <li><a href="#">New products</a></li>

                            <li><a href="#">Best sales</a></li>

                            @if(!session()->has('customer_auth'))
                                <li><a href="/register">Register</a></li>
                                <li><a href="/login">Login</a></li>
                            @endif
                            @if(session()->has('customer_auth'))
                                <li><a href="/my-account">Profile</a></li>
                                <li><a href="/wishlist">Wishlist</a></li>
                            @endif
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-30">
                    <div class="footer-widget">
                        <div class="border-bottom cbb1 mb-25">
                            <div class="section-title pb-20">
                                <h2 class="title text-dark text-uppercase">Newsletter</h2>
                            </div>
                        </div>
                        <p class="text mb-20">You may unsubscribe at any moment. For that purpose, please find our
                            contact info in the legal notice.</p>
                        <div class="nletter-form mb-35">
                            <form class="form-inline position-relative" action="{{ route('newsletter') }}" method="post">
                                @csrf
                                <input class="form-control" type="text" placeholder="Your email address" name="email">
                                <button class="btn nletter-btn text-capitalize" type="submit" name="signup">Sign up</button>
                            </form>
                        </div>

                        <div class="store d-flex">
                            <a href="https://www.apple.com/" class="d-inline-block mr-3"><img
                                    src="{{ asset('frontend/assets/img/icon/apple.png') }}" alt="apple icon"> </a>
                            <a href="https://play.google.com/store/" class="d-inline-block"><img
                                    src="{{ asset('frontend/assets/img/icon/play.png') }}" alt="apple icon"> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom end -->
    <!-- coppy-right start -->
    <div class="coppy-right pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="text-left">
                        <p class="mb-3 mb-md-0">Copyright &copy; <a href="{{ route('home') }}">{{ $website_settings->website_name }}</a>. All
                            Rights Reserved</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="text-left">
                        <img src="{{ asset('frontend/assets/img/payment/1.png') }}" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- coppy-right end -->
</footer>