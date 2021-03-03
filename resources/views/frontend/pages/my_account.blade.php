@extends('frontend.other_theme')
@section('content')
<!-- product tab start -->
<div class="my-account pt-80 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="title text-capitalize mb-30 pb-25">my account</h3>
            </div>
            <!-- My Account Tab Menu Start -->
            <div class="col-lg-3 col-12 mb-30">
                <div class="myaccount-tab-menu nav" role="tablist">
                    <a href="#dashboad" data-toggle="tab" class="active"><i class="fas fa-tachometer-alt"></i>
                        Dashboard</a>
                    <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                        Orders</a>
                    <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i>
                        Payment
                        Method</a>
                    <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i>
                        address</a>
                    <a href="#account-info" data-toggle="tab" ><i class="fa fa-user"></i> Account
                        Details</a>
                    <a href="{{ route('logout-user') }}"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </div>
            <!-- My Account Tab Menu End -->
            <!-- My Account Tab Content Start -->
            <div class="col-lg-9 col-12 mb-30">
                <div class="tab-content" id="myaccountContent">
                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade active show" id="dashboad" role="tabpanel">
                        <div class="myaccount-content">
                            <h3>Dashboard</h3>

                            <div class="welcome mb-20">
                                <p>Hello, <strong>{{ $user->first_name }} {{ $user->last_name }}</strong> (If Not <strong>{{ $user->last_name }} !</strong><a
                                        href="/logout" class="logout"> Logout</a>)</p>
                            </div>
                            <p class="mb-0">From your account dashboard. you can easily check &amp; view your
                                recent orders, manage your shipping and billing addresses and edit your
                                password and account details.</p>
                        </div>
                    </div>
                    <!-- Single Tab Content End -->
                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade" id="orders" role="tabpanel">
                        <div class="myaccount-content">
                            <h3>Orders</h3>
                            <div class="myaccount-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Invoice Number</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($get_all_order as $all_order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $all_order->invoice_number }}</td>
                                            <td>{{ $all_order->created_at }}</td>
                                            <td>{{ $all_order->order_status=='1'?'On Process':'Delivered' }}</td>
                                            <td>INR  {{ $all_order->total_invoice_amount }}</td>
                                            <td><a href="shopping-cart.html" class="ht-btn black-btn">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Single Tab Content End -->
                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade" id="payment-method" role="tabpanel">
                        <div class="myaccount-content">
                            <h3>Payment Method</h3>

                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                        </div>
                    </div>
                    <!-- Single Tab Content End -->
                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                        <div class="myaccount-content">
                            <h3>Billing Address</h3>
                        <div class="row">
                            @foreach($all_user_address as  $user_address)
                            <div class="col-md-3 mt-4">
                            <address>
                                <p><strong>{{ $user_address->user_name }}</strong></p>
                                <p>{{ $user_address->address }}<br>
                                                {{ $user_address->city }}, {{ $user_address->state }} {{ $user_address->pincode }}</p>
                                            <p>Mobile: {{ $user_address->phone }}</p>
                            </address>
                            <a class="ht-btn black-btn d-inline-block edit-address-btn" data-toggle="modal" data-target="#edit-address{{ $user_address->id }}"><i
                                    class="fa fa-edit"></i>Edit Address
                            </a>
                             <div class="modal fade style3" id="edit-address{{ $user_address->id }}" tabindex="-1" role="dialog">
                                        @include('frontend.layouts.edit_user_address')
                                    </div>
                        </div>
                            @endforeach
                                <div class="col-md-3 mt-4">
                                        <a href="#" class="ht-btn black-btn d-inline-block edit-address-btn" data-toggle="modal" data-target="#add-new-address"><i class="fa fa-plus" style="font-size: 100px"></i><br>
                                        Add new Address
                                        </a>
                                </div><!--  -->
                        </div>
                    </div>
                </div>
                    <!-- Single Tab Content End -->
                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                        <div class="myaccount-content">
                            <h3>Account Details</h3>
                            <div class="account-details-form">
                                <form action="{{ route('save-account') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-30">
                                            <input id="first-name" placeholder="First Name" name="first_name" type="text" value="{{ $user->first_name }}">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-30">
                                            <input id="last-name" placeholder="Last Name" name="last_name" type="text" value="{{ $user->last_name }}">
                                        </div>
                                        <div class="col-12 mb-30">
                                            <input id="display-name" placeholder="Display Name" type="text" value="{{ $user->first_name }} {{ $user->last_name }}" disabled="">
                                        </div>
                                        <div class="col-12 mb-30">
                                            <input id="email" placeholder="Email Address" name="email" type="email" value="{{ $user->email }}" readonly="">
                                        </div>
                                        <div class="col-12 mb-30">
                                            <h4>Password change</h4>
                                        </div>
                                        <div class="col-12 mb-30">
                                            <input id="current-pwd" placeholder="Current Password" type="password" name="password">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-30">
                                            <input id="new-pwd" placeholder="New Password" name="new_password" type="password">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-30">
                                            <input id="confirm-pwd" placeholder="Confirm Password" name="password_confirmation" type="password">
                                        </div>
                                        <div class="col-12">
                                            <button class="btn theme-btn--dark1 btn--md" name="update_account">Save
                                                Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Single Tab Content End -->
                </div>
            </div>
            <!-- My Account Tab Content End -->
        </div>
    </div>
</div>
<!-- product tab end -->
@endsection
@push('bottom')
@include('frontend.layouts.user_address_scripts')
@endpush