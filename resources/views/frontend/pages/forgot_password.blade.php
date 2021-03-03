@extends('frontend.other_theme')
@section('content')
<!-- product tab start -->
<div class="my-account pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-md-3">
                <h3 class="title text-capitalize mb-30 pb-25">Please enter your email address to search for your account.</h3>
                <form class="log-in-form" action="{{ url('forgot-password') }}" method="POST">
                	@csrf
                    <div class="form-group row">
                        <label for="staticEmail" class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="staticEmail" name="email">
                        </div>
                    </div>
                    <div class="form-group row pb-3 text-center">
                        <div class="col-md-6 offset-md-3">
                            <div class="login-form-links">
                                <div class="sign-btn">
                                    <button class="btn theme-btn--dark1 btn--md" name="forgot_button">Search</button>
                                    <a href="{{ url()->previous() }}"><button class="btn theme-btn--dark1 btn--md" type="button">Cancel</button></a>
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