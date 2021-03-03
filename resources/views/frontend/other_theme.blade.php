@include('frontend.layouts.header')
<!-- offcanvas-overlay start -->
<div class="offcanvas-overlay"></div>
<!-- offcanvas-overlay end -->
<!-- offcanvas-mobile-menu start -->
@include('frontend.layouts.offcanvas_mobile_menu')
  <!-- offcanvas-mobile-menu end -->
<!-- OffCanvas Wishlist Start -->
@include('frontend.layouts.offcanvas_wishlist')
<!-- OffCanvas Wishlist End -->
<!-- OffCanvas Cart Start -->
@include('frontend.layouts.offcanvas_cart')
<!-- OffCanvas Cart End -->
<!-- header start -->
@include('frontend.layouts.top_nav')
<!-- header end -->
<!-- product tab start -->
	@yield('content')
  <!-- /.content-wrapper -->
<!-- footer strat -->
@include('frontend.layouts.footer')
<!-- footer end -->
   <!--*********************** 
        all js files
     ***********************-->
@include('frontend.layouts.scripts')
@include('frontend.layouts.alertmessage')
@include('frontend.layouts.htmlend')