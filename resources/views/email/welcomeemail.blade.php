<!DOCTYPE html>

<html>

<head>

    <title>OTP Verification</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {

            font-family: Arial, sans-serif;

            font-size: 16px;

            line-height: 1.5;

            color: #444444;

            background-color: #f6f6f6;

            padding: 20px;

            margin: 0;

        }

        .container {

            max-width: 600px;

            margin: 0 auto;

            background-color: #ffffff;

            padding: 20px;

            border-radius: 10px;

            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

        }

        .logo {

            display: block;

            margin: 0 auto;

            width: 150px;

            height: auto;

            padding-bottom: 20px;

        }

        h1 {

            font-size: 24px;

            font-weight: bold;

            color: #333333;

            margin: 0 0 20px;

        }

        p {

            margin: 0 0 10px;

        }

        .code {

            font-size: 32px;

            font-weight: bold;

            color: #333333;

            margin: 20px 50px 30px 50px;

            text-align: center;

        }

        .cta {

            display: block;

            background-color: #0088cc;

            color: #ffffff;

            font-size: 18px;

            font-weight: bold;

            text-align: center;

            text-decoration: none;

            padding: 10px 20px;

            border-radius: 5px;

            margin: 0 auto;

            max-width: 300px;

        }

        .cta:hover {

            background-color: #006699;

        }
    </style>

</head>



<body>

    <div class="container">

        <img src="{{ asset('public/assets/frontend/images/logo.png') }}" alt="Logo" class="logo">
        
        <h1>{{ $data['title'] }}</h1>

        <p>Dear {{ $data['name'] }},</p>

        <p>Your OTP for verification is:</p>

        <div class="code">

            {{ $data['otp'] }}

        </div>

        <p>Please enter this code to verify your account.</p>

        <p>If you did not request this OTP, please ignore this message.</p>

        <!-- <a href="#" class="cta">Verify Now</a> -->

        <p>Best regards,</p>

        <p>The Coffee Team</p>

    </div>

</body>

</html>