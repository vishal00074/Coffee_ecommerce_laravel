@extends('layout.index')
@section('content')

    <div class="section section-padding">
    <div class="container">
        <div class="login-register-form">
            <h3 class="title">Create Account</h3>
            <p>Please Register using account details below.</p>
            <form id="registerForm" method="post" action="{{url('auth/register')}}">
                @csrf
                <div class="row row-cols-1 g-4">
                    <div class="col">
                        <input class="form-field" type="text"  name="name"  id="name" placeholder="Full Name" />
                    </div>
                    <div class="col">
                        <input class="form-field" type="email"  name="email"  id="email" placeholder="Enter your Email"  />
                    </div>
                    <div class="col">
                        <div class="row ">
                            <div class="password col-lg-6 ">
                                <input class="form-field" type="password"   name="password"  id="password"  placeholder="Enter your Password"  />
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </div>
                            <div class="password col-lg-6 ">
                                <input class="form-field" type="password"  name="password_confirmation"  id="password_confirmation"  placeholder="Confirm your Password"  />
                                <i class="fas fa-eye" id="Passwordtoggle"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col"><input class="btn btn-dark btn-primary-hover rounded-0 w-100" type="submit" value="Sign Up"></div>
                    <div class="col text-center">Already have an account? <a href="{{url('login')}}"><b>Login</b></a></div>                
                </div>
            </form>
        </div>
    </div>
</div>
  
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('Register');
        
        $('#togglePassword').on('click',function(){
            if($('#password').attr("type")==="password"){
                $("#togglePassword").attr('class','fas fa-eye-slash');
                $('#password').attr("type","text");
            }else{
                $("#togglePassword").attr('class','fas fa-eye');
                $('#password').attr("type","password");
            }
        });
        
        
        $('#Passwordtoggle').on('click',function(){
            if($('#password_confirmation').attr("type")==="password"){
                $("#Passwordtoggle").attr('class','fas fa-eye-slash');
                $('#password_confirmation').attr("type","text");
            }else{
                $("#Passwordtoggle").attr('class','fas fa-eye');
                $('#password_confirmation').attr("type","password");
            }
        });
        
        
        
        $("#registerForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3, 
                },
                email: {
                    required: true,
                    email: true, 
                },
                password: {
                    required: true,
                    minlength: 6, 
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password", 
                },
            },
            messages: {
                name: {
                    required: "Please enter your full name",
                    minlength: "Full name must be at least 3 characters",
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address",
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Password must be at least 6 characters",
                },
                password_confirmation: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match",
                },
            },
            errorElement: "span",
            errorClass: "text-danger",
        });
    });
</script>

@endsection