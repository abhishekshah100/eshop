@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Request Vendor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">View All Request Vendor</li>
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
              <h3 class="card-title">Request Vendor</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Company Type</th>
                    <th>Company Address</th>
                    <th>Company City</th>
                    <th>Company Pincode</th>
					          <th>Company State</th>
                    <th>Company Country</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody onselectstart='return false;'>
                	@foreach($non_verify_vendor as $vendor_detail)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $vendor_detail->full_name }}</td>
                    <td>{{ $vendor_detail->email }}</td>
                    <td>{{ $vendor_detail->role ==1 ? 'Admin':'Vendor'}}</td>
                    <td>{{ $vendor_detail->company_type=='1'?'Company':'Individual' }}</td>
                    <td>{{ $vendor_detail->company_address}}</td>
                    <td>{{ $vendor_detail->company_city}}</td>
                    <td>{{ $vendor_detail->company_pincode}}</td>
                    <td>{{ $vendor_detail->company_state }}</td>
                    <td>{{ $vendor_detail->company_country}}</td>
                    <td><a href="{{ url('admin/approve-vendor/'.$vendor_detail->id) }}" onclick="return confirm('Are you sure you want to approve this vendor?')"><button type="button" class="btn btn-success">Approve</button></a></td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Company Type</th>
                    <th>Company Address</th>
                    <th>Company City</th>
                    <th>Company Pincode</th>
                    <th>Company State</th>
                    <th>Company Country</th>
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
