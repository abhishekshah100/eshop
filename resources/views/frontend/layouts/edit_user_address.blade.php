    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header justify-content-center bg-dark">
                <h5 class="modal-title" id="add-new-addressCenterTitle"> <span class="ion-checkmark-round"></span>
                    Update Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="check-out-content">
                                        <form class="p-0" action="{{ route('update-user-address')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user_address->id }}">
                                            <div class="form-group row">
                                                <label class="col-md-3" for="firstName2">Full name</label>
                                                <div class="col-md-6">
                                                    <input value="{{ $user_address->user_name }}" class="form-control" name="fullname" type="text" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3" for="address1">Address</label>
                                                <div class="col-md-6">
                                                    <textarea  class="form-control" name="address" required="">{{ $user_address->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3" for="city">City</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" value="{{ $user_address->city }}" name="city" type="text" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3">State</label>
                                                <div class="col-md-6">
                                                    <select class="form-control" name="state" required="">
                                                        <option value="">-- please choose --</option>
                                                        <option value="Delhi" {{ $user_address->state=='Delhi'?'selected':'' }}>Delhi</option>
                                                        <option value="Noida" {{ $user_address->state=='Noida'?'selected':'' }}>Noida</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3" for="zip">Phone No</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" name="phone" type="text" required="" value="{{ $user_address->phone }}" pattern="[7-9]{1}[0-9]{9}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3" for="zip">Pin Code</label>
                                                <div class="col-md-6">
                                                    <input class="form-control"  value="{{ $user_address->pincode }}" name="pincode" type="text" required="" pattern="[0-9]{6}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3">Country</label>
                                                <div class="col-md-6">
                                                    <select class="form-control" name="country" required="">
                                                        <option value="india" selected>India</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn theme-btn--dark1 btn--md">Continue</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>