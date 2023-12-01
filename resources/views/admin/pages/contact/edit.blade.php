@extends('admin.app')

@section('content')
<!-- Content area -->
<div class="content">
    <!-- Page length options -->
    <div class="card">
        <div class="card-header header-elements-inline s-filter">
        	<div class="col-sm-6 mb-1" align="left">
			    <h6 class="card-title"><b>CONTACT US DETAILS</b></h6>
            </div>
        	<div class="col-sm-6 mb-1" align="right">
				<button type="button" class="btn btn-success btn-sm">
					<a href="{{ url('/admin') }}" class="text-white"> <i class="icon-circle-left2 mr-1"></i> Back</a>
				</button>
			</div>
        </div>
        <div class="card-body"> 
            <form class="ContactDetails" action="{{url('/admin/contact_us/post')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="1">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <!--<div class="col-md-12">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>Title</label>-->
                            <!--        <input type="text" name="title" class="form-control" id="title" >-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" id="address" value="{{$contact->address}}" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group"> 
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" class="form-control" id="latitude" value="{{$contact->latitude ?? ''}}" >
                                    <label>longitude</label>
                                    <input type="text" name="longitude" class="form-control" id="longitude" value="{{$contact->longitude ?? ''}}" >
                                </div>
                            </div>
                            <!--<div class="col-md-12">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>Map</label>-->
                            <!--        <textarea name="map" class="form-control" id="map" rows="7"></textarea>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                        
                        <div class="row">
                            <h4>SEO SECTION</h4>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" name="title" class="form-control" id="title"  >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>SEO Keyword</label>
                                    <input type="text" name="keyword" class="form-control" id="keyword" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <input type="text" name="description" class="form-control" id="description" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <!--<div class="col-md-12">-->
                            <!--    <img src="" class="rounded" height="150px" width="300px" alt=" " />-->
                            <!--    <div class="form-group">-->
                            <!--        <div>-->
                            <!--            <label>Background Image</label>-->
                            <!--            <input type="file" name="background_image" class="form-control" id="background_image">-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{$contact->email}}" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone No.</label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{$contact->phone}}" >
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
<script src="{{asset('public/assets/admin/global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>

<script type="text/javascript">
    
    
    $(document).ready(function(){
        // jQuery.validator.addMethod("fileType", function(value, element, types) {
        //     if (element.files && element.files.length) {
        //         var extension = element.files[0].name.split('.').pop().toLowerCase();
        //         return types.split('|').indexOf(extension) !== -1;
        //     }
        //     return true;
        // }, "Please upload file with a valid format (.jpg, .jpeg, .png).");
        
        if ($(".ContactDetails").length > 0) {
            $(".ContactDetails").validate({
                rules: {
                    // title : "required",
                    address : "required",
                    latitude: "required",
                    longitude: "required",
                    email : "required",
                    phone : "required",
                    // map : "required",
                    seo_title : "required",
                    seo_keyword : "required",
                    seo_description : "required",
                    // image : {
                    //     fileType: "jpg|jpeg|png|ico|bmp"
                    // },
                    // background_image : {
                    //     fileType: "jpg|jpeg|png|ico|bmp"
                    // }
                },
                messages: {
                    // title : "Title field is required.",
                    address : "Address field is required.",
                    latitude : "Latitude field is required.",
                    longitude : "Longitude field is required.",
                    email : "Email field is required.",
                    phone : "Phone no. field is required.",
                    // map : "Map field is required.",
                    seo_title : "Seo title field is required.",
                    seo_keyword : "Seo keyword field is required.",
                    seo_description : "Seo description field is required.",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    });
</script>
@endsection