@extends('admin.app')

@section('content')


<!-- Content area  -->
<div class="content">
    <!-- Page length options  -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <div class="col-sm-6 mb-1" align="left">
                <h6 class="card-title"><b>Header</b></h6>
            </div>
        </div>
    
        <div class="card-body">
          <div class="row">
              @php
                $i =1;
                $products = \DB::table('products')->orderBy('id','asc')->get();
              @endphp
              @foreach($headings as $heading)
            <div class="col-md-6">
              <form class="CustomerDetails" action="{{ url('/admin/update_heading',$heading->id)}}" method="POST">
                @csrf
                <h4><b>Heading {{$i++}}</b></h4>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Heading</label>
                      <input type="text" class="form-control" name="heading" value="{{$heading->heading}}"  required>
                    </div>
                  </div>
                </div>
                @if($heading->id =='1')
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Select Product</label>
                      <select type="text" name="product_id[]" class="form-control" id="size_id" multiple  required>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ in_array($product->id, explode(',', $heading->product_id)) ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                @endif
                @if($heading->id =='3')
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Select Product</label>
                      <select type="text" name="selected_id" class="form-control"  required>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $heading->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                @endif
                <div class="row">
                  <div class="col-md-12">
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" id="submit_form">Submit form <i class="icon-paperplane ml-2"></i></button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            @endforeach
          </div>
        </div>
    </div>
</div>





<div class="content">

  <!-- Page length options  -->

  <div class="card">
    <div class="card-header header-elements-inline">
      <div class="col-sm-6 mb-1" align="left">
        <h6 class="card-title"><b>Home Info</b></h6>
      </div>
    </div>

    
    <div class="card-body">
        <section id="services" class="services">
            
            <div class="container" data-aos="fade-up">
    
            <form action="" method="POST" >
    
              @csrf
    
              <div class="section-title text-center">
                <h4></h4>
              </div>
              <div class="row">
                <div class="col-md-12 col-lg-6 d-flex align-center" data-aos="zoom-in" data-aos-delay="100">
                  <div class="">
                      <img src="{{asset($info->image ?? '')}}" height="100px" width="100px" >
                    <h4 class="title"><a href="" data-toggle="modal" data-target="#myModal">{{$info->title ?? ''}}</a></h4>
                    <p class="description">{!! ($info->description ?? '') !!}</p>
                  </div>
                </div>
              </div>
    
            </form>
    
          </div>
    
        </section>
    </div>


    <!-- Modal -->

    <div class="modal fade" id="myModal" role="dialog" >

      <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>



          <h3 align="center">HOME INFO</h3>

          <div class="modal-body">

            <form action="{{url('/admin/update_info',$info->id)}}" method="POST" align="left" enctype="multipart/form-data">

              @csrf

              <input type="hidden" name="individual_data" >

              <label>Title</label>

              <input type="text" name="title" class="form-control" value="{{$info->title ?? ''}}">



              <label>Description</label>
              <textarea name="description" class="form-control" id="description" rows="4">{{$info->description ?? ''}}</textarea>
              
              <img src="{{asset($info->image ?? '')}}" height="100px" width="100px" >

                  <label>Image</label>

                  <input type="file" class="form-control" name="image" >
                  <br>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submit_form">Submit<i class="icon-paperplane ml-2"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="content">

  <!-- Page length options  -->

  <div class="card">

    <div class="card-body">

      <div class="row">

        <div class="col-md-12">

          <form action="{{ url('/admin/update_offer')}}" method="POST" enctype="multipart/form-data" align="left">

            @csrf

            <h1><b>App Details</b></h1>

            <div class="row">

              <input type="hidden" name="id" value="{{$offer->id ?? ''}}">
                
                <div class="col-md-8">
                    <div class="row">
            
                          <div class="col-md-12">
            
                            <div class="form-group">
            
                              <label>Title</label>
            
                              <input type="text" class="form-control" name="title" value="{{$offer->title ?? ''}}">
            
                            </div>
            
                          </div>
            
                          <div class="col-md-12">
            
                            <div class="form-group">
            
                              <label>Sub Title</label>
            
                              <input type="text" class="form-control" name="sub_title" value="{{$offer->sub_title ?? ''}}">
            
                            </div>
            
                          </div>
                          
                          
                          <div class="col-md-12">
            
                            <div class="form-group">
            
                              <label>Offer</label>
            
                              <input type="text" class="form-control" name="offer" value="{{$offer->offer ?? ''}}">
            
                            </div>
            
                          </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                          <div class="col-md-12">
            
                            <div class="form-group">
                                <img src="{{asset($offer->image ?? '')}}" height="100px" width="100px" >
            
                              <label>Image</label>
            
                              <input type="file" class="form-control" name="image" >
            
                            </div>
            
                          </div>
                    </div>
                </div>
            </div>

            <div class="row">

              <div class="col-md-12">

                <div class="text-center">

                  <button type="submit" class="btn btn-primary" id="submit_form">Submit form <i class="icon-paperplane ml-2"></i></button>

                  <br><br>

                </div>

              </div>

            </div>

          </form>

        </div>

      </div>

    </div>

  </div>

