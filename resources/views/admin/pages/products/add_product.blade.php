@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('product.index') }}" style="color:#111;">Product</a></li>
              <li class="breadcrumb-item active">Create New Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <form role="form" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background:#040202;">
                <h3 class="card-title">Product Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Product Name*</label>
                        <input type="name" class="form-control" name="product_name"  placeholder="Product Name" value="{{ old('product_name') }}">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product Code*</label>
                        <input type="name" class="form-control" name="product_code" value="{{ old('product_code') }}" placeholder="Product Code">
                      </div>
                    </div>
					          <div class="col-sm-4">
                      <div class="form-group">
                        <label>Category*</label>
                        <!-- <select class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select> -->
                        <select class="custom-select" name="product_category">
                            <option value="">Select Category</option>
                            @foreach($category as $categories)
                              <option value="{{ $categories->id }}" {{ old('product_category')==$categories->id?'selected':'' }}>{{ $categories->categoryname }}</option>
                            @endforeach
                          </select>
                        <!-- <div class="typeahead__container">
                        <input type="name" id="categoryName" class="form-control js-typeahead-french_v1" name="product_category" value="{{ old('product_category') }}" placeholder="Product Category" autocomplete="off">
                      </div> -->
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Brand*</label>
                        <select class="custom-select" name="product_brand">
                            <option value="">Select Brand</option>
                            @foreach($brand as $brands)
                              <option value="{{ $brands->id }}" {{ old('product_brand')==$brands->id?'selected':'' }}>{{ $brands->brandname }}</option>
                            @endforeach
                          </select>
                        <!-- <div class="typeahead__container">
                          <input type="name" id="brandName" class="form-control js-typeahead-brand_v1" name="product_brand" value="{{ old('product_brand') }}" placeholder="Product Brand" autocomplete="off">
                        </div> -->
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Old Price</label>
                        <input type="number" class="form-control" name="old_price"  value="{{ old('old_price') }}" placeholder="Old Price">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">New Price*</label>
                        <input type="number" class="form-control" name="new_price"  value="{{ old('new_price') }}" placeholder="New Price">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Discount (%)</label>
                        <input type="number" class="form-control" name="discount"  value="{{ old('discount') }}" placeholder="Discount">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product Stock*</label>
                        <input type="number" class="form-control" name="product_stock"  value="{{ old('product_stock') }}" placeholder="Product Stock">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product SKU*</label>
                        <input type="number" class="form-control" name="product_sku" id="productsku" value="{{ old('product_sku') }}" placeholder="SKU">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Product Status*</label>
                          <select class="custom-select" name="product_status">
                            <option value="">Select Product Status</option>
                              <option value="1" {{ old('product_status')=='1'?'selected':'' }}>Active</option>
                              <option value="2" {{ old('product_status')=='2'?'selected':'' }}>Disable</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Description*</label>
                        <textarea class="form-control" rows="4" name="product_description" id="productdescription" placeholder="Description">{{ old('product_description') }}</textarea>
                  </div>
                </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->

          <!--********Product Image *********-->
           <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background:#040202;">
                <h3 class="card-title">Product Images</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="customFile">Feature Image</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input"  name="feature_image" onchange="preview()">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <img id="showImage" src="" width="120" height="120" style="display: none;" />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="customFile">Product Image</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="product_images[]" multiple onchange="previewMultiple()">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <img id="showMultipleImage" src="" width="120" height="120" style="display: none;" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             </div>
             <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header" style="background:#040202;">
                    <h3 class="card-title">Seo Meta Tags</h3>
                  </div>
                  <!-- /.card-header -->
              
                <!--- Meta Tags --->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Meta Title</label>
                        <input type="name" class="form-control" name="meta_title"  placeholder="Meta Title" value="{{ old('meta_title') }}">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Meta Description</label>
                        <textarea class="form-control" name="meta_description"  placeholder="Meta Description">{{ old('meta_description') }}</textarea>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Meta Keywords</label>
                        <textarea class="form-control" name="metakeywords"  placeholder="Meta Keywords">{{ old('metakeywords') }}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Meta Tags Ends -->
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="add_product" class="btn btn-primary" style="background:#040202">Add Product</button>
                </div>
              
            </div>
            <!-- /.card -->
          </div>
          </form>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
 </div>
 <div class="modal fade" id="modal-add-category" style="display: none;" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><b>Create new Category</b></h4>
                </div>
                <form  method="POST" action="" enctype="multipart/form-data">
                
                <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name*</label>
                    <input type="text" class="form-control" name="categoryname" id="showcategoryvalue" placeholder="Category Name" value="" required>
                  </div>
                   <div class="form-group">
                              <label>Category Image</label>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="category_image">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                          </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Meta Title</label>
                            <input type="name" class="form-control" name="metatitle" id="exampleInputEmail1" placeholder="Meta Title">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Meta Keywords</label>
                            <textarea class="form-control" name="metakeywords" id="exampleInputEmail1" placeholder="Meta Keywords"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Meta Description</label>
                            <textarea class="form-control" name="metadescription" id="exampleInputEmail1" placeholder="Meta Description"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Meta Canonical</label>
                            <input type="text" class="form-control" name="metacanonical" id="exampleInputEmail1" placeholder="Meta Canonical">
                          </div>
                          <div class="form-group">
                          <label>Category Status*</label>
                            <select class="custom-select" name="category_status" disabled="disabled">
                              <option value="">Select Category Status</option>
                                <option value="1" selected="">Active</option>
                                <option value="2">Disable</option>
                            </select>
                          </div>
                  <!-- /.card-body --> 
                    </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="edit_category">Create Category</button>
                </div>
                </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
              </div>
@endsection
@push('bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.js"></script>
<script>
  $.typeahead({
    input: '.js-typeahead-french_v1',
    minLength: 0,
    maxItem: 15,
    order: "asc",
    hint: true,
    accent: true,
    searchOnFocus: true,
    emptyTemplate: 'No result found <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-add-category" id="categorybutton">Create New Category</button>',
    backdrop: {
        "background-color": "#040202",
        "opacity": "0.3",
        "filter": "alpha(opacity=10)"
    },
    source: {
        ab: "{{ route('category-data') }}"
    },
    debug: true
});

  $.typeahead({
    input: '.js-typeahead-brand_v1',
    minLength: 0,
    maxItem: 15,
    order: "asc",
    hint: true,
    accent: true,
    searchOnFocus: true,
    emptyTemplate: 'No result found <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-add-brand" id="brandbutton">Create New Brand</button>',
    backdrop: {
        "background-color": "#040202",
        "opacity": "0.3",
        "filter": "alpha(opacity=10)"
    },
    source: {
        ab: "{{ route('brand-data') }}"
    },
    debug: true
});

$(document).ready(function(){
  $("#categoryName").change(function(){
    var categoryvalue= $("#categoryName").val();
    $("#categoryName").text(categoryvalue);
  });

});
</script>
@endpush
 @push('bottom')
  <script>
    function preview() {
        showImage.src=URL.createObjectURL(event.target.files[0]);
        $("#showImage").show();
    }

    // function previewMultiple() {
    //     showMultipleImage.src=URL.createObjectURL(event.target.files[0]);
    //     $("#showMultipleImage").show();
    // }
  </script>
  @endpush