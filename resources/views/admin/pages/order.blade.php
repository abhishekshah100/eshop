@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">View All Orders</li>
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
              <h3 class="card-title">View All Orders</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Invoice Number</th>
                    <th>Order Date</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Number of Products</th>
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($get_all_order as $all_order)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>ES-{{ $all_order->invoice_number }}</td>
                      <td>{{ $all_order->created_at }}</td>
                      <td>{{ $all_order->customer_name }}</td>
                      <td>INR {{ $all_order->total_invoice_amount }}</td>
                      <td>{{ totalorderproductquantity($all_order->id) }}</td>
                      <td>{{ $all_order->payment_mode=='1'?'COD':'Others' }}</td>
                      <td><span class="badge badge-{{ $all_order->order_status=='1'?'danger':'success' }}">{{ $all_order->order_status=='1'?'Unpaid':'Paid' }}</span></td>
                      <td><span class="badge badge-{{ $all_order->order_status=='1'?'danger':'success' }}">{{ $all_order->order_status=='1'?'On Process':'Delivered' }}</span>
                      </td>
          					  <td>
          						  <a href="{{ route('order-invoice', $all_order->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
          						  <a href="{{ route('generate-pdf-order-invoice', $all_order->id)}}" class="btn btn-info"><i class="fas fa-cloud-download-alt"></i></a>
          						  <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
          					  </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>S.N.</th>
                    <th>Order Code</th>
                    <th>User Name</th>
                    <th>Total Amount</th>
                    <th>Number of Products</th>
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                    <th>Date</th>
                    <th>Delivery Status</th>
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