</div>





<div class="content">

  <!-- Page length options  -->

  <div class="card">

    <div class="card-header header-elements-inline">

      <div class="col-sm-6 mb-1" align="left">

        <h6 class="card-title"><b>Features</b></h6>

      </div>

    </div>


    <div class="card-body">
        
        <section class="join">
    
          <h1 class="text-center mb-5"></h1>
    
          <div class="container">
    
            <div class="row">
    
    
    
              <div class="col-sm-3">
                
                <div class="inside">
                    <img src="{{asset($featur1->image ?? '')}}">
                  <h4 class="title"><a href="" data-toggle="modal" data-target="#mycategory">{{$featur1->title}}</a></h4>
    
                  <p>
                    {!! $featur1->description !!}
                  </p>
    
                </div>
    
              </div>
    
              <div class="col-sm-3">
    
                <div class="inside">
                    <img src="{{asset($featur2->image ?? '')}}">
                  <h4 class="title"><a href="" data-toggle="modal" data-target="#categoryservice">{{$featur2->title}}</a></h4>
    
                  <p>
                    {!! $featur2->description !!}
                  </p>
    
                </div>
    
              </div>
    
              <div class="col-sm-3">
    
                <div class="inside">
                    <img src="{{asset($featur3->image ?? '')}}">
                  <h4 class="title"><a href="" data-toggle="modal" data-target="#myservice">{{$featur3->title}}</a></h4>
    
                  <p>
                    {!! $featur3->description !!}
                  </p>
    
                </div>
    
              </div>
    
              <div class="col-sm-3">
    
                <div class="inside">
                    <img src="{{asset($featur4->image ?? '')}}">
                  <h4 class="title"><a href="" data-toggle="modal" data-target="#mytitle">{{$featur4->title}}</a></h4>
    
                  <p>
                    {!! $featur4->description !!}
                  </p>
    
                </div>
    
              </div>
    
            </div>
    
          </div>
    
        </section>
        
    </div>
    
  </div>

