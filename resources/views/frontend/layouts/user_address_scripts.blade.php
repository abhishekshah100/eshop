<div class="modal fade style3" id="add-new-address" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header justify-content-center bg-dark">
                <h5 class="modal-title" id="add-new-addressCenterTitle"> <span class="ion-checkmark-round"></span>
                    Add New Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="check-out-content">
                                        <form id="submit_form" class="p-0" action="" method="post">
                                            <div class="form-group row">
                                                <label class="col-md-3" for="firstName2">Full name</label>
                                                <div class="col-md-6">
                                                    <input id="shipping_full_name" class="form-control" name="fullname" type="text" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3" for="address1">Address</label>
                                                <div class="col-md-6">
                                                    <textarea id="shipping_address" class="form-control" name="address"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3" for="city">City</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" id="shipping_city" name="city" type="text" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3">State</label>
                                                <div class="col-md-6">
                                                    <select class="form-control" id="shipping_states" name="state">
                                                        <option value="">-- please choose --</option>
                                                        <option value="Delhi">Delhi</option>
                                                        <option value="Noida">Noida</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3" for="zip">Phone No</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" id="shipping_phone" name="phone" type="text" required="" pattern="[7-9]{1}[0-9]{9}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3" for="zip">Pin Code</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" id="shipping_pin_code" name="pincode" type="text" required="" pattern="[0-9]{6}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3">Country</label>
                                                <div class="col-md-6">
                                                    <select class="form-control" name="country" id="shipping_country">
                                                        <option value="">-- please choose --</option>
                                                        <option value="india">India</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-12 text-center">
                                                    <button type="button" id="shipping_continue" class="btn theme-btn--dark1 btn--md">Continue</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#shipping_continue").click(function(){
           var fullname = $('#shipping_fullname').val();  
           var address = $('#shipping_address').val();
           var city = $('#shippingcity').val();  
           var state = $('#shipping_city').val();
           var phone = $('#shipping_phone').val();
           var pin_code = $('#shipping_pin_code').val();
           var country = $('#shipping_country').val();
           var data=$('#submit_form').serialize();
           
           if(fullname == '' || address == '' || city== '' || state=='' || pin_code== '' || country== '' || phone=='')  
           {  
                alert('All Fields are required');  
           } 
           else
           {
           mphone = phone.replace(/[^0-9]/g, '');
           mpincode = pin_code.replace(/[^0-9]/g, '');
            if(mphone.length != 10) { 
               alert("Please enter 10 digit mobile no.");
               $("#shipping_phone").focus();
            }
            else
              if(mpincode.length != 6) { 
               alert("Please enter 6 digit pincode.");
               $("#shipping_pin_code").focus();
            }
            else
            {
              $.ajax({  
                     url:"{{ url('/saveuseraddress') }}",  
                     method:"GET",  
                     data:$('#submit_form').serialize(),  
                     success:function(data){  
                        if(data=='1')
                        {
                          $('form').trigger("reset");
                          $('#add-new-address').modal('hide');
                          alert('Address has been added successfully');
                          location.reload();
                          // message="Adress has been added successfully";
                          // toastr.options.timeOut = 5000; // 1.5s
                          // toastr.success(message);
                      }     
                     }  
                }); 
            } 
            }
        })
    });
</script>