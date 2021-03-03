@extends('admin.authentication')
@section('auth_content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('vendor-company') }}"><b>ESHOP</b>LED</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><b>Company Details</b></p>

      <form action="{{ route('vendor-add-company') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <select class="custom-select form-control-border" id="exampleSelectBorder" name="company_type" required="">
                    <option>Select Company Type</option>
                    <option value="1">Company</option>
                    <option value="2">Individual</option>
          </select>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="company_address" placeholder="Company Address" value="{{ old('company_address') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="name" class="form-control" name="company_city" placeholder="Company City" value="{{ old('company_city') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="number" class="form-control" name="company_pincode" placeholder="Company Pincode">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="name" class="form-control" name="company_state" placeholder="Company State">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="name" class="form-control" name="company_country" placeholder="Company Country">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

@endsection