@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Hot Deals Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">View All Hot Deals Products</li>
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
              <h3 class="card-title">All Hot Deals Products</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Feature Image</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Hot Deal Old Price</th>
                    <th>Hot Deal New Price</th>
                    <th>Hot Deal Discount</th>
                    <th>Hot Deal Expiry Date</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($hot_deals as $hot_deal)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td><img src="../{{ $hot_deal->product->feature_image }}" width="120" height="120"></td>
                      <td>{{ $hot_deal->product->product_name }}</td>
                      <td>{{ $hot_deal->product->product_code }}</td>
                      <td>INR {{ $hot_deal->hot_deals_old_price }}</td>
                      <td>INR {{ $hot_deal->hot_deals_new_price }}</td>
                      <td>{{ $hot_deal->hot_deals_discount }} %</td>
                      <td>{{ $hot_deal->hot_deals_expiry_date }}</td>
                      <td>{{ $hot_deal->created_at }}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>S.N.</th>
                    <th>Feature Image</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Hot Deal Old Price</th>
                    <th>Hot Deal New Price</th>
                    <th>Hot Deal Discount</th>
                    <th>Hot Deal Expiry Date</th>
                    <th>Date</th>
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