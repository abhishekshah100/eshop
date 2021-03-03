@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Other Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">Other Settings</li>
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background:#040202;">
                <h3 class="card-title">Other Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('update-other-settings') }}">
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Maximum Quantity</label>
                    <input type="number" class="form-control" name="maximum_quantity" placeholder="Maximum Quantity" value="{{ $maximum_quantity->maximum_quantity }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Paginaion (Product Per Page)</label>
                    <input type="number" class="form-control" name="pagination" placeholder="Pagination (Product Per Page)" value="{{ $maximum_quantity->pagination }}">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_url" class="btn btn-primary" style="background:#040202">Update Other Settings</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
		  <!-- left column -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
  </div>
  @endsection