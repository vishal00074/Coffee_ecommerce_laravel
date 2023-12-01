<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coffee - Forget Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <style>
        .mainDiv {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
            font-family: 'Open Sans', sans-serif;
            min-height: 100vh;
        }
        .password i {
            position: absolute;
            right: 20px;
            top: 12px;
            opacity: 0.7;
        }
        
        .password{
            position: relative;
        }
        .cardStyle {
            width: 500px;
            border-color: white;
            background: #fff;
            padding: 36px 0;
            border-radius: 4px;
            margin: 30px 0;
            box-shadow: 0px 0 2px 0 rgba(0, 0, 0, 0.25);
        }
        
        .formTitle {
            font-weight: 600;
            margin-top: 20px;
            color: #2F2D3B;
            text-align: center;
        }


        .inputLabel {
            font-size: 14px;
            color: #555;
            margin-bottom: 9px;
            margin-top: 24px;
            display: block;
        }
        
        .inputDiv {
            width: 90%;
            display: block;
            margin: auto;
            max-width:350px;
            flex-wrap: wrap;
            margin-top: 25px;
        }
        
                .cardStyle input {
            height: 40px;
            font-size: 16px;
            border-radius: 4px;
            border: solid 1px #ccc;
            padding: 0 11px;
            outline: none;
            width: 100%;
            display: block;
            box-sizing: border-box;
        }

        .cardStyle input:disabled {
            cursor: not-allowed;
            border: solid 1px #eee;
        }

        .buttonWrapper {
            margin-top:30px;
        }

        .submitButton {
            width: 70%;
            height: 45px;
            margin: auto;
            display: block;
            color: #fff;
            background-color: #07757e;
            text-shadow: 0 -1px 0 rgb(0 0 0 / 12%);
            box-shadow: 0 2px 0 rgb(0 0 0 / 4%);
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }

        .submitButton:disabled,

        button[disabled] {
            border: 1px solid #cccccc;
            background-color: #cccccc;
            color: #666666;
        }

        #loader {
            position: absolute;
            z-index: 1;
            margin: -2px 0 0 10px;
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #666666;
            width: 14px;
            height: 14px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    
</head>
<body>
    <div class="mainDiv">
        <div class="cardStyle">
            <form id="accountForm" action="{{ url('/forget-password') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$customer->id}}">
                <div style="text-align: center;">
                    <img src="{{ asset('public/assets/frontend/images/logo.png') }}" height="120px" alt="Logo" class="logo">
                </div>
                <h2 class="formTitle">Forgot Password</h2>
                <div class="inputDiv">
                    <label class="inputLabel" for="password">New Password</label>
                    <div class="password">
                        <input type="password" id="password" name="password">
                        <i class="fas fa-eye" id="Passwordtoggle"></i>
                    </div>
                </div>
                
                <div class="inputDiv">
                    <label class="inputLabel" for="confirmPassword">Confirm New Password</label>
                    <div class="password">
                        <input type="password" id="confirmPassword" name="confirm_password">
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </div>
                </div>
                <div class="buttonWrapper">
                    <button type="submit" id="submitButton" class="submitButton pure-button pure-button-primary">
                        <span>Continue</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            $('#accountForm').validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    confirm_password: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    }
                },
                highlight: function(element) {
                    $(element).parent().addClass('error');
                },
                unhighlight: function(element) {
                    $(element).parent().removeClass('error');
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.parent());
                }
            });

            $('#togglePassword').on('click',function(){
                if($('#confirmPassword').attr("type")==="password"){
                    $("#togglePassword").attr('class','fas fa-eye-slash');
                    $('#confirmPassword').attr("type","text");
                }else{
                    $("#togglePassword").attr('class','fas fa-eye');
                    $('#confirmPassword').attr("type","password");
                }
            });
            
            $('#Passwordtoggle').on('click',function(){
                if($('#password').attr("type")==="password"){
                    $("#Passwordtoggle").attr('class','fas fa-eye-slash');
                    $('#password').attr("type","text");
                }else{
                    $("#Passwordtoggle").attr('class','fas fa-eye');
                    $('#password').attr("type","password");
                }
            });
        });
    </script>
    </script>
</body
</html>