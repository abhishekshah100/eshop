<div id="offcanvas-mobile-menu" class="offcanvas theme1 offcanvas-mobile-menu">
    <div class="inner">
        <div class="border-bottom mb-4 pb-4 text-right">
            <button class="offcanvas-close">×</button>
        </div>
        <div class="offcanvas-head mb-4">
            <nav class="offcanvas-top-nav">
                <ul class="d-flex justify-content-center align-items-center">
                    <li class="mx-4"><a href="/cart"><i class="ion-ios-loop-strong"></i> Cart <span>(0)</span>
                        </a></li>
                    <li class="mx-4">
                        <a href="wishlist.html"> <i class="ion-android-favorite-outline"></i> Wishlist
                            <span>(0)</span></a>
                    </li>
                </ul>
            </nav>
        </div>
        <nav class="offcanvas-menu">
            <ul>
                <li ><a href="/">Home</a></li>
                <li><a href="/all-product">All Product</a></li>
                <li><a href="/about">About Us</a></li>
                <li><a href="/contact">Contact Us</a></li>
                <li><span class="menu-expand"></span><a href="#"><span class="menu-text">My Account</span></a>
                    <ul class="offcanvas-submenu" style="display: block;">
                        @if(!session()->has('customer_auth'))
                        <li><a href="/register">Register</a></li>
                        <li><a href="/login">Login</a></li>
                        @endif
                        @if(session()->has('customer_auth'))
                        <li><a href="/my-account">Profile</a></li>
                        <li><a href="/logout">Logout</a></li>
                        @endif
                    </ul>

                </li>
            </ul>
        </nav>
        <div class="offcanvas-social py-30">
            <ul>
                <li>
                    <a href="#"><i class="icon-social-facebook"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-twitter"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-instagram"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-google"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-instagram"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>