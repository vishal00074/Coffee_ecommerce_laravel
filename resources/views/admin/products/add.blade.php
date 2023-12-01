@extends('admin.app')



@section('content')

<!-- Content area -->

<div class="content">

    <!-- Page length options -->

    <div class="card">

        <div class="card-header header-elements-inline s-filter">

        	<div class="col-sm-6 mb-1" align="left">

			    <h6 class="card-title"><b>ADD - Product Details</b></h6>

            </div>

        	<div class="col-sm-6 mb-1" align="right">

				<button type="button" class="btn btn-success btn-sm">

					<a href="{{ url('/admin/grind') }}" class="text-white"> <i class="icon-circle-left2 mr-1"></i> Back</a>

				</button>

			</div>

        </div>

        <div class="card-body"> 

            <form class="ProductDetail" name="ProductDetail" action="{{url('/admin/products')}}" method="POST"  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-12">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Name</label>

                                    <input type="text" name="name" class="form-control" id="name" placeholder="Monsoon Malabar AA- Hoysala Estate">

                                </div>

                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" name="description" class="form-control" id="description" placeholder="description"></textarea>
                            </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Primary Image</label>

                                    <input type="file" name="image" class="form-control" id="image">

                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Secondary Images</label>
                                    <input type="file" name="secondary_images[]" class="form-control" id="image" multiple>
                                </div>
                            </div>

                           

                           

                            <div class="col-md-12">
                            <div class="form-group">
                                <label  for="">Size</label>
                                <select type="text" name="size_id" class="form-control" id="size_id" multiple  required>
                                    @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Grind type</label>
                                <select type="text" name="grind_id" class="form-control" id="grind_id">
                                <option value="">Select </option>
                                    @foreach($grinds as $grind)
                                    <option value="{{ $grind->id }}">{{ $grind->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Product type</label>
                                <select type="text" name="product_type" class="form-control" id="product_type">
                                <option value="">Select </option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <br><br><br><br><br><br>
                            <h6 class="card-title text-primary mt-6">Product Price</h6>
                            <div class="row table-responsive" id="productPrice" style="display:">
                                <table class="table">
                                    <thead class="table-warning">
                                        <tr>
                                            <th>Size</td>
                                            <th>Price</td>
                                            
                                            <th>Discounted Price</th>
                                            <th>Total Quantity</td>
                                        </tr>
                                    </thead>
                                    <tbody id="dynamic_data">
                                    
                                    </tbody>
                                </table>
                            </div>
                    
                            <div class="row mt-4">
                         <div class="col-md-12">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="submit_form">Submit form<i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </div>
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
<script type="text/javascript" src="{{asset('public/assets/admin/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
<script src="{{asset('public/assets/admin/global_assets/js/demo_pages/form_multiselect.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#size_id').multiselect({
            includeSelectAllOption: true
        });
   


        $('#size_id').on('change', function () {
                const selectedValues = $('#size_id').val();

                $.ajax({
                    url: "{{ url('admin/get_size') }}",
                    type: 'GET', 
                    data: {
                        selectedValues: selectedValues
                    },
                    success: function (data) {
                    container = $('#dynamic_data');
                    container.empty();
                    elementcontent = data.DynamicData;
                    container.append(elementcontent);

                    },
                    error: function (error) {
                        console.error(error);
                        container = $('#dynamic_data');
                        container.empty();
                    }
                });
            });
        });
    
</script>
<script type="text/javascript">

    // const ids = ['#description', '#column1', '#column2', '#column3', '#column4'];

    // ids.forEach((id) => {

    //     ClassicEditor.create(document.querySelector(id)).catch(error => {

    //         console.error(error);

    //     });

    // });

    

    

    

    $(document).ready(function(){

        

        

        if ($(".ProductDetail").length > 0) {

            $(".ProductDetail").validate({

                rules: {

                    name : "required",
                    image: "required",
                    description:'required',
                    size_id: "required",
                    grind_id: "required",
                    'price[]': "required",
                    'quantity[]': "required",
                    product_type: "required"

                },

                messages: {

                    name : "Name field is required.",
                    image : "image field is required.",
                    description : "description field is required.",
                    size_id : "Size field is required.",
                    grind_id : "grind field is required.",
                    price : "price field is required.",
                    quantity : "quantity field is required.",
                    product_type:  "Type  field is required.",

                    

                    

                },

                submitHandler: function(form) {

                    form.submit();

                }

            });

        }

    });
</script>

@endsection