@extends('admin.app')

@section('content')
<!-- Content area -->
<div class="content">
    <!-- Page length options -->
    <div class="card">
        <div class="card-header header-elements-inline s-filter">
        	<div class="col-sm-6 mb-1" align="left">
			    <h6 class="card-title"><b>TERMS & CONDITIONS</b></h6>
            </div>
        	<div class="col-sm-6 mb-1" align="right">
				<button type="button" class="btn btn-success btn-sm">
					<a href="{{ url('/admin') }}" class="text-white"> <i class="icon-circle-left2 mr-1"></i> Back</a>
				</button>
			</div>
        </div>
        <div class="card-body"> 
            <form class="TermsDetails" action="{{url('/admin/terms/post')}}" method="POST" >
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label><br>
                                    <textarea name="description" class="form-control" id="description">{{$terms->description ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4>SEO SECTION</h4>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{$seo->title ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>SEO Keyword</label>
                                    <input type="text" name="seo_keyword" class="form-control" id="seo_keyword" value="{{$seo->keyword ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <input type="text" name="seo_description" class="form-control" id="seo_description" value="{{$seo->description ?? ''}}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
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
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

<script type="text/javascript">
    ClassicEditor.create(document.querySelector('#description')).catch(error => {
        console.error(error);
    });
    
    $(document).ready(function(){
        if ($(".TermsDetails").length > 0) {
            $(".TermsDetails").validate({
                rules: {
                    description : "required"
                },
                messages: {
                    description : "Description field is required."
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    });
</script>
@endsection