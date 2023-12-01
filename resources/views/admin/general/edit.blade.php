@extends('admin.app')

@section('content')
<!-- Content area -->
<div class="content">
    <!-- Page length options -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <div class="col-sm-6 mb-1" align="left">
                <h6 class="card-title">Website Settings</h6>
            </div>
            <div class="col-sm-6 mb-1" align="right">
                <a href="{{ url('/admin') }}" class="btn-success">
                    <i class="icon-circle-left2 mr-1"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body" id="footer">
            <form class="FooterDetails" name="LevelDetails" action="{{ url('admin/footer/post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="1">
                <div class="row">
                    <h4>FOOTER</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" id="title" value="{{$footer->title ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-2">
                                    <img src="{{asset($footer->image ?? '')}}" class="rounded" height="100px" width="200px" alt="" />
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Copyright</label>
                                    <input type="text" name="copyright" class="form-control" id="copyright" value="{{$footer->copyright ?? ''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary" id="submit_form">UPDATE <i class="icon-paperplane ml-2"></i></button>
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
<script type="text/javascript" src="{{asset('assets/admin/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
<script src="{{asset('assets/admin/global_assets/js/demo_pages/form_multiselect.js')}}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>


<script type="text/javascript">

    ClassicEditor.create(document.querySelector('#description')).catch(error => {
        console.error(error);
    });

    $(document).ready(function(){
        if ($(".GeneralDetails").length > 0) {
            $(".GeneralDetails").validate({
                rules: {
                    facebook: "required",
                    twitter:"required",
                    pinterest: "required",
                    linkedIn: "required",
                },
                messages: {
                    facebook: "Facebook field is required.",                   
                    twitter: "Twitter field is required.",
                    pinterest: "Pinterest field is required.",
                    linkedIn: "LinkedIn field is required."
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    });
    
    $(document).ready(function(){
        jQuery.validator.addMethod("fileType", function(value, element, types) {
            if (element.files && element.files.length) {
                var extension = element.files[0].name.split('.').pop().toLowerCase();
                return types.split('|').indexOf(extension) !== -1;
            }
            return true;
        }, "Please upload file with a valid format (.jpg, .jpeg, .png).");
        
        if ($(".FooterDetails").length > 0) {
            $(".FooterDetails").validate({
                rules: {
                    logo: {
                        fileType: "jpg|jpeg|png|ico|bmp"
                        },
                    description:"required",
                    title: "required",
                    address: "required",
                    email: "required",
                    phone: "required",
                    copyright: "required"
                },
                messages: {
                    description: "Description field is required.",                   
                    title: "Title field is required.",
                    address: "Address field is required.",
                    email: "Email field is required.",
                    phone: "Phone field is required.",
                    copyright: "Copyright field is required."
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    });
</script>
@endsection