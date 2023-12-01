@extends('admin.app')

@section('content')
<!-- Content area -->
<div class="content">
    <!-- Page length options -->
    <div class="card">
        <div class="card-header header-elements-inline s-filter">
        	<div class="col-sm-6 mb-1" align="left">
			    <h6 class="card-title"><b>PROFILE SETTINGS</b></h6>
            </div>
        	<div class="col-sm-6 mb-1" align="right">
				<button type="button" class="btn btn-success btn-sm">
					<a href="{{ url('/admin') }}" class="text-white"> <i class="icon-circle-left2 mr-1"></i> Back</a>
				</button>
			</div>
        </div>
        <div class="card-body"> 
            <form class="PasswordDetails" action="{{url('/admin/profile/post')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="id" value="1">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{$profile->name ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" id="email" value="{{$profile->email ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div>
                                        <label>Logo</label><br>
                                        <input type="file" name="logo" class="form-control" id="logo">
                                    </div>
                                    <div class="mt-3">
                                        <img src="{{$profile->logo ?? ''}}" class="rounded" height="150px" width="300px" alt=" " />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                    <i class="icon-eye text-muted" id="Passwordtoggle"></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="cpassword" class="form-control" id="cpassword">
                                    <i class="icon-eye text-muted" id="Passwordtoggle2"></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="submit_form">UPDATE
                                    <i class="icon-paperplane ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /page length options -->
</div>
@endsection

@section('script')
<script src="{{asset('assets/admin/global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#Passwordtoggle').on('click',function(){
            if($('#password').attr("type")==="password"){
                $("#Passwordtoggle").attr('class','icon-eye-blocked text-muted');
                $('#password').attr("type","text");
            }else{
                $("#Passwordtoggle").attr('class','icon-eye text-muted');
                $('#password').attr("type","password");
            }
        });
        
        $('#Passwordtoggle2').on('click',function(){
            if($('#cpassword').attr("type")==="password"){
                $("#Passwordtoggle2").attr('class','icon-eye-blocked text-muted');
                $('#cpassword').attr("type","text");
            }else{
                $("#Passwordtoggle2").attr('class','icon-eye text-muted');
                $('#cpassword').attr("type","password");
            }
        });
        
        
        jQuery.validator.addMethod("fileType", function(value, element, types) {
            if (element.files && element.files.length) {
                var extension = element.files[0].name.split('.').pop().toLowerCase();
                return types.split('|').indexOf(extension) !== -1;
            }
            return true;
        }, "Please upload a file with a valid format (.jpg, .jpeg, .png).");
        
        jQuery.validator.addMethod("strongPassword", function(value, element) {
            return this.optional(element) || /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/.test(value);
        }, "The password must contain at least one uppercase letter, one digit, and one special character.");
        
        if ($(".PasswordDetails").length > 0) {
            $(".PasswordDetails").validate({
                rules: {
                    name: "required",
                    email: "required",
                    password : {
                        minlength: 6,
                        strongPassword: true
                    },
                    cpassword: {
                        equalTo: "#password"
                    },
                    logo: {
                        fileType: "jpg|jpeg|png|ico|bmp"
                    }
                },
                messages: {
                    name: "Name field is required.",
                    email: "Email field is required.",
                    password: {
                        minlength: "New Password length must be minimum 6 letters."
                    },
                    cpassword: {
                        equalTo: "The confirm password must same as new password."
                    },
                    seo_description: "SEO description field is required.",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    });
</script>
@endsection