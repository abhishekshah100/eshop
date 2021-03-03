@extends('frontend.other_theme')
@section('content')
<x-breadcrumb heading="Wishlist" />
<!-- product tab start -->
<section class="whish-list-section theme1 pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="title mb-30 pb-25 text-capitalize">Wishlist</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Product Image</th>
                                <th class="text-center" scope="col">Product Name</th>
                                <th class="text-center" scope="col">Stock Status</th>
                                <th class="text-center" scope="col">Price</th>
                                <th class="text-center" scope="col">Action</th>
                                <th class="text-center" scope="col">Move To Cart</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if(count($get_wishlist_product)>0)
                            @foreach($get_wishlist_product as $get_wishlist_products)
                            <tr>
                                <th class="text-center" scope="row">
                                    <img src="/images/products/{{ $get_wishlist_products->feature_image }}" alt="img" width="100" height="100">
                                </th>
                                <td class="text-center">
                                    <span class="whish-title">{{ $get_wishlist_products->product_name }}</span>
                                </td>
                                <td class="text-center">
                                  @if($get_wishlist_products->remaining_stock>0)
                                    <span class="badge badge-danger position-static">In Stock</span>
                                  @else
                                    <span class="badge badge-danger position-static">Out of Stock</span>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($get_wishlist_products->remaining_stock>0)
                                    <span class="whish-list-price">INR 
                                       {{ $get_wishlist_products->new_price }}
                                    </span>
                                    @else
                                    
                                  @endif
                                  </td>
                                <td class="text-center">
                                    <a class="trash" data-trashid="{{ $get_wishlist_products->id }}"> <span><i class="fas fa-trash-alt"></i></span></a>
                                </td>
                                <td class="text-center">
                                  @if($get_wishlist_products->remaining_stock>0)
                                    <a class="btn theme-btn--dark1 btn--lg moveToCart" data-cart="{{ $get_wishlist_products->id }}">Move To Cart</a>
                                     @else
                                     <span class="badge badge-danger position-static">Out of Stock</span>
                                     @endif
                                </td>
                            </tr>
                            @endforeach
                          @else
                            <tr>
                              <td colspan="6" style="text-align: center;"><h4>You have no item in your wishlist, start adding some</h4></td>
                            </tr>
                          @endif
                        </tbody>
                    </table>
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
    $(".condition").click(function(){
          var condition_name = $(this).data("condition");
          window.location.replace("{{ url('/all-product')}}/"+condition_name);
          
        });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(".trash").click(function(){
          var trash_id = $(this).data("trashid");
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/wishlistTrashButton') }}",
            type : "GET",
            data : { wishlist_id : trash_id },
            success: function(data){
              if(data=='1')
              {
                location.reload();
              }
            }
          })
        });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(".moveToCart").click(function(){
          var cart_id = $(this).data("cart");
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/movetobagbutton') }}",
            type : "GET",
            data : { cart_id : cart_id },
            success: function(data){
              if(data=='1')
              {
                message="This product has been moved to cart";
                toastr.options.timeOut = 5000; // 1.5s
                toastr.success(message);
                location.reload();
              }
              else
              {
                message="You already have the maximum quantity available for this product.";
                toastr.options.timeOut = 5000; // 1.5s
                toastr.error(message);
              }
            }
          })
        });
});
</script>
@endpush