@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Website Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">Website Settings</li>
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
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background:#040202;">
                <h3 class="card-title">Website Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('update-website-settings') }}" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Main URL</label>
                        <input type="name" class="form-control" name="website_url"  placeholder="Website URL" value="{{ $website_setting->website_url }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Website Logo</label>
                        <input type="file" class="form-control" name="website_logo">
                      </div>
                      <img src="../images/website/logo/{{ $website_setting->website_logo }}" width="100">
                      <P>*Recommended Image size: 137px x 36px</P>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Website Name</label>
                        <input type="name" class="form-control" name="website_name"  placeholder="Website Name" value="{{ $website_setting->website_name }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Website Email</label>
                        <input type="name" class="form-control" name="website_email" placeholder="Website Email" value="{{ $website_setting->website_email }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Website Contact Number</label>
                        <input type="name" class="form-control" name="contactno"  placeholder="Website Contact Number" value="{{ $website_setting->contactno }}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Website Address</label>
                        <input type="name" class="form-control" name="address"  placeholder="Website Address" value="{{ $website_setting->address }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Website State</label>
                        <input type="name" class="form-control" name="state" placeholder="Website State" value="{{ $website_setting->state }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Website Pincode</label>
                        <input type="name" class="form-control" name="pincode"  placeholder="Website Pincode" value="{{ $website_setting->pincode }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Facebook URL</label>
                        <input type="name" class="form-control" name="facebook_url"  placeholder="Facebook URL" value="{{ $website_setting->facebook_url }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Youtube URL</label>
                        <input type="name" class="form-control" name="youtube_url"  placeholder="Youtube URL" value="{{ $website_setting->youtube_url }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Twitter URL</label>
                        <input type="name" class="form-control" name="twitter_url"  placeholder="Twitter URL" value="{{ $website_setting->twitter_url }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Instagram URL</label>
                        <input type="name" class="form-control" name="instagram_url"  placeholder="Instagram URL" value="{{ $website_setting->instagram_url }}">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_url" class="btn btn-primary" style="background:#040202">Update</button>
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