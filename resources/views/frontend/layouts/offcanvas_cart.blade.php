<div id="offcanvas-cart" class="offcanvas offcanvas-cart theme1">
    <div class="inner">
        <div class="head d-flex flex-wrap justify-content-between">
            <span class="title">Cart</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div style="overflow: scroll; width: 100%; max-height: 600px;">
        <div id="offcanvascart">
        </div>
    </div>
        <a href="{{ route('cart') }}" class="btn theme--btn-default btn--lg d-block d-sm-inline-block rounded-5 mr-sm-2" style="position: sticky; bottom: 0;">view
            cart</a>
            @if(!session()->has('customer_auth'))
            <a href="{{ route('login') }}"
            class="btn theme-btn--dark1 btn--lg d-block d-sm-inline-block mt-4 mt-sm-0 rounded-5" style="position: sticky; bottom: 0;">checkout</a>
            @else
                @php
                  $total_cart=App\Cart::where('user_id',session('customer_auth')->id)->count();
                @endphp
                @if($total_cart>0)
                <a href="{{ route('checkout') }}"
                class="btn theme-btn--dark1 btn--lg d-block d-sm-inline-block mt-4 mt-sm-0 rounded-5" style="position: sticky; bottom: 0;">checkout</a>
                @endif
            @endif
        <p class="minicart-message">Free Shipping on All Orders</p>
    </div>
</div>