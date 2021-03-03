@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">View All Products</li>
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
              <h3 class="card-title">All Product</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Feature Image</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Old Price</th>
                    <th>New Price</th>
					          <th>Total Stock</th>
                    <th>Remaining Stock</th>
                    <th>Product Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($product as $products)

                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td><img src="../{{ $products->feature_image }}" width="120" height="120"></td>
                      <td>{{ $products->product_code }}</td>
                      <td>{{ $products->product_name }}</td>
                      <td>{{ $products->category->categoryname }}</td>
                      <td>{{ $products->brand->brandname }}</td>
                      <td>INR {{ $products->old_price }}</td>
                      <td>INR {{ $products->new_price }}</td>
					            <td>{{ $products->product_stock }}</td>
                      <td>{{ $products->remaining_stock }}</td>
                      <td><span class="badge badge-{{ $products->product_status==1?'success':'danger' }}">{{ $products->product_status==1?'Active':'Disable' }}</span></td>
                      <td><a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-view{{ $products->id }}"><i class="fas fa-eye"></i></a>
						    <div class="modal fade" id="modal-view{{ $products->id }}" style="display: none;" aria-hidden="true">
							<div class="modal-dialog">
							  <div class="modal-content">
								<div class="modal-header">
								  <h4 class="modal-title"><strong>Product Name</strong>: {{ $products->product_name }}</h4>
								</div>
								<div class="modal-body">
								  <div class="form-group">
										<label for="exampleInputEmail1">Product Code</label> : {{ $products->product_code }}
								  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product SKU</label> : {{ $products->product_sku }}
                  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Product Name</label> : {{ $products->product_name }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Category</label> : {{ $products->category->categoryname }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Brand</label> : {{ $products->brand->brandname }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Old Price</label> : INR {{ $products->old_price }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">New Price</label> : INR {{ $products->new_price }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Total Stock</label> : {{ $products->product_stock }}
								  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Remaining Stock</label> : {{ $products->remaining_stock }}
                  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Description</label> : {{ $products->product_description }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Title</label> : {{ $products->metatitle }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Slug</label> : {{ $products->slug }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Keywords</label> : {{ $products->metakeywords }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Description</label> : {{ $products->metadescription }}
								  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Status</label> : {{ $products->product_status==1?'Active':'Disable' }}
                  </div>
									<!-- /.card-body --> 
								</div>
								<div class="modal-footer justify-content-between">
								  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
								</div>
							  </div>
							  <!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						  </div>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-stock{{ $products->id }}" data-toggle="tooltip" data-placement="bottom" title="Add Stock"><i class="fas fa-plus"></i></a>
              <!-- Modal For Add Stock -->
              <div class="modal fade" id="modal-stock{{ $products->id }}" style="display: none;" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><b>Add Stock</b></h4>
                  <h5 class="modal-title"><b>Current Stock</b> : <span id="currentStock{{ $products->id }}">{{ $products->remaining_stock }}</span></h5>
                </div>
                <form method="POST" action="/admin/add_stock/{{ $products->id }}">
                  @csrf
                      @method('PUT')
                <div class="modal-body">
                  <div class="form-group">
                    <label for="addStockValue">Add Stock Value</label>
                    <input id= "stockValue{{ $products->id }}" data-stock="{{ $products->id }}" type="number" class="form-control stockValue" name="stock_value" placeholder="Stock Value" required>
                  </div>
                  <div class="form-group">
                    <label for="addStockValue">Available Stock</label>
                    <input id="totalStock{{ $products->id }}" type="number" class="form-control" name="total_stock_value" value="{{ $products->remaining_stock }}" readonly required>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="update_stock">Update Stock</button>
                </div>
                </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
              </div>
              <!-- End Modal For Add Stock -->
              <a href="{{ route('admin-view-product-stock',$products->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="View Stock"><i class="fas fa-tag"></i></a>
						  <a href="{{ route('product.edit',$products->id) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
						  <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
              @if($products->product_status=='1')
                <a href="{{ route('product.status', $products->id ) }}" class="btn btn-danger" data-toggle="tooltip" title="Make Product Inactive"><i class="far fa-thumbs-down"></i></i></a>
              @elseif($products->product_status=='2')
                <a href="{{ route('product.status', $products->id ) }}" class="btn btn-success" data-toggle="tooltip" title="Make Product Active"><i class="far fa-thumbs-up"></i></a>
              @endif
            </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>S.N.</th>
                    <th>Feature Image</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Old Price</th>
                    <th>New Price</th>
					          <th>Total Stock</th>
                    <th>Remaining Stock</th>
                    <th>Product Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
  </div>
@endsection
@push('bottom')
<script type="text/javascript">
    $(document).ready(function(){
    $(".stockValue").click(function(){
          var product_id = $(this).data("stock");
          var currentStock = $("#currentStock"+product_id).text();
          $("#stockValue"+product_id).change(function(){
                  var stock_value=$("#stockValue"+product_id).val();
                  var total_stock=parseInt(currentStock)+parseInt(stock_value);
                  if(total_stock>=0)
                  {
                    $("#totalStock"+product_id).val(total_stock);
                  }
                  else
                  {
                    alert('Total number of stock cannot be in negative');
                    $("#totalStock"+product_id).val(currentStock);
                    $("#stockValue"+product_id).val('');
                  }
          });
        });
    });
</script>
@endpush