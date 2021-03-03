@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Contacts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">View All Contacts</li>
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
              <h3 class="card-title">All Contact</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Contact Message</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($contact as $contacts)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $contacts->contact_name }}</td>
                      <td>{{ $contacts->contact_email }}</td>
                      <td>{{ $contacts->contact_no }}</td>
                      <td>{{ $contacts->contact_message }}</td>
                      <td>{{ $contacts->created_at }}</td>
                      <td><a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-view{{ $contacts->id }}"><i class="fas fa-eye"></i></a>
						    <div class="modal fade" id="modal-view{{ $contacts->id }}" style="display: none;" aria-hidden="true">
							<div class="modal-dialog">
							  <div class="modal-content">
								<div class="modal-header">
								  <h4 class="modal-title"><strong>Contact Name</strong>: {{ $contacts->contact_name }}</h4>
								</div>
								<div class="modal-body">
								  <div class="form-group">
										<label for="exampleInputEmail1">Contact Email</label> : {{ $contacts->contact_email }}
								  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact Number</label> : {{ $contacts->contact_no }}
                  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Contact Message</label> : {{ $contacts->contact_message }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Date</label> : {{ $contacts->created_at }}
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
						  <a href="{{ route('admin-delete-contact', $contacts->id ) }}" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this detail?');"><i class="fas fa-trash"></i></a></td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Contact Message</th>
                    <th>Date</th>
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
