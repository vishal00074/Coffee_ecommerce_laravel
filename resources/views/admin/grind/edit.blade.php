@extends('admin.app')



@section('content')

<!-- Content area -->

<div class="content">

    <!-- Page length options -->

    <div class="card">

        <div class="card-header header-elements-inline s-filter">

        	<div class="col-sm-6 mb-1" align="left">

			    <h6 class="card-title"><b>ADD - TYPE DETAILS</b></h6>

            </div>

        	<div class="col-sm-6 mb-1" align="right">

				<button type="button" class="btn btn-success btn-sm">

					<a href="{{ url('/admin/grind') }}" class="text-white"> <i class="icon-circle-left2 mr-1"></i> Back</a>

				</button>

			</div>

        </div>

        <div class="card-body"> 

            <form class="GrindDetail" name="GrindDetail" action="{{url('/admin/grind',$grind->id)}}" method="POST" >

                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-md-8">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Name</label>

                                    <input type="text" name="name" class="form-control" id="name" value="{{ $grind->name }}">

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

        

        

        if ($(".GrindDetail").length > 0) {

            $(".GrindDetail").validate({

                rules: {

                    name : "required",

                   

                },

                messages: {

                    name : "Name field is required.",

                    

                    

                },

                submitHandler: function(form) {

                    form.submit();

                }

            });

        }

    });

</script>

@endsection