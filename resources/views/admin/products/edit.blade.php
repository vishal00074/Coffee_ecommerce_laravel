@extends('admin.app')


@section('content')

<!-- Content area  -->
<div class="content">
    <!-- Page length options -->
    <div class="card">
        <div class="card-header header-elements-inline s-filter">
            <div class="col-sm-6 mb-1" align="left">
                <h6 class="card-title"><b>Edit Product</b></h6>
            </div>
            <div class="col-sm-6 mb-1" align="right">
                <button type="button" class="btn btn-success btn-sm">
                    <a href="{{ url('/admin/products') }}" class="text-white"> <i class="icon-circle-left2 mr-1"></i> Back</a>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form class="AddProductDetails" action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <h6 class="card-title text-primary mt-2">Product Information</h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><b>Name</b></label>
                            <input type="text" class="form-control" id="name" name ="name" placeholder="Product Name" value="{{ $product->name ?? '' }}">
                        </div>
                        <div class="form-group">
                            <img src="{{url('/').'/'.$product->image ?? ''}}" alt="img" height="100px" width="100px" >
                            <label for=""><b>Image</b></label>
                            <input type="file" class="form-control" id="image" name ="image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for=""><b>Select Size</b></label>
                            <select class="form-control"  id="size_id" multiple required>
                                    @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" {{ in_array($size->id, $product_detail->pluck('size_id')->toArray()) ? 'selected' : '' }}>
                                        {{ $size->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            @foreach($product->secondary_images as $key=> $image)
                            
                             <img src="{{url('/').'/'.$product->secondary_images[$key] ?? ''}}" alt="img" height="100px" width="100px" >
                          @endforeach
                            <label for=""><b>Secondary Image</b></label>
                            <input type="file" class="form-control" id="secondary_images" name ="secondary_images[]" multiple>
                        </div>
                    </div>

                    
                </div>
                <h6 class="card-title text-primary mt-6">General Information</h6>
                <div class="row">
                  
                    <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Grind type</b></label>
                                <select type="text" name="grind_id" class="form-control" id="grind_id">
                                <option value="">Select </option>
                                    @foreach($grinds as $grind)
                                    <option value="{{ $grind->id }}" @if ($product->grind_id == $grind->id) selected @endif>{{ $grind->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Product type</b></label>
                                <select type="text" name="product_type" class="form-control" id="product_type">
                                <option value="">Select </option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}" @if ($product->product_type == $type->id) selected @endif>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""><b>Description</b></label>
                            <textarea class="form-control" id="description" name ="description" rows="6">{{$product->description ?? ''}}</textarea>
                        </div>
                    <div>
                </div>

                <div class="row table-responsive" id="getproductPrice" style="display:">
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
                            @foreach($product_detail as $single)
                            <tr><td>{{ $single->name }} </td>
                            <input type='hidden' class='form-control' name ='size_id[]' value="{{ $single->size_id }}" placeholder='Size'>
                            <td><input type='number' class='form-control' name ='price[]'  value="{{ $single->price }}"  placeholder='Price'></td>
                            <td><input type='number' class='form-control' name ='discounted[]'  value="{{ $single->discounted }}" placeholder='Discounted Price'></td>
                            <td><input type='number' class='form-control' name ='quantity[]'  value="{{ $single->quantity }}" placeholder='Total Quantity'></td></tr>
                            @endforeach
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
@endsection