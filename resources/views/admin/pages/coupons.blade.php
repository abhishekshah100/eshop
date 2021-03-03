@extends('admin.main')
@section('content')
@php
$present_date=date('Y-m-d');
@endphp
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Coupon</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">View All Coupon</li>
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
              <h3 class="card-title">All Coupon</h3>
              <button type="button" class="btn btn-primary" style="background:#040202; float: right;" data-toggle="modal" data-target="#modal-add">Add New Coupon</button>
              <div class="modal fade" id="modal-add" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><b>Create Coupon</b> </h4>
                  </div>
                  <form  method="POST" action="{{ route('add-coupon') }}">
                    @csrf
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Coupon Code</label>
                          <input type="name" class="form-control text-uppercase" name="coupon_code" placeholder="Coupon Code" value="{{ old('coupon_code') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Discount Percentage</label>
                            <input type="number" class="form-control" name="discount_percentage" placeholder="Discount Percentage" value="{{ old('discount_percentage') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Discount Amount Upto</label>
                            <input type="text" class="form-control" name="discount_amount_upto" placeholder="Discount Amount Upto" value="{{ old('discount_amount_upto') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Use per Customer</label>
                            <input type="number" class="form-control" name="use_per_customer" placeholder="Use Per Customer" value="{{ old('use_per_customer') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Starting Date</label>
                            <input type="date" class="form-control" name="starting_date" placeholder="Starting Date" min="{{ $present_date }}" value="{{ old('starting_date') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ending Date</label>
                            <input type="date" min="{{ $present_date }}" class="form-control" name="ending_date" placeholder="Ending Date" value="{{ old('ending_date') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Minimum Amount Order</label>
                            <input type="number" class="form-control" name="minimum_amount" placeholder="Minimum Amount Order" value="{{ old('minimum_amount') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6 mt-5">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="coupon_status" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Is Published?</label>
                        </div>
                      </div>
                    </div> 
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Coupon</button>
                  </div>
                  </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
              <!-- /.modal-dialog -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Coupon Code</th>
                    <th>Discount Percentage</th>
                    <th>Discount Amount Upto</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Minimum Amount Order</th>
                    <th>Use Per Customer</th>
                    <th>Total Usage</th>
                    <th>Coupon Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($coupons as $coupon)
                  @php 
                    $total_coupon_use = App\Order::where('coupon_id',$coupon->id)->count();
                  @endphp
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $coupon->coupon_code }}</td>
                      <td>{{ $coupon->discount_percentage }} %</td>
                      <td>INR {{ $coupon->discount_amount_upto }}</td>
                      <td>{{ $coupon->starting_date }}</td>
                      <td>{{ $coupon->ending_date }}</td>
                      <td>INR {{ $coupon->minimum_amount }}</td>
                      <td>{{ $coupon->use_per_customer }}</td>
                      <td>{{ $total_coupon_use }}</td>
                      <td><span class="badge badge-{{ $coupon->coupon_status==1?'success':'danger' }}">{{ $coupon->coupon_status==1?'Active':'Disable' }}</span></td>
                      <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-edit{{ $coupon->id }}"><i class="fas fa-pencil-alt">
                              </i></button>
                      <div class="modal fade" id="modal-edit{{ $coupon->id }}" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title"><b>Edit Coupon</b> </h4>
                            </div>
                            <form  method="POST" action="{{ route('update-coupon', $coupon->id) }}">
                              @csrf
                              @method('PATCH')
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Coupon Code</label>
                                      <input type="name" class="form-control text-uppercase" name="coupon_code" placeholder="Coupon Code" value="{{ $coupon->coupon_code }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Discount Percentage</label>
                                        <input type="number" class="form-control" name="discount_percentage" placeholder="Discount Percentage" value="{{ $coupon->discount_percentage }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Discount Amount Upto</label>
                                        <input type="text" class="form-control" name="discount_amount_upto" placeholder="Discount Amount Upto" value="{{ $coupon->discount_amount_upto }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Use Per Customer</label>
                                        <input type="number" class="form-control" name="use_per_customer" placeholder="Use Per Customer" value="{{ $coupon->use_per_customer }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Starting Date</label>
                                        <input type="date" class="form-control" name="starting_date" placeholder="Starting Date" min="{{ $present_date }}" value="{{ $coupon->starting_date }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ending Date</label>
                                        <input type="date" min="{{ $present_date }}" class="form-control" name="ending_date" placeholder="Ending Date" value="{{ $coupon->ending_date }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Minimum Amount Order</label>
                                        <input type="number" class="form-control" name="minimum_amount" placeholder="Minimum Amount Order" value="{{ $coupon->minimum_amount }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6 mt-5">
                                    <div class="form-check">
                                      <input type="checkbox" class="form-check-input" name="coupon_status" id="exampleCheck1" {{ $coupon->coupon_status=='1'?'checked':'' }}>
                                      <label class="form-check-label" for="exampleCheck1">Is Published?</label>
                                    </div>
                                  </div>
                                </div> 
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Coupon</button>
                              </div>
                            </form>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                      <!-- /.modal-dialog -->
                      </div>
                      <form method="POST" action="{{ route('delete-coupon', $coupon->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this detail?');"><i class="fas fa-trash"></i></button>
                      </form>
                      @if($coupon->coupon_status=='1')
                        <a href="{{ route('coupon.status', $coupon->id ) }}" class="btn btn-danger" data-toggle="tooltip" title="Make Coupon Inactive"><i class="far fa-thumbs-down"></i></i></a>
                      @elseif($coupon->coupon_status=='2')
                        <a href="{{ route('coupon.status', $coupon->id ) }}" class="btn btn-success" data-toggle="tooltip" title="Make Coupon Active"><i class="far fa-thumbs-up"></i></a>
                      @endif
						  </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>S.N.</th>
                    <th>Coupon Code</th>
                    <th>Discount Percentage</th>
                    <th>Discount Amount Upto</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Minimum Amount Order</th>
                    <th>Use Per Customer</th>
                    <th>Total Usage</th>
                    <th>Coupon Status</th>
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
