@php
    $i = 1;
@endphp

@extends('layout.index')
@section('content')
    <div class="my-account-wrapper section-space">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu">
									<ul class="nav nav-pills">
									<li class="active">
                                        <a data-toggle="pill" href="#dashboad" ><i class="fa fa-dashboard"></i>
                                            Dashboard</a> </li>
                                       <li> <a data-toggle="pill" href="#orders"><i class="fa fa-cart-arrow-down"></i>
                                            Orders</a></li>
											<!-- <li>
                                        <a data-toggle="pill" href="#download"><i class="fa fa-cloud-download"></i>
                                            Download</a></li> -->
											<!--<li>-->
           <!--                             <a data-toggle="pill" href="#payment-method"><i class="fa fa-credit-card"></i>-->
           <!--                                 Payment-->
           <!--                                 Method</a></li>-->
											<li>
                                        <a data-toggle="pill" href="#address-edit"><i class="fa fa-map-marker"></i>
                                            address</a></li>
											<li>
                                        <a data-toggle="pill" href="#account-info"><i class="fa fa-user"></i> Account
                                            Details</a></li>
											<li>
                                        <a href="{{ route('sign-out') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
										</ul>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade in active" id="dashboad" >
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="welcome">
                                                    <p>Hello, <b>{{$data->name ?? ''}}</b></p>
                                                </div>
                                                <p class="mb-0">From your account dashboard. you can easily check &amp;
                                                    view your recent orders, manage your shipping and billing addresses
                                                    and edit your password and account details.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders">
                                            <div class="myaccount-content">
                                                <h3>Orders</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Image</th>
                                                                <th>Name</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($orders as $order)
                                                            @php
                                                            $total = $order->quantity * $order->total;
                                                            @endphp
                                                            <tr>
                                                                <td>{{$i++}}</td>
                                                                <td><img src="{{$order->product_image}}" height="50px" width="50px" ></td>
                                                                <td>{{$order->product_name}}</td>
                                                                <td>${{$total}}</td>
                                                                <td><a href="{{url('order_deatil',$order->product_id)}}" class="btn btn__bg">View</a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start --
                                        <div class="tab-pane fade" id="download">
                                            <div class="myaccount-content">
                                                <h3>Downloads</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Date</th>
                                                                <th>Expire</th>
                                                                <th>Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Haven - Free Real Estate PSD Template</td>
                                                                <td>Aug 22, 2018</td>
                                                                <td>Yes</td>
                                                                <td><a href="#" class="btn btn__bg"><i class="fa fa-cloud-download"></i>
                                                                        Download File</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>HasTech - Profolio Business Template</td>
                                                                <td>Sep 12, 2018</td>
                                                                <td>Never</td>
                                                                <td><a href="#" class="btn btn__bg"><i class="fa fa-cloud-download"></i>
                                                                        Download File</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="payment-method">
                                            <div class="myaccount-content">
                                                <h3>Payment Method</h3>
                                                <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="address-edit">
                                            <div class="myaccount-content">
                                                <h3>Billing Address</h3>
                                                
                                                <address>
                                                    <!--<p><strong>{{$data->name ?? ''}}</strong></p>-->
                                                    
                                                    <div> Name &nbsp;: &nbsp;&nbsp;<b>{{$address->shipping_name ?? ''}}</b></div>
                                                    <div> Email &nbsp;: &nbsp;&nbsp;<b>{{$address->shipping_email ?? ''}}</b></div>
                                                    <div> Phone : &nbsp;&nbsp;<b>{{$address->phone ?? ''}}</b></div>
                                                    <br>
                                                    <p>{{$address->house_no ?? ''}} {{$address->landmark ?? ''}} {{$address->city ?? ''}}, {{$address->state ?? ''}}, <br>
                                                        {{$address->country ?? ''}} {{$address->pincode ?? ''}}</p>
                                                </address>
                                                <a href="" data-toggle="modal" data-target="#myaddress"><i class="fa fa-edit"></i> Edit Address</a>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="account-info">
                                            <div class="myaccount-content">
                                                <h3>Account Details</h3>
                                                <div class="account-details-form">
                                                    <form action="{{url('update_profile',$data->id)}}" id="accuontForm" method="post">
                                                        @csrf
                                                        <input type="hidden" name="profile" value="profile">
                                                        
                                                        <div class="single-input-item mt-3">
                                                            <label for="display-name" class="required">Name</label>
                                                            <input type="text" name="name" id="display-name" placeholder="Your Name" value="{{$data->name ?? ''}}">
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Email Addres</label>
                                                            <input type="email" name="email" id="email" placeholder="Email Address" value="{{$data->email ?? ''}}">
                                                        </div>
                                                        <fieldset>
                                                            <legend>Password change</legend>
                                                            <div class="single-input-item">
                                                                <label for="current-pwd" class="required">Current Password</label>
                                                                <div class="password">
                                                                    <input type="password" name="current_password" id="current-pwd" placeholder="Current Password">
                                                                    <i class="fas fa-eye" id="Password"></i>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">New Password</label>
                                                                        <div class="password">
                                                                            <input type="password" name="password" id="new-pwd" placeholder="New Password">
                                                                            <i class="fas fa-eye" id="togglePassword"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd" class="required">Confirm New Password</label>
                                                                        <div class="password">
                                                                            <input type="password" name="password_confirmation" id="confirm-pwd" placeholder="Confirm New Password">
                                                                            <i class="fas fa-eye" id="Passwordtoggle"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="single-input-item">
                                                            <input style="background: #dc8068;font-size: 16px;font-weight: 600;padding: 20px 40px;color: #fff;line-height: 1;" class="btn btn-dark btn-primary-hover rounded-0 w-100" type="submit" value="Save Changes">
                                                            <!--<button class="btn btn__bg">Save Changes</button>-->
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    
    
