<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    	<title>Coffee - Admin</title>
	    <link rel="icon" href="{{asset('public/assets/admin/img/favicon.png')}}" sizes="32x32" />
	    
        <style>
            .alert-danger {
                color: #f8d7da;
                background-color: #721c24;
                border-color: #f5c6cb;
            }
            
            .alert-success {
                color: #d4edda;
                background-color: #155724;
                border-color: #c3e6cb;
            }
        
            .adminlogin .fas {
                position: absolute;
                top: 15px;
                right: 20px;
                color: #9b8a8a;
            }
    		body#ad_login {
    		    background-image:url("https://coffee.sbwares.com/public/assets/admin/img/login.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                background-position:top center;
            }
            body#ad_login > .container {
                height: 100vh;
                /* display: flex;
                align-items: center;
                justify-content: center; */
                /* justify-content: space-between; */
            } 
     
            .right-side .p-5{
                padding: 8rem 4rem!important;
            } 
            .main-box {
                display: flex;
                justify-content: center;
                gap: 10px;
                align-items: center;
            } 
            body#ad_login > .container form {
                margin: 0 auto;
                max-width: 460px;
                width: 100%;
                max-height: 100%;
                background: #ecd9c6 !important;
                border: 1px solid #ddd;
                padding: 30px;
                border-radius: 25px;
                box-shadow: 0px 0px 25px #ebe4e4;
            }
            body#ad_login .row {
                height: 100vh;
            }
            .text-center img{
                background: white;
                padding: 20px 20px;
                border-radius: 25px;
                width: 70%;
                object-fit: contain;
            }
            img{
                width:100%;
            }
            body#ad_login input.form-control {
                height: 45px;
                border-radius: 4px !important;
            }
            .form-control {
                border-radius: 0px !important;
                border: 1px solid #cbd0d5 !important;
            }
            body#ad_login > .container form .form-group {
                margin-bottom: 10px;
                position: relative;
            }
            body#ad_login > .container form input.btn.btn-success:hover {
                background: #000;
                border-color: #000;
                transition: 0.5s;
            }
            body#ad_login > .container form input.btn.btn-success {
                width: 100%;
                background: #91643c;
                border-radius: 4px;
                font-weight: 600;
                font-size: 16px;
                text-transform: uppercase;
                height: 48px;
                border:none;
                transition: 0.5s;
            }

            .three-box {
                padding: 80px 0;
            }
            /* body#ad_login > .container form:hover {
                border-color: #18e65fe0;
                box-shadow: 0px 3px 14px #767b7e;
            	transition: 0.5s;
            } */
            .adminlogin .error{
                color : red;
            }
        </style>
    </head>
    <body id="ad_login">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="right-side col-sm-12 align-self-center">
                    <form  class="bg-info  adminlogin mt-4" method="POST" action="{{route('adminLoginPost')}}">
                        <h1 class="mb-4 text-center">
                            <img src="{{asset('public/assets/frontend/images/logo.png')}}" height="220px" width="200px" alt="">
                        </h1>
                        @csrf
                        
                        @if(\Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ \Session::get('success') }}
                            </div>
                            <!--<button type="button" class="btn-close mb-2" data-bs-dismiss="alert" aria-label="Close"></button>-->
                        </div>
                        @endif
                        {{ \Session::forget('success') }}
                        @if(\Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ \Session::get('error') }}
                            </div>
                            <!--<button type="button" class="btn-close mb-2" data-bs-dismiss="alert" aria-label="Close"></button>-->
                        </div>
                        @endif
                        <div class="mb-3">
                        <div class="form-group">
                            <!-- <label>Email</label> -->
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                         </div></div><div class="mb-3">
                        <div class="form-group">
                            <!-- <label>Password</label> -->
                            <input type="password" name="password" class="form-control" id="id_password" placeholder="Enter Password">
                            <i class="fas fa-eye" id="togglePassword"></i>
                        </div></div>
                        <div class="form-group" ;align="center">
                          <input type="submit" class="btn btn-success btn-lg" value="LOGIN">
                        </div>
                    
                    </form>
                </div>
                
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://abacus.mytura.in/assets/admin/global_assets/js/plugins/forms/validation/validate.min.js"></script>
        
        <script>
            $(document).ready(function() {
                if($(".adminlogin").length > 0){
                    $(".adminlogin").validate({
                        rules: {
                            email: 'required',
                            password: 'required'
                        },
                        messages: {
                            email: "Email field is required.",
                            password: "Password field is required."
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                }
                
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
    </body>
</html>
