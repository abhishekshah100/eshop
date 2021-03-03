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
              <li class="breadcrumb-item active">Home Page UI</li>
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
          <!-- left column -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header" style="background:#040202;">
                <h3 class="card-title">Slider Images</h3>
              </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST" action="" enctype="multipart/form-data">
                   @csrf
                   <div class="card-body" style=" padding-bottom: 0;">
                      <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="slider_images">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                        </div>
                        <p>*Recommended Image size: 1920px x 610px </p>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style=" padding-top: 0;">
                      <button type="submit" style="background:#040202" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header" style="background:#040202;">
                <h3 class="card-title">Premium Products Images</h3>
              </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST" >
                  
                    <div class="card-body" style=" padding-bottom: 0;">
                      <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name=""  multiple="">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style=" padding-top: 0;">
                      <button type="submit" style="background:#040202" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header" style="background:#040202;">
                <h3 class="card-title">Popular Categories BG Image</h3>
              </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST" action="{{ route('admin-slider-images') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body" style=" padding-bottom: 0;">
                      <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="" >
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style=" padding-top: 0;">
                      <button type="submit" style="background:#040202" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header" style="background:#040202;">
                <h3 class="card-title">Offer Banners Images</h3>
              </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST" action="">
                 
                    <div class="card-body" style=" padding-bottom: 0;">
                      <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name=""  multiple="">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style=" padding-top: 0;">
                      <button type="submit" style="background:#040202" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>
      
    </section>
 </div>

@endsection
@push('css')

@endpush
@push('bottom')


@endpush