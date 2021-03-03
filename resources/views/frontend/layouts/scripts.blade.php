 <!--***********************-->
    <!--****************************************************** 
        jquery,modernizr ,poppe,bootstrap,plugins and main js
     ******************************************************-->
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/plugins.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!--*************************** 
          Minified  js 
     ***************************-->
    <!--*********************************** 
         vendor,plugins and main js
      ***********************************-->
    <!-- <script src="{{ asset('frontend/assets/js/vendor/vendor.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/plugins.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script> -->
    @php 
      $get_maximum_number_of_stock = App\EcommerceSetting::where('id', 1)->first();
      $allow_maximum_stock=$get_maximum_number_of_stock->maximum_quantity;
    @endphp
    <script>
      $(document).ready(function(){
        $(".pro-btn , .modal-cart, .pro-detail").click(function(){
          var product_id = $(this).data("productid");
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/addtocartproduct') }}",
            type : "GET",
            data : { product_id : product_id },
            success: function(data){
              if(data=='1')
              {
                message="Product has been added to your cart";
                toastr.options.timeOut = 3000; // 1.5s
                toastr.success(message);
                getTotalAmount();
                getTotalQuantity();
                loadoffcanvascart();
                //showProductModalinCart();
                //$('#add-to-cart11').modal('show');
              }
              else
                if(data=='2')
              {
                message="You already have the maximum quantity available for this product.";
                toastr.options.timeOut = 3000; // 1.5s
                toastr.error(message);
              }
            }
          })  
        });

        $(".quantity").change(function(){
          let allow_maximum_stock=<?php echo $allow_maximum_stock; ?>;
          var cart_id = $(this).data("quantity");
          var getQty=$(this).val();
          var hiddentotalquantity= $('#hiddentotalquantity'+cart_id).val();
            if(getQty=='')
          {
            message="Product Quantity cannot be empty";
            toastr.options.timeOut = 5000; // 1.5s
            toastr.error(message);
            $('#hiddentotalquantity'+cart_id).val(hiddentotalquantity);
            var displayquantity= $('#totalquantity'+cart_id).val(hiddentotalquantity);
          }
          else
          if(getQty<=0)
          {
            message="Product Quantity cannot be in negative or zero";
            toastr.options.timeOut = 5000; // 1.5s
            toastr.error(message);
            $('#hiddentotalquantity'+cart_id).val(hiddentotalquantity);
            var displayquantity= $('#totalquantity'+cart_id).val(hiddentotalquantity);
          }
          else
            if(getQty>allow_maximum_stock)
          {
            message="You already have the maximum quantity available for this product";
            toastr.options.timeOut = 5000; // 1.5s
            toastr.error(message);
            $('#hiddentotalquantity'+cart_id).val(hiddentotalquantity);
            var displayquantity= $('#totalquantity'+cart_id).val(hiddentotalquantity);
          }
          else
          {
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/quantity-cart') }}",
            type : "GET",
            data : { cart_id : cart_id, update_qty : getQty },
            success: function(data){
              $("#cartprice"+cart_id).text("INR "+ data);
              getTotalAmount();
              getTotalQuantity();
              loadoffcanvascart();
            }
          })
        }
        });
    });

      function showProductModalinCart(){
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/showmodalincart') }}",
            type : "GET",
            success: function(data){
              alert(data);
            }
          })
      }

      function loadoffcanvascart(){
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/offcanvascart') }}",
            type : "GET",
            success: function(data){
              $("#offcanvascart").empty();
              $("#offcanvascart").prepend(data);
            }
          })
      }

      function loadoffcanvaswishlist(){
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/offcanvaswishlist') }}",
            type : "GET",
            success: function(data){
              $("#offcanvaswishlist").empty();
              $("#offcanvaswishlist").prepend(data);
            }
          })
      }

      function getTotalQuantity(){
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/gettotalquantity') }}",
            type : "GET",
            success: function(data){
              $("#totalquantity").text(data);
            }
          })
      }
      function getTotalWishlist(){
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/gettotalwishlist') }}",
            type : "GET",
            success: function(data){
              $("#totalwishlist").text(data);
            }
          })
      }
      function getTotalAmount(){
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/gettotalamount') }}",
            type : "GET",
            success: function(data){
              $("#totalamount").text('INR '+data);
              $("#totalcartamount").text(data);
            }
          })
      }

      $("#testwishlist").click(function(){
          //var remove_id = $(this).data("removeid");
          alert('100');
          // $.ajaxSetup({
          //         headers: {
          //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          //         }
          //     });
          // $.ajax({
          //   url: "{{ url('/wishlistTrashButton') }}",
          //   type : "GET",
          //   data : { wishlist_id : trash_id },
          //   success: function(data){
          //     loadoffcanvaswishlist();
          //   }
          // })
        });
      var message;
    $(".wishlistproduct").click(function(){
          var wishlist_product_id = $(this).data("wishlist");
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/ajax-wishlist') }}",
            type : "GET",
            data : { wishlist_product_id : wishlist_product_id },
            success: function(data){
                if(data=='1')
                    {
                        message="Wishlist added";
                        toastr.options.timeOut = 5000; // 1.5s
                        toastr.success(message);
                    }
                else
                if(data=='2')
                    {
                        message="This Product is already on the wishlist";
                        toastr.options.timeOut = 5000; // 1.5s
                        toastr.success(message);
                    }
            }
          });
             getTotalWishlist();
             loadoffcanvaswishlist();
            });
    
 getTotalAmount();
 getTotalWishlist();
 getTotalQuantity();
 loadoffcanvascart();
 loadoffcanvaswishlist();
    </script>
    @stack('bottom')

 <!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css"> -->
 <!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  @php 
    $array_product_name=array();
    $get_product_name = App\Product::where('product_status','1')->get();
    
    foreach($get_product_name as $get_product_names)
    {
      array_push($array_product_name, $get_product_names->product_name);
    }
    $implode_product_name= '"'.implode('","',$array_product_name).'"';
  @endphp
  <script>
  $( function() {
    var availableTags = [
    <?php echo $implode_product_name; ?>
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  </script>
  