</div>



  <div class="content">

    <div class="card">

      <div class="card-header header-elements-inline">

        <div class="col-sm-6 mb-1" align="left">

          <h6 class="card-title"><b>Seo</b></h6>

        </div>

      </div>



      <div class="card-body">

        <div class="row">

          <div class="col-md-12">

            <form action="{{ url('/admin/update_seo')}}" method="POST" enctype="multipart/form-data">

              @csrf

              <!--<h4><b>Footer Details</b></h4>-->

              <div class="row">

                <input type="hidden" name="type" value="{{$seo->type}}">

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Title</label>

                    <input type="text" class="form-control" name="title" value="{{$seo->title}}">

                  </div>

                </div>

                
                
                <div class="col-md-6">

                  <div class="form-group">

                    <label>Description</label>

                    <input type="text" class="form-control" name="description" value="{{$seo->description}}">

                  </div>

                </div>
                
                
                <div class="col-md-6">

                  <div class="form-group">

                    <label>Keyword</label>

                    <input type="text" class="form-control" name="keyword" value="{{$seo->keyword}}">

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-12">

                  <div class="text-center">

                    <button type="submit" class="btn btn-primary" id="submit_form">Submit form <i class="icon-paperplane ml-2"></i></button>

                  </div>

                </div>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>





   <!--//category data -->


  <div class="modal fade" id="mycategory" role="dialog" align="center">

    <div class="modal-dialog">

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <h3>
            
        </h3>

        <div class="modal-body">

          <form action="{{ url('/admin/update_feature')}}" method="POST" enctype="multipart/form-data" align="left">

            @csrf

            <input type="hidden" name="id" value="{{$featur1->id}}">



            


            <label>Title</label>

            <input type="text" name="title" class="form-control" value="{{$featur1->title}}">



            <label>Description</label>

             <textarea name="description" class="form-control" id="description1" rows="4">{{$featur1->description ?? ''}}</textarea>
            
            <img src="{{asset($featur1->image ?? '') }}" height="100px" width="100px" >
            <label>Image</label>

            <input type="file" name="image" class="form-control" >

            <div class="modal-footer">

              <button type="submit" class="btn btn-primary" id="submit_form">Submit<i class="icon-paperplane ml-2"></i></button>

            </div>

          </form>

        </div>

      </div>



    </div>

  </div>



  <div class="modal fade" id="categoryservice" role="dialog" align="center">

    <div class="modal-dialog">



      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <h3></h3>

        <div class="modal-body">

          <form action="{{ url('/admin/update_feature')}}" method="POST" enctype="multipart/form-data" align="left">

            @csrf

            <input type="hidden" name="id" value="{{$featur2->id}}">



            <label>Title</label>

            <input type="text" name="title" class="form-control" value="{{$featur2->title}}">



            <label>Description</label>

            <textarea name="description" class="form-control" id="description2" rows="4">{{$featur2->description ?? ''}}</textarea>
            
            <img src="{{asset($featur2->image ?? '')}}" height="100px" width="100px" >
            <label>Image</label>

            <input type="file" name="image" class="form-control" >

            <div class="modal-footer">

              <button type="submit" class="btn btn-primary" id="submit_form">Submit<i class="icon-paperplane ml-2"></i></button>

            </div>

          </form>

        </div>

      </div>



    </div>

  </div>



  <div class="modal fade" id="myservice" role="dialog" align="center">

    <div class="modal-dialog">

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <h3></h3>

        <div class="modal-body">

          <form action="{{ url('/admin/update_feature')}}" method="POST" enctype="multipart/form-data" align="left">

            @csrf

            <input type="hidden" name="id" value="{{$featur3->id}}">



            <label>Title</label>

            <input type="text" name="title" class="form-control" value="{{$featur3->title}}">



            <label>Description</label>

            <textarea name="description" class="form-control" id="description3" rows="4">{{$featur3->description ?? ''}}</textarea>
            
            <img src="{{asset($featur3->image ?? '')}}" height="100px" width="100px" >
            <label>Image</label>

            <input type="file" name="image" class="form-control" >
            
            <div class="modal-footer">

              <button type="submit" class="btn btn-primary" id="submit_form">Submit<i class="icon-paperplane ml-2"></i></button>

            </div>

          </form>

        </div>

      </div>



    </div>

  </div>



  <div class="modal fade" id="mytitle" role="dialog" align="center">

    <div class="modal-dialog">

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <h3></h3>

        <div class="modal-body">

          <form action="{{ url('/admin/update_feature')}}" method="POST" enctype="multipart/form-data" align="left">

            @csrf

            <input type="hidden" name="id" value="{{$featur4->id}}">



            <label>Title</label>

            <input type="text" name="title" class="form-control" value="{{$featur4->title}}">



            <label>Description</label>

            <textarea name="description" class="form-control" id="description4" rows="4">{{$featur4->description ?? ''}}</textarea>
            
            <img src="{{asset($featur4->image ?? '')}}" height="100px" width="100px" >
            <label>Image</label>

            <input type="file" name="image" class="form-control" >

            <div class="modal-footer">

              <button type="submit" class="btn btn-primary" id="submit_form">Submit<i class="icon-paperplane ml-2"></i></button>

            </div>

          </form>

        </div>

      </div>



    </div>

  </div>