<div class="modal fade" id="myaddress" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="myaccount-content">
                    <div class="account-details-form">
                        <form id="address_form" action="{{ url('update_profile',$data->id) }}" method="POST" class="contact-form">
                            @csrf
                            <h3>Shipping Details</h3>
                            
                            <input type="hidden" name="myaddress" value="myaddress">
                            <input type="hidden" name="user_id" value="{{$data->id}}">
                            
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="single-input-item col-md-6">
                                        <label class="required">Name</label>
                                        <input type="text" name="shipping_name" id="shipping_name" placeholder="name" value="{{$address->shipping_name ?? ''}}" />
                                    </div>
                                    <div class="single-input-item col-md-6">
                                        <label class="required">Phone no.</label>
                                        <input type="text" name="phone" id="phone" placeholder="phone no." value="{{$address->phone ?? ''}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="single-input-item col-md-12">
                                        <label class="required">Email</label>
                                        <input type="text" name="shipping_email" id="shipping_email" placeholder="email" value="{{$address->shipping_email ?? ''}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="single-input-item col-md-6">
                                        <label class="required">House no.</label>
                                        <input type="text" name="house_no" id="house_no" placeholder="house no" value="{{$address->house_no ?? ''}}" />
                                    </div>
                                    <div class="single-input-item col-md-6">
                                        <label class="required">City</label>
                                        <input type="text" name="city" id="city" placeholder="city" value="{{$address->city ?? ''}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="single-input-item col-md-6">
                                        <label class="required">State</label>
                                        <input type="text" name="state" id="state" placeholder="state" value="{{$address->state ?? ''}}" />
                                    </div>
                                    <div class="single-input-item col-md-6">
                                        <label class="required">Country</label>
                                        <input type="text" name="country" id="country" placeholder="country" value="{{$address->country ?? ''}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="single-input-item col-md-6">
                                        <label class="required">Landmark</label>
                                        <input type="text" name="landmark" id="landmark" placeholder="landmark" value="{{$address->landmark ?? ''}}" />
                                    </div>
                                    <div class="single-input-item col-md-6">
                                        <label class="required">Pincode</label>
                                        <input type="text" name="pincode" id="pincode" placeholder="pincode" value="{{$address->pincode ?? ''}}" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-6 single-input-item">
                                        <input style="background: #dc8068;font-size: 16px;font-weight: 600;padding: 20px 40px;color: #fff;line-height: 1;" class="btn btn-dark btn-primary-hover rounded-0 w-100" type="submit" value="Save Changes">
                                    </div>
                                    <div class="col-md-6 single-input-item">
                                        <input style="background: #dc8068;font-size: 16px;font-weight: 600;padding: 20px 40px;color: #fff;line-height: 1;" data-dismiss="modal" class="btn btn-dark btn-primary-hover rounded-0 w-100" type="button" value="Close">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('My Account');
        
        $("#accuontForm").validate({
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
                    minlength: 6, 
                },
                password_confirmation: {
                    equalTo: "#new-pwd", 
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
                    minlength: "Password must be at least 6 characters",
                },
                password_confirmation: {
                    equalTo: "Passwords do not match",
                },
            },
            errorElement: "span",
            errorClass: "text-danger",
        });
    
    });
    
    /*------- Checkout Page accordion start -------*/
    $("#create_pwd").on("change", function () {
        $(".account-create").slideToggle("100");
    });

    $("#ship_to_different").on("change", function () {
        $(".ship-to-different").slideToggle("100");
    });

    // Payment Method Accordion
    $('input[name="paymentmethod"]').on('click', function () {
        var $value = $(this).attr('value');
        $('.payment-method-details').slideUp();
        $('[data-method="' + $value + '"]').slideDown();
	});
	/*------- Checkout Page accordion start -------*/
    
    $('#togglePassword').on('click',function(){
        if($('#new-pwd').attr("type")==="password"){
            $("#togglePassword").attr('class','fas fa-eye-slash');
            $('#new-pwd').attr("type","text");
        }else{
            $("#togglePassword").attr('class','fas fa-eye');
            $('#new-pwd').attr("type","password");
        }
    });
    
    
    $('#Passwordtoggle').on('click',function(){
        if($('#confirm-pwd').attr("type")==="password"){
            $("#Passwordtoggle").attr('class','fas fa-eye-slash');
            $('#confirm-pwd').attr("type","text");
        }else{
            $("#Passwordtoggle").attr('class','fas fa-eye');
            $('#confirm-pwd').attr("type","password");
        }
    });
    
    $('#Password').on('click',function(){
        if($('#current-pwd').attr("type")==="password"){
            $("#Password").attr('class','fas fa-eye-slash');
            $('#current-pwd').attr("type","text");
        }else{
            $("#Password").attr('class','fas fa-eye');
            $('#current-pwd').attr("type","password");
        }
    });

</script>
@endsection