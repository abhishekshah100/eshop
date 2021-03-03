@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> ESHOP
                    <small class="float-right">Date: {{ $get_all_order->created_at }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{ $get_all_order->shipping_address_full_name}}</strong><br>
                    {{ $get_all_order->shipping_address }}<br>
                    {{ $get_all_order->shipping_address_state }}, {{ $get_all_order->shipping_address_pincode }}<br>
                    Phone: {{ $get_all_order->shipping_address_phone }}<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{ $get_all_order->billing_address_full_name}}</strong><br>
                    {{ $get_all_order->billing_address }}<br>
                    {{ $get_all_order->billing_address_state }}, {{ $get_all_order->billing_address_pincode }}<br>
                    Phone: {{ $get_all_order->billing_address_phone }}<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice : ES-{{ $get_all_order->invoice_number }}</b><br>
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Date:</b> {{ $get_all_order->created_at }}<br>
                  <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>S.N.</th>
                      <th>Product</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($get_all_order_product as $get_all_order_products)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $get_all_order_products->product_name }}</td>
                      <td>{{ $get_all_order_products->product_quantity }}</td>
                      <td>INR {{ $get_all_order_products->final_price }}</td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  Cash on Delivery

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Enter yourterms and conditions.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>INR {{ $get_all_order->total_invoice_amount }}</td>
                      </tr>
                      <tr>
                        <th>Tax (0%)</th>
                        <td>INR {{ $get_all_order->tax }}</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>INR 0</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>INR {{ $get_all_order->total_invoice_amount }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a onClick="window.print()" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <a href="{{ route('generate-pdf-order-invoice', $get_all_order->id)}}"><button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button></a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection