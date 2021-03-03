@extends('frontend.other_theme')
@section('content')
<x-breadcrumb heading="Checkout" />
<!-- product tab start -->
<section class="check-out-section pt-80 pb-50">
    <div class="container">
    	<form action="{{ url('checkout') }}" method="POST" class="personal-information">
    		@csrf
        <div class="row">
            <div class="col-lg-8 mb-30">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    Shipping Address
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <h6 class="ml-3"><strong>Select Your Shipping Address</strong></h6>
                            <div class="card-body">    
                                <div class="row">
                                    @foreach($all_user_address as $user_address)
                                    <div class="col-md-3 selectedaddress mt-4" id="addressbox{{ $user_address->id }}" data-addressbox="{{ $user_address->id }}">
                                        <address>
                                            <p><strong>{{ $user_address->user_name }}</strong></p>
                                            <p>{{ $user_address->address }}<br>
                                                {{ $user_address->city }}, {{ $user_address->state }} {{ $user_address->pincode }}</p>
                                            <p>Mobile: {{ $user_address->phone }}</p>
                                        </address>
                                        <a  class="ht-btn black-btn d-inline-block edit-address-btn" data-toggle="modal" data-target="#edit-address{{ $user_address->id }}"><i class="fa fa-edit"></i>Edit Address</a>
                                    </div>
                                    <div class="modal fade style3" id="edit-address{{ $user_address->id }}" tabindex="-1" role="dialog">
                                        @include('frontend.layouts.edit_user_address')
                                    </div>
                                    @endforeach
                                    <div class="col-md-3 mt-4">
                                        <a href="#" class="ht-btn black-btn d-inline-block edit-address-btn" data-toggle="modal" data-target="#add-new-address"><i class="fa fa-plus" style="font-size: 100px"></i><br>
                                        Add new Address
                                        </a>
                                    </div><!--  -->
                                    <input type="hidden" id="hiddenShippingAddress" name="hidden_shipping_address" value="" required>
                                    <div class="card-body pt-0" id="billingCardBody">
                                        <div class="mb-4 mt-4">
                                            <input type="checkbox" id="samebilladdresscheckbox" name="sameshippingaddress">
                                            <label for="20828">Billing Address same as Shipping Address</label>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="billingAddressCard">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive">
                                    Billing Address
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <h6 class="ml-3"><strong>Select Your Billing Address</strong></h6>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($all_user_address as $user_address)
                                    <div class="col-md-3 selectedaddress2 mt-4" id="addressbox2{{ $user_address->id }}" data-addressbox2="{{ $user_address->id }}">
                                        <address>
                                            <p><strong>{{ $user_address->user_name }}</strong></p>
                                            <p>{{ $user_address->address }}<br>
                                                {{ $user_address->city }}, {{ $user_address->state }} {{ $user_address->pincode }}</p>
                                            <p>Mobile: {{ $user_address->phone }}</p>
                                        </address>
                                        <a href="#" class="ht-btn black-btn d-inline-block edit-address-btn" data-toggle="modal" data-target="#edit-bill-address{{ $user_address->id }}"><i class="fa fa-edit"></i>Edit Address
                                        </a>
                                    </div>
                                    <div class="modal fade style3" id="edit-bill-address{{ $user_address->id }}" tabindex="-1" role="dialog">
                                        @include('frontend.layouts.edit_user_address')
                                    </div>
                                    @endforeach
                                    <div class="col-md-3 mt-4">
                                        <a href="#" class="ht-btn black-btn d-inline-block edit-address-btn" data-toggle="modal" data-target="#add-new-address"><i class="fa fa-plus" style="font-size: 100px"></i><br>
                                        Add new Address
                                        </a>
                                    </div>
                                    <input type="hidden" id="hiddenBillingAddress" name="hidden_billing_address" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span></span> Shipping Method
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <div class="delivery-options-list">
                                        <div class="delivery-option">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-1">
                                                            <div class="custom-radio-modify">
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="test3" name="radio-group">
                                                                    <label id="pull-up" for="test3"> </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-11 delivery-option-2">
                                                        	<div class="row align-items-center">
                                                                <div class="col-sm-5 col-12">
                                                                    <div class="row align-items-center">
                                                                    	<div class="col-3">
                                                                    		<input type="radio" id="test5"  name="shipping_method" checked="">
                                                                    	</div>
                                                                        <div class="col-3">
                                                                            <img src="{{ asset('frontend/assets/img/icon/10.jpg') }}"
                                                                                alt="My carrier">
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <span class="carrier-name">Normal Delivery</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-12">
                                                                    <span class="carrier-delay">Delivery next
                                                                        day!</span>
                                                                </div>
                                                                <div class="col-sm-3 col-12">
                                                                    <span class="carrier-price">INR 0 tax excl.</span>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-5 col-12">
                                                                    <div class="row align-items-center">
                                                                    	<div class="col-3">
                                                                    		<input type="radio" id="test5"  name="shipping_method">
                                                                    	</div>
                                                                        <div class="col-3">
                                                                            <img src="{{ asset('frontend/assets/img/icon/10.jpg') }}"
                                                                                alt="My carrier">
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <span class="carrier-name">Premimum Delivery</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-12">
                                                                    <span class="carrier-delay">Delivery next
                                                                        day!</span>
                                                                </div>
                                                                <div class="col-sm-3 col-12">
                                                                    <span class="carrier-price">$7.00 tax excl.</span>
                                                                </div>
                                                            </div>
                                                             
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-options">
                                            <div id="delivery" class="text-right">
                                                <label class="text-left d-block">If you would like to add a comment
                                                    about your order, please write it in the field
                                                    below.</label>
                                                <textarea class="form-control mt-2 mb-4" name="shipping_comment"></textarea>
                                                <button type="button" class="btn theme-btn--dark1 btn--md">
                                                    Continue
                                                </button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span></span> Payment
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        	<div class="card-body">
                                <div class="delivery-options-list">
                                        <div class="delivery-option">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-1">
                                                            <div class="custom-radio-modify">
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="test3" name="payment_method">
                                                                    <label id="pull-up" for="test3"> </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-11 delivery-option-2">
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-6 col-12">
                                                                    <div class="row align-items-center">
                                                                    	<div class="col-3">
                                                                    		<input type="radio" id="test5" name="payment_method" checked="">
                                                                    	</div>
                                                                        <div class="col-3">
                                                                            <img src="{{ asset('frontend/assets/img/icon/10.jpg') }}"
                                                                                alt="My carrier">
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <span class="carrier-name">Pay by Cash on Delivery</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="filter-check-box mb-4">
                                    <input type="checkbox" id="20828" required="">
                                    <label for="20828">I agree to the terms and Conditions</label>
                                </div>
                                <!-- <button class="btn theme-btn--dark1 btn--md text-capitalize">
                                    order now
                                </button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-30">
                <ul class="list-group cart-summary rounded-0">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <ul class="items">
                            <li>{{ $total_quantity }} item</li>
                            <li>Shipping</li>
                            <li>Taxes</li>
                            <li id="deliveryHeading"></li>
                            <li id="couponHeading"></li>
                        </ul>
                        <ul class="amount">
                            <li>INR {{ $total_cart_amount }}</li>
                            <li>0</li>
                            <li>0</li>
                            <li id="deliveryAmount"></li>
                            <li id="couponAmount"></li>
                        </ul>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <ul class="items">
                            <li>Total</li>
                        </ul>
                        <ul class="amount">
                            <li>INR <span id="totalCheckoutAmt">{{ $total_cart_amount }}</span></li> 
                        </ul>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <ul class="amount">
                            <li><input type="text" class="form-control text-uppercase" id="couponCode" placeholder="Coupon Code"></li>
                        </ul>
                        <ul class="items">
                            <li><button type="button" class="btn theme-btn--dark1 btn--md" id="applyCoupon">Apply Coupon</button></li>
                        </ul>
                    </li>
                    <li class="list-group-item text-center">
                        <button type="submit" class="btn theme-btn--dark1 btn--md" required>Proceed to checkout</button>
                    </li>
                </ul>
                <input type="hidden" id="hiddenTotalCheckoutAmt" name="total_amount" value="{{ $total_cart_amount }}">

                <div class="delivery-info mt-20">
                    <ul>
                        <li>
                            <img src="{{ asset('frontend/assets/img/icon/10.png') }}" alt="icon"> Security policy (edit with Customer
                            reassurance module)
                        </li>
                        <li>
                            <img src="{{ asset('frontend/assets/img/icon/11.png') }}" alt="icon"> Delivery policy (edit with Customer
                            reassurance module)
                        </li>
                        <li class="mb-0">
                            <img src="{{ asset('frontend/assets/img/icon/12.png') }}" alt="icon"> Return policy (edit with Customer
                            reassurance module)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>