</div>

@endsection



@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('public/assets/admin/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
<script src="{{asset('public/assets/admin/global_assets/js/demo_pages/form_multiselect.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

<script type="text/javascript">
    
    const ids = ['#description','#description1','#description2','#description3','#description4'];
    ids.forEach((id)=> {
        ClassicEditor.create(document.querySelector(id)).catch(error => {
            console.error(error);
        });
    });
    
    $(document).ready(function() {
        $('#size_id').multiselect({
            includeSelectAllOption: true
        });
    });

    // $(document).ready(function() {
    //     jQuery.validator.addMethod("fileType", function(value, element, types) {
    //         if (element.files && element.files.length) {
    //             var extension = element.files[0].name.split('.').pop().toLowerCase();
    //             return types.split('|').indexOf(extension) !== -1;
    //         }
    //         return true;
    //     }, "Please upload a file with a valid format (.jpg, .jpeg, .png).");
        
    //     jQuery.validator.addMethod("fileSize", function (value, element, maxSize) {
    //         if (element.files && element.files.length > 0) {
    //             var file = element.files[0];
    //             return file.size <= maxSize;
    //         }
    //         return true;
    //     }, jQuery.validator.format("File size should not exceed {200} bytes."));
        
    //     if ($(".MainDetails").length > 0) {
    //         $(".MainDetails").validate({
    //             rules: {
    //                 title: "required",
    //                 description: "required",
    //                 choose_title: "required",
    //                 choose_description: "required",
    //                 seo_title: "required",
    //                 seo_keyword: "required",
    //                 seo_description: "required",
    //                 image: {
    //                     fileType: "jpg|jpeg|png"
    //                 }
    //             },
    //             messages: {
    //                 title: "Title field is required.",
    //                 description: "Description field is required.",
    //                 choose_title: "Choose Title field is required.",
    //                 choose_description: "Choose Description field is required.",
    //                 seo_title: "SEO title field is required.",
    //                 seo_keyword: "SEO keyword field is required.",
    //                 seo_description: "SEO description field is required.",
    //             },
    //             submitHandler: function(form) {
    //                 form.submit();
    //             }
    //         });
    //     }
        
    //     if ($("#ChoooseA").length > 0) {
    //         $("#ChoooseA").validate({
    //             rules: {
    //                 title: "required",
    //                 description: "required",
    //                 image: {
    //                     fileSize: 200000,
    //                     fileType: "jpg|jpeg|png"
    //                 }
    //             },
    //             messages: {
    //                 title: "Title field is required.",
    //                 description: "Description field is required."
    //             },
    //             submitHandler: function(form) {
    //                 form.submit();
    //             }
    //         });
    //     }
        
    //     if ($("#ChoooseB").length > 0) {
    //         $("#ChoooseB").validate({
    //             rules: {
    //                 title: "required",
    //                 description: "required",
    //                 image: {
    //                     fileSize: 200000,
    //                     fileType: "jpg|jpeg|png"
    //                 }
    //             },
    //             messages: {
    //                 title: "Title field is required.",
    //                 description: "Description field is required."
    //             },
    //             submitHandler: function(form) {
    //                 form.submit();
    //             }
    //         });
    //     }
        
    //     if ($("#ChoooseC").length > 0) {
    //         $("#ChoooseC").validate({
    //             rules: {
    //                 title: "required",
    //                 description: "required",
    //                 image: {
    //                     fileSize: 200000,
    //                     fileType: "jpg|jpeg|png"
    //                 }
    //             },
    //             messages: {
    //                 title: "Title field is required.",
    //                 description: "Description field is required."
    //             },
    //             submitHandler: function(form) {
    //                 form.submit();
    //             }
    //         });
    //     }
    // });
    
</script>

@endsection