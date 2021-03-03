@extends('frontend.other_theme')
@section('content')
<x-breadcrumb heading="Register" />
<!-- product tab start -->
<div class="register pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-md-3">
                <h3 class="title text-capitalize mb-30 pb-25">Create an account</h3>
                <div class="log-in-form">
                    <form action="/register-now" class="personal-information" method="POST">
                        @csrf
                        <div class="order-asguest theme1 mb-3">
                            <span>Already have an account?</span>
                            <a class="text-muted hover-color" href="{{ route('login') }}">Log in instead!</a>
                        </div>
                        <div class="form-group row">
                            <label for="firstname" class="col-md-3 col-form-label">First
                                name</label>
                            <div class="col-md-6">
                                <input type="text" id="first_name" class="form-control" name="first_name" value="{{ old('first_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-md-3 col-form-label">last name</label>
                            <div class="col-md-6">
                                <input type="text" id="last_name" class="form-control" name="last_name" value="{{ old('last_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label">Email</label>
                            <div class="col-md-6">
                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Password" class="col-md-3 col-form-label">Password</label>
                            <div class="col-md-6">
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="input-group-prepend">
                                        <button type="button"
                                            class="input-group-text theme-btn--dark1 btn--md show-password" id="togglepassword">show</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Password" class="col-md-3 col-form-label">Confirm Password</label>
                            <div class="col-md-6">
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="password" class="form-control" name="password_confirmation" onpaste="return false;">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthdate" class="col-md-3 col-form-label">Birthdate</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" id="birth_date" placeholder="MM/DD/YYYY" name="birthdate" value="{{ old('birthdate') }}">
                            </div>
                            <div class="col-md-3"><label><span class="optional">
                                        Optional
                                    </span></label></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="check-box-inner pt-0">
                                    <div class="filter-check-box">
                                        <input type="checkbox" id="20821" checked name="newsletter">
                                        <label for="20821">Sign up for our newsletter</label>
                                        <p class="pl-25">You may unsubscribe at any moment. For that purpose, please
                                            find our contact info in the legal notice.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="sign-btn text-right">
                                    <button class="btn theme-btn--dark1 btn--md" name="register_now">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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