<!-- product tab end -->
<!--- Modal for add new address -->
<!---End Modal for Add new Address --->
@endsection
@push('bottom')
<script type="text/javascript">
    $(document).ready(function(){
        $("#applyCoupon").click(function(){
            var coupon=$('#couponCode').val().toUpperCase();
            var actual_checkout_amt=$("#hiddenTotalCheckoutAmt").val();
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
          $.ajax({
            url: "{{ url('/check-coupon') }}",
            type : "GET",
            data : { coupon_code : coupon},
            success: function(data){
                if(data=='1')
                {
                    $('#couponHeading').text('');
                    $("#couponAmount").text('');
                    $("#totalCheckoutAmt").text('');
                    $("#totalCheckoutAmt").text(actual_checkout_amt);
                    message=`You have already used this coupon code. Try Another Coupon Code`;
                    toastr.options.timeOut = 5000; // 1.5s
                    toastr.error(message);
                }
                else
                if(data=='2')
                {
                    $('#couponHeading').text('');
                    $("#couponAmount").text('');
                    $("#totalCheckoutAmt").text('');
                    $("#totalCheckoutAmt").text(actual_checkout_amt);
                    message=`This coupon code is invalid or has expired.`;
                    toastr.options.timeOut = 5000; // 1.5s
                    toastr.error(message);
                }
                else
                if(data=='3')
                {
                    $('#couponHeading').text('');
                    $("#couponAmount").text('');
                    $("#totalCheckoutAmt").text('');
                    $("#totalCheckoutAmt").text(actual_checkout_amt);
                    message=`Please login to apply coupon code`;
                    toastr.options.timeOut = 5000; // 1.5s
                    toastr.error(message);
                }
                else
                {
                    var discount_percentage=data.discount_percentage;
                    var amount_upto=data.discount_amount_upto;
                    var minimum_amount=data.minimum_amount;
                    if(actual_checkout_amt >=minimum_amount){
                        let coupon_discount_total_amount=(actual_checkout_amt*discount_percentage)/100;
                        if(coupon_discount_total_amount>amount_upto)
                        {
                            coupon_discount_total_amount=amount_upto;
                        }
                        let checkout_amount=actual_checkout_amt-coupon_discount_total_amount;
                        $('#couponHeading').text(`Coupon Code (${discount_percentage}%)`);
                        $("#couponAmount").html(`INR ${coupon_discount_total_amount}<input type="hidden" name="coupon_code" value="${coupon}">`);
                        $("#totalCheckoutAmt").text(checkout_amount);
                        message=`The ${data.coupon_code} coupon code has been applied and redeemed successfully.`;
                        toastr.options.timeOut = 5000; // 1.5s
                        toastr.success(message);    
                    }
                    else
                    {
                        $('#couponHeading').text('');
                        $("#couponAmount").text('');
                        $("#totalCheckoutAmt").text('');
                        console.log(actual_checkout_amt);
                        $("#totalCheckoutAmt").text(actual_checkout_amt);
                        message=`Get ${discount_percentage}% off if you spend more than ${minimum_amount}`;
                        toastr.options.timeOut = 5000; // 1.5
                        toastr.error(message);
                    }
                }
            }
          });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#billingCardBody').hide();
        $(".selectedaddress").click(function(){
              var addressnumber = $(this).data("addressbox");
              var actual_checkout_amt=Number($("#hiddenTotalCheckoutAmt").val());
              $(".selectedaddress").css("border", "");
              $("#addressbox"+addressnumber).css("border", "1px solid #f33535");
              $('#billingCardBody').show();
              $('#hiddenShippingAddress').val(addressnumber);
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              $.ajax({
                    url: "{{ route('get-delivery-information') }}",
                    type : "GET",
                    data : { useraddress : addressnumber, totalAmount : actual_checkout_amt },
                    success: function(data){
                      if(data=='no'){
                        alert('Cannot Deliver in this address');
                        $('#deliveryHeading').text('');
                        $("#deliveryAmount").html('');
                        $("#totalCheckoutAmt").text(actual_checkout_amt);
                      }else{
                        var getData=$.parseJSON(data);
                        let checkout_amount=actual_checkout_amt+getData.delivery_charges;
                        $('#deliveryHeading').text(`Delivery Charges `);
                        $("#deliveryAmount").html(`INR ${getData.delivery_charges}<input type="hidden" name="delivery_charges" value="${getData.delivery_charges}">`);
                        $("#totalCheckoutAmt").text(checkout_amount);
                      }
                    }
                  });
            });
        });
    $(document).ready(function(){
        $(".selectedaddress2").click(function(){
              var addressnumber2 = $(this).data("addressbox2");
              $(".selectedaddress2").css("border", "");
              $("#addressbox2"+addressnumber2).css("border", "1px solid #f33535");
              $('#hiddenBillingAddress').val(addressnumber2);
            });
        });
</script>
<script type="text/javascript">
    $(document).ready(function(){
    $("#samebilladdresscheckbox").click(function(){
        if($(this).prop("checked") == true){
            $('#billingAddressCard').hide();
            $("#hiddenBillingAddress").prop('required',false);
        }
        else if($(this).prop("checked") == false){
            $('#billingAddressCard').show();
            $("#hiddenBillingAddress").prop('required',true);
        }
      });
    });
</script>
@include('frontend.layouts.user_address_scripts')
@endpush