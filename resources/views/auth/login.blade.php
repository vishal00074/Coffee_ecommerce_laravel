@extends('layout.index')

@section('content')

    <div class="section section-padding">
        <div class="container">
            <div class="login-register-form">
                <h3 class="title">Login</h3>
                <p>Please Login using account detail below.</p>
                <form id="loginForm" method="post" action="{{route('logged-in')}}">
                    @csrf
                    <div class="row row-cols-1 g-4">
                        <div class="col">
                            <input class="form-field" type="email" name="email" placeholder="Email">
                        </div>
                        <div class="password col">
                            <input class="form-field" type="password" id="id_password" name="password" placeholder="Password">
                            <i class="fas fa-eye" id="togglePassword"></i>
                        </div>
                        <div class="col">
                            <input class="btn btn-dark btn-primary-hover rounded-0 w-100" type="submit" value="Sign In">
                        </div>
                        
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    Don't have an account? <a href="{{url('register')}}"><b>Create One</b></a>
                                </div>
                                <div class="col-md-6" align="right">
                                    <a href="{{url('forget_password')}}" class="forget-pwd">Forget Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('Login');
        
        $('#togglePassword').on('click',function(){
            if($('#id_password').attr("type")==="password"){
                $("#togglePassword").attr('class','fas fa-eye-slash');
                $('#id_password').attr("type","text");
            }else{
                $("#togglePassword").attr('class','fas fa-eye');
                $('#id_password').attr("type","password");
            }
        });
    });
</script>
@endsection