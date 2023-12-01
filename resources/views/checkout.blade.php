@extends('layout.index')
@section('content')

<body class="menu-page inner-page">
 <section class="checkout-page-wrapper section-space">
            <div class="container">
                <!--<div class="row">-->
                <!--    <div class="col-12">-->
                        <!-- Checkout Login Coupon Accordion Start -->
                <!--        <div class="checkoutaccordion" id="checkOutAccordion">-->
                <!--            <div class="card">-->
                <!--                <h3>Returning Customer? <span data-toggle="collapse" data-target="#logInaccordion">Click-->
                <!--                            Here To Login</span></h3>-->
                <!--                <div id="logInaccordion" class="collapse">-->
                <!--                    <div class="card-body">-->
                <!--                        <p>If you have shopped with us before, please enter your details in the boxes-->
                <!--                            below. If you are a new customer, please proceed to the Billing &amp;-->
                <!--                            Shipping section.</p>-->
                <!--                        <div class="login-reg-form-wrap mt-20">-->
                <!--                            <div class="row">-->
                <!--                                <div class="col-lg-12 m-auto">-->
                <!--                                    <form action="#" method="post">-->
                <!--                                        <div class="row">-->
                <!--                                            <div class="col-md-12">-->
                <!--                                                <div class="single-input-item">-->
                <!--                                                    <input type="email" placeholder="Enter your Email" required="">-->
                <!--                                                </div>-->
                <!--                                            </div>-->

                <!--                                            <div class="col-md-12">-->
                <!--                                                <div class="single-input-item">-->
                <!--                                                    <input type="password" placeholder="Enter your Password" required="">-->
                <!--                                                </div>-->
                <!--                                            </div>-->
                <!--                                        </div>-->

                <!--                                        <div class="single-input-item">-->
                <!--                                            <div class="login-reg-form-meta d-flex align-items-center justify-content-between">-->
                <!--                                                <div class="remember-meta">-->
                <!--                                                    <div class="custom-control custom-checkbox">-->
                <!--                                                        <input type="checkbox" class="custom-control-input" id="rememberMe" required="">-->
                <!--                                                        <label class="custom-control-label" for="rememberMe">Remember-->
                <!--                                                            Me</label>-->
                <!--                                                    </div>-->
                <!--                                                </div>-->

                <!--                                                <a href="#" class="forget-pwd">Forget Password?</a>-->
                <!--                                            </div>-->
                <!--                                        </div>-->

                <!--                                        <div class="single-input-item">-->
                <!--                                            <button class="btn btn__bg">Login</button>-->
                <!--                                        </div>-->
                <!--                                    </form>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->

                <!--            <div class="card">-->
                <!--                <h3>Have A Coupon? <span data-toggle="collapse" data-target="#couponaccordion">Click-->
                <!--                            Here To Enter Your Code</span></h3>-->
                <!--                <div id="couponaccordion" class="collapse">-->
                <!--                    <div class="card-body">-->
                <!--                        <div class="cart-update-option">-->
                <!--                            <div class="apply-coupon-wrapper">-->
                <!--                                <form action="#" method="post" class=" d-block d-md-flex">-->
                <!--                                    <input type="text" placeholder="Enter Your Coupon Code" required="">-->
                <!--                                    <button class="btn btn__bg">Apply Coupon</button>-->
                <!--                                </form>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                        <!-- Checkout Login Coupon Accordion End -->
                <!--    </div>-->
                <!--</div>-->
                <form class="checkout" action="{{url('stripe')}}" method="post">
                    @csrf
                <div class="row py-5">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h2>Billing Details</h2>
                            <div class="billing-form-wrap">
                                    <div class="single-input-item">
                                        <label for="email" class="required">Full Name</label>
                                        <input type="text" name="shipping_name" placeholder="Name" required value="{{$user_address->shipping_name ?? ''}}">
                                    </div>

                                    <div class="single-input-item">
                                        <label for="email" class="required">Email</label>
                                        <input type="email" name="shipping_email" id="shipping_email" placeholder="Email Address" required value="{{$user_address->shipping_email ?? ''}}">
                                    </div>

                                    <div class="single-input-item">
                                        <label for="com-name">Phone no.</label>
                                        <input type="text" name="phone" placeholder="Mobile Number" required value="{{$user_address->phone ?? ''}}">
                                    </div>

                                     <div class="single-input-item">
                                        <label for="country" class="required">Country</label>
                                        <input type="text" name="country" placeholder="Country" required value="{{$user_address->country ?? ''}}">
                                    </div>

                                    <div class="single-input-item">
                                        <label for="street-address" class="required mt-20">House no.</label>
                                        <input type="text" name="house_no" placeholder="House no." required  value="{{$user_address->house_no ?? ''}}">
                                    </div>
                                    
                                    <div class="single-input-item">
                                        <label for="street-address" class="required mt-20">Landmark</label>
                                        <input type="text" name="landmark" placeholder="Street address Line 1" required  value="{{$user_address->landmark ?? ''}}">
                                    </div>

                                    <div class="single-input-item">
                                        <label for="town" class="required">Town / City</label>
                                        <input type="text" name="city" placeholder="Town / City" required  value="{{$user_address->city ?? ''}}">
                                    </div>

                                    <div class="single-input-item">
                                        <label for="state">State / Divition</label>
                                        <input type="text" name="state" placeholder="State / Divition" value="{{$user_address->state ?? ''}}">
                                    </div>

                                    <div class="single-input-item">
                                        <label for="postcode" class="required">Postcode / ZIP</label>
                                        <input type="text" name="pincode" placeholder="Postcode / ZIP" required  value="{{$user_address->pincode ?? ''}}">
                                    </div>

                                    <!--<div class="checkout-box-wrap">-->
                                    <!--    <div class="single-input-item">-->
                                    <!--        <div class="custom-control custom-checkbox">-->
                                    <!--            <input type="checkbox" class="custom-control-input" id="create_pwd">-->
                                    <!--            <label class="custom-control-label" for="create_pwd">Create an-->
                                    <!--                account?</label>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="account-create single-form-row">-->
                                    <!--        <p>Create an account by entering the information below. If you are a-->
                                    <!--            returning customer please login at the top of the page.</p>-->
                                    <!--        <div class="single-input-item">-->
                                    <!--            <label for="pwd" class="required">Account Password</label>-->
                                    <!--            <input type="password" id="pwd" placeholder="Account Password" required="">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!--<div class="checkout-box-wrap">-->
                                    <!--    <div class="single-input-item">-->
                                    <!--        <div class="custom-control custom-checkbox">-->
                                    <!--            <input type="checkbox" class="custom-control-input" id="ship_to_different">-->
                                    <!--            <label class="custom-control-label" for="ship_to_different">Ship to a-->
                                    <!--                different address?</label>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="ship-to-different single-form-row">-->
                                    <!--        <div class="row">-->
                                    <!--            <div class="col-md-6">-->
                                    <!--                <div class="single-input-item">-->
                                    <!--                    <label for="f_name_2" class="required">First Name</label>-->
                                    <!--                    <input type="text" id="f_name_2" placeholder="First Name" required="">-->
                                    <!--                </div>-->
                                    <!--            </div>-->

                                    <!--            <div class="col-md-6">-->
                                    <!--                <div class="single-input-item">-->
                                    <!--                    <label for="l_name_2" class="required">Last Name</label>-->
                                    <!--                    <input type="text" id="l_name_2" placeholder="Last Name" required="">-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--        </div>-->

                                    <!--        <div class="single-input-item">-->
                                    <!--            <label for="email_2" class="required">Email Address</label>-->
                                    <!--            <input type="email" id="email_2" placeholder="Email Address" required="">-->
                                    <!--        </div>-->

                                    <!--        <div class="single-input-item">-->
                                    <!--            <label for="com-name_2">Company Name</label>-->
                                    <!--            <input type="text" id="com-name_2" placeholder="Company Name">-->
                                    <!--        </div>-->

                                    <!--         <div class="single-input-item">-->
                                    <!--            <label for="country_2" class="required">Country</label>-->
                                    <!--            <select name="country" id="country_2">-->
                                    <!--                <option value="Bangladesh">Bangladesh</option>-->
                                    <!--                <option value="India">India</option>-->
                                    <!--                <option value="Pakistan">Pakistan</option>-->
                                    <!--                <option value="England">England</option>-->
                                    <!--                <option value="London">London</option>-->
                                    <!--                <option value="London">London</option>-->
                                    <!--                <option value="Chaina">Chaina</option>-->
                                    <!--            </select>-->
                                    <!--        </div>-->

                                    <!--        <div class="single-input-item">-->
                                    <!--            <label for="street-address_2" class="required mt-20">Street address</label>-->
                                    <!--            <input type="text" id="street-address_2" placeholder="Street address Line 1" required="">-->
                                    <!--        </div>-->

                                    <!--        <div class="single-input-item">-->
                                    <!--            <input type="text" placeholder="Street address Line 2 (Optional)">-->
                                    <!--        </div>-->

                                    <!--        <div class="single-input-item">-->
                                    <!--            <label for="town_2" class="required">Town / City</label>-->
                                    <!--            <input type="text" id="town_2" placeholder="Town / City" required="">-->
                                    <!--        </div>-->

                                    <!--        <div class="single-input-item">-->
                                    <!--            <label for="state_2">State / Divition</label>-->
                                    <!--            <input type="text" id="state_2" placeholder="State / Divition">-->
                                    <!--        </div>-->

                                    <!--        <div class="single-input-item">-->
                                    <!--            <label for="postcode_2" class="required">Postcode / ZIP</label>-->
                                    <!--            <input type="text" id="postcode_2" placeholder="Postcode / ZIP" required="">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!--<div class="single-input-item">-->
                                    <!--    <label for="ordernote">Order Note</label>-->
                                    <!--    <textarea name="ordernote" id="ordernote" cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery." spellcheck="false"></textarea>-->
                                    <!--</div>-->
                               
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h2>Your Order Summary</h2>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Products</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($check_out as $data)
                                                <input type="hidden" name="product_id[]" value="{{ $data->product_id }}">
                                                <input type="hidden" name="size_id[]" value="{{ $data->size_id }}">
                                                <input type="hidden" name="quantity[]" value="{{ $data->quantity }}">
                                                <input type="hidden" name="total[]" value="{{ $data->single_total }}">
                                            <tr>
                                                <td><a href="product-details.html">{{$data->product_name}}<strong> X {{$data->quantity}}</strong></a>
                                                </td>
                                                <td>${{$data->single_total}}.00</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td><strong>${{$grand_total}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td class="d-flex justify-content-center">
                                                    <ul class="shipping-type">
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="flatrate" name="shipping" class="custom-control-input" checked="">
                                                                <label class="custom-control-label" for="flatrate">Flat
                                                                    Rate: $0.00</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="freeshipping" name="shipping" class="custom-control-input">
                                                                <label class="custom-control-label" for="freeshipping">Free
                                                                    Shipping</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Amount</td>
                                                <td><strong>${{$grand_total}}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <h5>Payment Method</h5>
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="checkpayment" name="paymentmethod" value="stripe" class="custom-control-input">
                                                <label class="custom-control-label" for="checkpayment">Stripe</label>
                                            </div>
                                            <span class="validation-message" style="color: red;"></span>
                                        </div>
                                        <div class="payment-method-details" data-method="check">
                                            <p>Please send a check to Store Name, Store Street, Store Town, Store State
                                                / County, Store Postcode.</p>
                                        </div>
                                        
                                    </div>
                                    <!--<div class="single-payment-method">-->
                                    <!--    <div class="payment-method-name">-->
                                    <!--        <div class="custom-control custom-radio">-->
                                    <!--            <input type="radio" id="paypalpayment" name="paymentmethod" value="paypal" class="custom-control-input">-->
                                    <!--            <label class="custom-control-label" for="paypalpayment">Paypal <img src="images/paypal-card.webp" class="img-fluid paypal-card" alt="Paypal"></label>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="payment-method-details" data-method="paypal">-->
                                    <!--        <p>Pay via PayPal; you can pay with your credit card if you don’t have a-->
                                    <!--            PayPal account.</p>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required="">
                                            <label class="custom-control-label" for="terms">I have read and agree to
                                                the website <a href="{{url('termandconditions')}}">terms and conditions.</a></label>
                                                <span class="validat-message" style="color: red;"></span>
                                        </div>
                                        <button type="submit" id="submitBtn" class="btn btn__bg">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 </form>
            </div>
        </section>
</body>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('CheckOut');
    });
    
    document.getElementById('submitBtn').addEventListener('click', function() {
        var paymentMethod = document.querySelector('input[name="paymentmethod"]:checked');
        var validationMessage = document.querySelector('.validation-message');
        var validatMessage = document.querySelector('.validat-message');

        if (!paymentMethod) {
            validationMessage.textContent = 'Please select a payment method.';
            validatMessage.textContent = 'Please accept the Terms&Conditions.';
        } 
    });
</script>
@endsection
