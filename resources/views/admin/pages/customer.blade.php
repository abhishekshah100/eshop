@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Customers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">View All Customers</li>
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
              <h3 class="card-title">View All Customer</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Customer User Name</th>
                    <th>Customer Email</th>
                    <th>Member Since</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($all_customer as $all_customers)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $all_customers->user_name }}</td>
                      <td>{{ $all_customers->email }}</td>
                      <td>{{ $all_customers->created_at }}</td>
                      <td><span class="badge badge-{{ $all_customers->user_status=='1'?'success':'danger' }}">{{ $all_customers->user_status=='1'?'Active':'Not Active' }}</span></td>
          					  <td>
          						  <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-view{{ $all_customers->id }}"><i class="fas fa-eye"></i></a>
                        </a>
                        <!-- ModalStart for view customer -->
                        <div class="modal fade" id="modal-view{{ $all_customers->id }}" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">View Customer: </h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Customer User Name</label> : {{ $all_customers->user_name }}
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Customer First Name</label> : {{ $all_customers->first_name }}
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Customer Last Name</label> : {{ $all_customers->last_name }}
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Customer Email</label> : {{ $all_customers->email }}
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Customer Phone</label> : {{ $all_customers->phone }}
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Customer Date of Birth</label> : {{ $all_customers->date_birth }}
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Customer Address</label> : {{ $all_customers->adddress }}
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Customer Status</label> : <span class="badge badge-{{ $all_customers->user_status=='1'?'success':'danger' }}">{{ $all_customers->user_status=='1'?'Active':'Not Active' }}</span> 
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Customer Register Date</label> : {{ $all_customers->created_at }} 
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
                        <!-- Modal end for view customer -->
                        <a href="#" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-secondary" data-toggle="tooltip" title="View Order Products"><i class="fas fa-folder"></i></a>
          						  <a href="#" class="btn btn-warning"><i class="far fa-flag"></i></a>
          						  <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        @if($all_customers->user_status=='0')
                          <a href="{{ route('customer.status', $all_customers->id ) }}" class="btn btn-danger" data-toggle="tooltip" title="Make Customer Inactive"><i class="far fa-thumbs-down"></i></i></a>
                        @elseif($all_customers->user_status=='1')
                          <a href="{{ route('customer.status', $all_customers->id ) }}" class="btn btn-success" data-toggle="tooltip" title="Make Customer Active"><i class="far fa-thumbs-up"></i></a>
                        @endif
          					  </td>
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>S.N.</th>
                    <th>Customer User Name</th>
                    <th>Customer Email</th>
                    <th>Member Since</th>
                    <th>Status</th>
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