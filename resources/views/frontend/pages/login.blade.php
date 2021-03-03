@extends('frontend.other_theme')
@section('content')
<!-- product tab start -->
<div class="my-account pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-md-3">
                <h3 class="title text-capitalize mb-30 pb-25"> Log in to your account</h3>
                <div class="form-group row pb-3 text-center">
                        <div class="col-md-6 offset-md-3">
                            <div class="login-form-links">
                                <div class="sign-btn">
                                    <a href="{{ route('login.google') }}"><button class="btn btn--md" type="button" style="border: 1px solid #000;"><img src="{{ asset('images/logo/google.png')}}" width="25" height="25" class="mr-2">Login With Google</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <form class="log-in-form" action="{{ route('login-user') }}" method="POST">
                	@csrf
                    <div class="form-group row">
                        <label for="staticEmail" class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="staticEmail" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-6">
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="input-group-prepend">
                                    <button id="togglepassword" type="button"
                                        class="input-group-text  theme-btn--dark1 btn--md show-password">show</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row pb-3 text-center">
                        <div class="col-md-6 offset-md-3">
                            <div class="login-form-links">
                                <a href="{{ route('forgot-password') }}" class="for-get">Forgot your password?</a>
                                <div class="sign-btn">
                                    <button class="btn theme-btn--dark1 btn--md" name="login_now">Sign in</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row text-center mb-0">
                        <div class="col-12">
                            <div class="border-top">
                                <a href="/register" class="no-account">No account? Create one here</a>
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