@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Vendor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">Create New Vendor</li>
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
          <form role="form" method="POST" action="{{ route('admin-post-add-vendor') }}" enctype="multipart/form-data">
            @csrf
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background:#040202;">
                <h3 class="card-title">Vendor Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Full Name*</label>
                        <input type="name" class="form-control" name="full_name"  placeholder="Full Name" value="{{ old('full_name') }}">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Email*</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                      </div>
                    </div>
					          <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Phone Number*</label>
                        <input type="number" class="form-control" name="phone_number"  value="{{ old('phone_number') }}" placeholder="Phone Number">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password*</label>
                        <input type="password" class="form-control" name="password"  value="{{ old('password') }}" placeholder="Password">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password*</label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Company Type*</label>
                        <select class="custom-select" name="company_type" id="companyType">
                            <option value="">Select Company Type</option>
                              <option value="1" {{ old('company_type')=='1'?'selected':'' }}>Company</option>
                              <option value="2" {{ old('company_type')=='2'?'selected':'' }}>Individual</option>
                          </select>
                      </div>
                    </div>
                      <div class="col-md-12 companyInput">
                      </div>
                  </div>
                    <!-- /.card -->
                </div>
          <!--/.col (left) -->
             <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="add_product" class="btn btn-primary" style="background:#040202">Add Vendor</button>
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
@push('bottom')
<script>
$(document).ready(function(){
  $("#companyType").change(function(){
    var companyTypeValue= $(this).val();
    if(companyTypeValue=='1')
    {
      $(".companyInput").append('<div class="row"><div class="col-sm-4"><div class="form-group"><label for="exampleInputPassword1">Company Pin Code*</label><input type="number" class="form-control" name="company_pincode" value="{{ old('company_pincode') }}" placeholder="Company Pin Code"></div></div><div class="col-sm-4"><div class="form-group"><label for="exampleInputPassword1">Company City*</label><input type="name" class="form-control" name="company_city" placeholder="Company City"></div></div><div class="col-sm-4"><div class="form-group"><label for="exampleInputPassword1">Company State*</label><input type="name" class="form-control" name="company_state" value="{{ old('company_state') }}" placeholder="Company State"></div></div><div class="col-sm-4"><div class="form-group"><label for="exampleInputPassword1">Company Country*</label><input type="name" class="form-control" name="company_country" value="{{ old('company_country') }}" placeholder="Company Country"></div></div><div class="col-sm-12"><div class="form-group"><label for="exampleInputPassword1">Company Adrress*</label><textarea class="form-control" rows="4" name="company_address" placeholder="Company Address">{{ old('company_address') }}</textarea></div></div></div>');
    }
    else
    {
      $(".companyInput").empty();
    }
    //$("#categoryName").text(categoryvalue);
  });

});
</script>
@endpush