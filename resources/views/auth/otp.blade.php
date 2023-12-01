@extends('layout.index')
@section('content')

    <div class="section section-padding">
        <div class="container">
            <div class="login-register-form">
                <h3 class="title">Otp Verification</h3>
                
                <h4>Verify Otp</h4>
                
                <form action="{{ route('submit-otp') }}" method="post" id="registerForm">
                    @csrf
                    
                    <div class="row row-cols-1 g-4">
                        <div class="col">
                            <input class="form-field" type="text" placeholder="Enter 4 digit code"  name="code" />
                                @if ($errors->has('code'))
                                    <span class="text-danger">{{ $errors->first('code') }}</span>
                                    @endif
                            <input type="hidden" name="id" value="{{ $id }}"/>
                        </div>
                        
                        <div class="single-input-item">
                            <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                <div class="remember-meta">
                                </div>
                                <a href="{{ route('resend.otp', ['id' => $id])}}" class="forget-pwd">Resend Otp</a>
                            </div>
                        </div>
                        <div class="single-input-item col">
                            <input class="btn btn-dark btn-primary-hover rounded-0 w-100" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('Otp Verification');
    });
</script>
@endsection