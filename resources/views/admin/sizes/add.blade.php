@extends('admin.app')

@section('content')
<!-- Content area -->
<div class="content">
    <!-- Page length options -->
    <div class="card">
        <div class="card-header header-elements-inline s-filter">
        	<div class="col-sm-6 mb-1" align="left">
			    <h6 class="card-title"><b>ADD - Size DETAILS</b></h6>
            </div>
        	<div class="col-sm-6 mb-1" align="right">
				<button type="button" class="btn btn-success btn-sm">
					<a href="{{ url('/admin/size') }}" class="text-white"> <i class="icon-circle-left2 mr-1"></i> Back</a>
				</button>
			</div>
        </div>
        <div class="card-body"> 
            <form class="BlogDetails" name="BlogDetails" action="{{url('/admin/post_size')}}" method="POST" >
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Short Name</label>
                                    <input type="text" name="short_name" class="form-control" id="short_name">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="submit_form">PUBLISH
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
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

<script type="text/javascript">
    // const ids = ['#description', '#column1', '#column2', '#column3', '#column4'];
    // ids.forEach((id) => {
    //     ClassicEditor.create(document.querySelector(id)).catch(error => {
    //         console.error(error);
    //     });
    // });
    
    
    
    $(document).ready(function(){
        
        
        if ($(".BlogDetails").length > 0) {
            $(".BlogDetails").validate({
                rules: {
                    name : "required",
                    slug : "required"
                },
                messages: {
                    name : "Name field is required.",
                    
                    slug : "Slug field is required."
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    });
</script>
@endsection