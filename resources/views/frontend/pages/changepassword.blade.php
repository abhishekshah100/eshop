@extends('frontend.other_theme')
@section('content')
<!-- product tab start -->
<div class="my-account pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-md-3">
                <h3 class="title text-capitalize mb-30 pb-25">Please enter new Password.</h3>
                <form class="log-in-form" action="{{ route('updatepassword')}}" method="POST">
                	@csrf
                    <div class="form-group row">
                        <label for="staticEmail" class="col-md-3 col-form-label">New Password</label>
                        <div class="col-md-6">
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="password" class="form-control" id="password" name="new_password">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text theme-btn--dark1 btn--md show-password" id="togglepassword">show</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-md-3 col-form-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="staticEmail" name="confirm_password" onpaste="return false;">
                        </div>
                    </div>
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="code" value="{{ $code }}">            
                    <div class="form-group row pb-3 text-center">
                        <div class="col-md-6 offset-md-3">
                            <div class="login-form-links">
                                <div class="sign-btn">
                                    <button class="btn theme-btn--dark1 btn--md" name="change_password_button">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- product tab end -->
@endsection
@push('bottom')
<script>
        $("#togglepassword").click(function(e){
            e.preventDefault();
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                $("#togglepassword").text('Hide');
            } 
            else 
            {
                x.type = "password";
                $("#togglepassword").text('Show');
            }
            });
</script>
@endpush