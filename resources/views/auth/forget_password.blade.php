@extends('layout.index')
@section('content')
    <div class="section section-padding">
        <div class="container">
            <div class="row ">
                <div class="col-lg-2 col-md-1"></div>
                <div class="col-lg-8 col-md-10">
                    <div class="forgot">
                      	<h2>Forgot your password?</h2>
                        <p>Change your password in three easy steps. This will help you to secure your password!</p>
                        <ol class="list-unstyled">
                            <li><span class="text-medium">1. </span>Enter your email address below.</li>
                            <li><span class="text-medium">2. </span>Our system will send you a temporary link</li>
                            <li><span class="text-medium">3. </span>Use the link to reset your password</li>
                        </ol>
                    </div>	
                  
                    <form id="registerForm" class="card_forget mt-4" action="{{ url('send/otp') }}" method="post">
                        @csrf
                        <div class="row row-cols-1 g-4">
                            <div class="col">
                                <label for="email-for-pass">Enter your email address</label>
                                <input class="form-field" type="text" id="email-for-pass" name="email" >
                                <small class="form-text text-muted">
                                    Enter the email address you used during the registration on <b>{{url('/')}}</b>. Then we'll email a link to this address.
                                </small>
                            </div>
                            <br>
                            <div class="col">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input class="btn btn-dark btn-primary-hover rounded-0 w-100" type="submit" value="Get New Password">
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="{{ url('login') }}" class="btn btn-dark btn-primary-hover rounded-0 w-100">Back to Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 col-md-1"></div>
            </div>
        </div>
	</div>


@endsection

@section('script')
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('Forgot Password');
    });
</script>
@endsection