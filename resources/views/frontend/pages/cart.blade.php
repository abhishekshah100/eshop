@extends('frontend.other_theme')
@section('content')
<x-breadcrumb heading="Cart" />
<!-- product tab start -->
<section class="whish-list-section theme1 pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="title mb-30 pb-25 text-capitalize">Your cart items</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Product Image</th>
                                <th class="text-center" scope="col">Product Name</th>
                                <th class="text-center" scope="col">Stock Status</th>
                                <th class="text-center" scope="col">Qty</th>
                                <th class="text-center" scope="col">Price</th>
                                <th class="text-center" scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($display_cart)>0)
                            @php $total_amount=0; 
                                  $i=0;
                            @endphp
                            @foreach($display_cart as $display_carts)
                                @if(session()->has('customer_auth'))
                                <?php
                                $quantity=$display_carts->quantity;
                                $cartid=$display_carts->id;
                                ?>
                                @else
                                <?php 
                                $quantity=$cookie_product_quantity[$i];
                                $cartid=$cookie_product_id_array[$i];
                                ?>
                                @endif
                                <?php
                                $total_price= $display_carts->new_price * $quantity;
                                
                                ?>
                            <tr>
                                <th class="text-center" scope="row">
                                    <img src="@if(session()->has('customer_auth')) images/products/@endif{{ $display_carts->feature_image }}" alt="img" width="100" height="100">
                                </th>
                                <td class="text-center">
                                    <span class="whish-title">{{ $display_carts->product_name }}</span>
                                </td>
                                <td class="text-center">
                                    @if($display_carts->remaining_stock>0)
                                        <span class="badge badge-success position-static">In Stock</span>
                                    @else
                                        <span class="badge badge-danger position-static">Out of Stock</span>
                                    @endif
                                    <br>
                                    {!! $display_carts->remaining_stock< $quantity ?'<p class="badge badge-danger position-static">'.$display_carts->remaining_stock.' Product Remaining </p>':'' !!}
                                </td>
                                <td class="text-center">
                                    @if($display_carts->remaining_stock>0)
                                    <div class="product-count style">
                                        <div class="count d-flex justify-content-center">
                                            <input type="number" class="quantity" data-quantity="{{ $cartid }}" id="totalquantity{{ $cartid }}" min="1" max="{{ $allow_maximum_stock }}" value="{{ $quantity }}" required readonly>
                                            <input type="hidden" id="hiddentotalquantity{{ $cartid }}" value="{{ $quantity }}">
                                            <!-- <span id="hiddentotalquantity{{ $cartid }}" style="display: none;">{{ $quantity }}</span> -->
                                            <div class="button-group">
                                                <button class="count-btn increment"><i
                                                        class="fas fa-chevron-up"></i></button>
                                                <button class="count-btn decrement"><i
                                                        class="fas fa-chevron-down"></i></button>
                                            </div>
                                        </div>
                                    </div>    
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($display_carts->remaining_stock>0)
                                    <span class="whish-list-price" id="cartprice{{ $cartid }}">
                                        INR {{ $total_price }}
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="trash" data-trash="{{ $cartid }}"> <span ><i class="fas fa-trash-alt"></i> </span></a>
                                </td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                            <tr>
                                <td class="text-center" colspan="4">
                                    <h3 class="title text-capitalize float-right">Total: </h3>
                                </td>
                                <td class="text-center">
                                    <h3 class="title text-capitalize"> INR <span id="totalcartamount"></span></h3>
                                </td>
                                <td class="text-center"></td>
                            </tr>
                        @else
                        <tr>
                          <td colspan="6" style="text-align: center;"><h4>You have no item in your shipping cart, start adding some</h4></td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    @if($total_out_of_stock>0)
                    <a class="btn theme-btn--dark1 btn--lg float-right mt-5" onclick="return alert('{{ $total_out_of_stock }} product{{ $total_out_of_stock>1?'s':'' }} in your cart {{ $total_out_of_stock>1?'are':'is' }} out of stock. Please remove from the cart');">Checkout</a>
                    @elseif($max_quantity>0)
                    <a class="btn theme-btn--dark1 btn--lg float-right mt-5" onclick="return alert('{{ $max_quantity }} product{{ $max_quantity>1?'s':'' }} in your cart {{ $max_quantity>1?'are':'is' }} have the maximum quantity. Please remove from the cart');">Checkout</a>
                    @elseif(!session()->has('customer_auth'))
                    <a href="{{ route('login') }}" class="btn theme-btn--dark1 btn--lg float-right mt-5">Checkout</a>
                    @elseif(count($display_cart)>0)
                   <a href="{{ route('checkout') }}" class="btn theme-btn--dark1 btn--lg float-right mt-5">Checkout</a>
                    @endif     
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product tab end -->
@endsection
@push('bottom')
<script type="text/javascript">
$(document).ready(function(){ 
    $(".trash").click(function(){
          var cart_id = $(this).data("trash");
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/remove-cart') }}",
            type : "GET",
            data : { cart_id : cart_id},
            success: function(data){
                message="This product has been removed from your cart";
                toastr.options.timeOut = 5000; // 1.5s
                toastr.success(message);
                location.reload();
            }
          })
        });
});
</script>
@endpush