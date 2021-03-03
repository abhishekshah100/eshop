@extends('admin.main')
@section('content')
<div class="content-wrapper">
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('product.index') }}" style="color:#111;">Product</a></li>
              <li class="breadcrumb-item active">Update Product</li>
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
          <form role="form" method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
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
                        <input type="name" class="form-control" name="product_name" id="exampleInputEmail1" placeholder="Product Name" value="{{ $product->product_name }}">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product Code*</label>
                        <input type="name" class="form-control" name="product_code" value="{{ $product->product_code }}" placeholder="Product Code">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Category*</label>
                          <select class="custom-select" name="product_category">
                            <option value="">Select Category</option>
                            @foreach($category as $categories)
                              <option value="{{ $categories->id }}" {{ $product->product_category==$categories->id?'selected':'' }}>{{ $categories->categoryname }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Brand*</label>
                          <select class="custom-select" name="product_brand">
                            <option value="">Select Brand</option>
                            @foreach($brand as $brands)
                              <option value="{{ $brands->id }}" {{ $product->product_brand==$brands->id?'selected':'' }}>{{ $brands->brandname }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Old Price</label>
                        <input type="number" class="form-control" name="old_price"  value="{{ $product->old_price }}" placeholder="Old Price">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">New Price*</label>
                        <input type="number" class="form-control" name="new_price"  value="{{ $product->new_price }}" placeholder="New Price">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Discount</label>
                        <input type="number" class="form-control" name="discount"  value="{{ $product->discount }}" placeholder="Discount">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product Stock*</label>
                        <input type="number" class="form-control" name="product_stock"  value="{{ $product->product_stock }}" placeholder="Product Stock" readonly >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product SKU</label>
                        <input type="name" class="form-control" name="product_sku"  value="{{ $product->product_sku }}" placeholder="SKU">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Product Status*</label>
                          <select class="custom-select" name="product_status">
                            <option value="">Select Product Status</option>
                              <option value="1" {{ $product->product_status==1?'selected':'' }}>Active</option>
                              <option value="2" {{ $product->product_status==2?'selected':'' }}>Disable</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Description*</label>
                        <textarea class="form-control" rows="4" name="product_description"  placeholder="Description">{{ $product->product_description }}</textarea>
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
                          <input type="file" class="custom-file-input" id="customFile" name="feature_image">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                      </div>
                      <img src="{{ url($product->feature_image) }}" width="100" height="100">
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="customFile">Product Image</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="customFile" name="product_images[]" multiple>
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                      </div>
                      @php 
                      $array_images=json_decode($product->product_images, true);
                      @endphp
                      @foreach($array_images as $image)
                        <img src="/images/products/{{ $image }}" width="100" height="100">
                      @endforeach
                      <div class="input-field">
                          <label class="active">Photos</label>
                          <div class="input-images-2" style="padding-top: .5rem;"></div>
                      </div>
                      <!-- <button type="submit" name="edit_product" class="btn btn-primary ml-2">Edit Product Images</button> -->
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
                        <input type="name" class="form-control" name="metatitle" id="exampleInputEmail1" placeholder="Meta Title" value="{{ $product->metatitle }}">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Meta Description</label>
                        <textarea class="form-control" name="metadescription" id="exampleInputEmail1" placeholder="Meta Description">{{ $product->metadescription }}</textarea>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Meta Keywords</label>
                        <textarea class="form-control" name="metakeywords" id="exampleInputEmail1" placeholder="Meta Keywords">{{ $product->metakeywords }}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Meta Tags Ends -->
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="edit_product" class="btn btn-primary" style="background:#040202">Edit Product</button>
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
@endsection
@push('css')
<link type="text/css" rel="stylesheet" href="{{ asset('admin/dist/js/imagejs/image-uploader.min.css') }}">
@endpush
@push('bottom')
<script src="{{ asset('admin/dist/js/imagejs/image-uploader.min.js') }}"></script>
<script>
  var images = ("{{ json_encode($array_images) }}");
  console.log(typeof images);
  for(var i = 0; i < images.length; i++){ 
    console.log(images[i]); 
}
  let preloaded = [
    {id: 1, src: 'http://127.0.0.1:8000/images/products/1610089692-Abhishek.png'},
    {id: 2, src: 'http://127.0.0.1:8000/images/websiteui/premium_products/1610021228-truck.jpg'},
    {id: 3, src: 'http://127.0.0.1:8000/images/products/1610089692-maxresdefault.jpg'},
    {id: 4, src: 'http://127.0.0.1:8000/images/products/1610089692-eye.png'},
    {id: 5, src: 'http://127.0.0.1:8000/images/products/1610089692-Abhishek.png'},
    {id: 6, src: 'http://127.0.0.1:8000/images/products/1610089947-nature.png'},
];

$('.input-images-2').imageUploader({
    preloaded: preloaded,
    imagesInputName: 'photos',
    preloadedInputName: 'old'
});
</script>
@endpush