@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hot Deal Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">Hot Deal Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="card-body">
                 <div class="row">
                            <div class="col-md-3 ">
                                        
                                          <button class="btn btn-sm btn-dark mb-1" data-toggle="modal" data-target="#modal-add-deal" style="background-color: transparent; border-color: transparent;"><i class="fa fa-plus" style="font-size: 100px; color: #040202;"></i>  </button><br>
                                          Add New Product
                                    </div><!--  -->
                                    <div class="modal fade" id="modal-add-deal" style="display: none;" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><b>Create New Hot Deal</b> </h4>
                </div>
                <form role="form" method="POST" action="{{ route('add-hot-deal') }}">
                  @csrf
                     
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <select name="productname" class="custom-select" required id="productname">
                        <option value="">Select Product</option>
                        @foreach($non_hot_deal_product as $non_hot_deal_products)
                        <option value="{{ $non_hot_deal_products->id }}">{{ $non_hot_deal_products->product_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Expiry Date</label>
                      <input type="date" name="expirydate" class="form-control" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="form-group">`
                      <label for="exampleInputEmail1">Old Price</label>
                      <input type="number" name="old_price" class="form-control" id="productoldprice" readonly="">
                      <input type="hidden" name="hidden_old_price" class="form-control" id="hiddenproductoldprice" readonly="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">New Price</label>
                      <input type="number" name="new_price" class="form-control" id="productnewprice" readonly="">
                      <input type="hidden" name="hidden_new_price" class="form-control" id="hiddenproductnewprice" readonly="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Discount</label>
                      <input type="number" name="discount" class="form-control" id="productdiscount">
                    </div>
                    
                    <!-- /.card-body --> 
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add_hot_deal">Add Hot Deal</button>
                  </div>
                </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
              </div>
              @php
              $present_date=date('Y-m-d H:i:s');
              $present_date_strtotime=date('Y-m-d', strtotime($present_date));
              @endphp
                              @foreach($hot_deal_product as $hot_deal_products)
                              @php
                              $date_strtotime=date('Y-m-d', strtotime($hot_deal_products->hot_deals_expiry_date));
                              @endphp
                                    <div class="col-md-3 mb-3" id="" >
                                           <img class="mb-3" src="{{ asset('images/products/product.png') }}" width="100" height="100">
                                           <p style="margin-bottom: 0;">{{ $hot_deal_products->product_name }}</p>
                                           <p style="margin-bottom: 0;">Price : INR {{ $hot_deal_products->new_price }}</p>
                                           <p style="margin-bottom: 0;">Expiry Date : {{ $hot_deal_products->hot_deals_expiry_date }}</p>
                                           <p style="margin-bottom: 0;">Remaining Stock : {{ $hot_deal_products->product_stock }}</p>
                                           <p style="margin-bottom: 0;">Status : <span class="badge badge-{{ $date_strtotime>$present_date_strtotime?'success':'danger' }}">{{ $date_strtotime > $present_date_strtotime ?'Active':'Disable' }}</span></p>
                                        <button class="btn btn-sm btn-dark mb-1" data-toggle="modal" data-target="#modal-edit-deal{{ $hot_deal_products->id }}"><i class="fa fa-edit"></i> Edit Product</button>

                                        <div class="modal fade" id="modal-edit-deal{{ $hot_deal_products->id }}" style="display: none;" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><b>Update Hot Deal </b> </h4>
                </div>
                <form role="form" method="POST" action="{{ route('edit-hot-deal') }}">
                  @csrf
                     
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <select name="productname" class="custom-select" required id="editproductname{{ $hot_deal_products->id }}">
                        <option value="{{ $hot_deal_products->id }}" selected>{{ $hot_deal_products->product_name }}</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Expiry Date</label>
                      <input type="date" name="expirydate" class="form-control" value="{{ date('Y-m-d', strtotime($hot_deal_products->hot_deals_expiry_date)) }}" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Old Price</label>
                      <input type="number" name="old_price" class="form-control" id="editproductoldprice{{ $hot_deal_products->id }}" value="{{ $hot_deal_products->old_price }}" readonly="">
                      <input type="hidden" name="edit_hidden_old_price" class="form-control" id="hiddeneditproductoldprice{{ $hot_deal_products->id }}" readonly="" value="{{ $hot_deal_products->old_price }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">New Price</label>
                      <input type="number" name="new_price" class="form-control" id="editproductnewprice{{ $hot_deal_products->id }}" value="{{ $hot_deal_products->new_price }}" readonly="">
                      <input type="hidden" name="edit_hidden_new_price" class="form-control" id="hiddeneditproductnewprice{{ $hot_deal_products->id }}" readonly="" value="{{ $hot_deal_products->new_price }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Discount</label>
                      <input type="number" name="discount" class="form-control editdiscount" id="editproductdiscount{{ $hot_deal_products->id }}" data-discount="{{ $hot_deal_products->id }}" value="{{ $hot_deal_products->discount }}">
                    </div>      
                    <!-- /.card-body --> 
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add_hot_deal">Update Hot Deal</button>
                  </div>
                </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
              </div>


                                        <br>
                                        <button class="btn btn-sm btn-danger remove" data-trash_id="{{ $hot_deal_products->id }}" ><i class="fa fa-trash"></i> Remove Product</button>
                                    </div>
                                    @endforeach
                                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- /.content -->
    <!-- /.content -->
  </div>
@endsection
@push('bottom')
<script type="text/javascript">
    $(document).ready(function(){
    $("#productname").change(function(){
          var product_id= $("#productname").val();
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('admin/getproductdetail') }}",
            type : "GET",
            data : { product_id : product_id },
            success: function(data){
              var product=JSON.parse(data);
              $("#productoldprice").val(product.old);
              $("#productnewprice").val(product.new);
              $("#hiddenproductoldprice").val(product.old);
              $("#hiddenproductnewprice").val(product.new);
              $("#productdiscount").val(product.discount);
              if(product.discount!=null)
              {
                $('#productoldprice').prop('readonly', true);
                $('#productnewprice').prop('readonly', true);
              }
              else
              {
                $('#productoldprice').prop('readonly', true);
                $('#productnewprice').prop('readonly', true);
              }
            }
          })
        });

    $("#productdiscount").change(function(){
          var discount= $(this).val();
          if(discount!='')
          {
            var oldprice= $("#hiddenproductoldprice").val();
            var newprice= $("#hiddenproductnewprice").val();
            $('#productoldprice').prop('readonly', true);
            $('#productnewprice').prop('readonly', true);
            var new_newprice=oldprice-(oldprice*discount)/100;
            $("#productnewprice").val(new_newprice);
          }
          else
          {

          }
        });

    $(".editdiscount").change(function(){
          var product_id= $(this).data('discount');
          var discount= $('#editproductdiscount'+product_id).val();
          if(discount!='')
          {
            var oldprice= $("#hiddeneditproductoldprice"+product_id).val();
            var newprice= $("#hiddeneditproductnewprice"+product_id).val();
            $('#editproductoldprice'+product_id).prop('readonly', true);
            $('#editproductnewprice'+product_id).prop('readonly', true);
            var new_newprice=oldprice-(oldprice*discount)/100;
            $("#editproductnewprice"+product_id).val(new_newprice);
          }
          else
          {

          }
        });

    $(".remove").click(function(){
          var confirm = window.confirm("Are you sure you want to remove this product ?");
          if(confirm)
          {
              var product_id= $(this).data("trash_id");
              $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      }
                  });
              $.ajax({
                url: "{{ url('admin/removehotdealproduct') }}",
                type : "GET",
                data : { product_id : product_id },
                success: function(data){
                  message="Hot Deal Product has been removed";
                  toastr.options.timeOut = 5000; // 1.5s
                  toastr.success(message);
                  location.reload();
                }
              })
        }
        });
    });
</script>
@endpush