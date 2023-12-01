@extends('layout.index')
@section('content')
<!DOCTYPE html>

  
 <section class="details_section shop_details sec_ptb_120 bg_default_gray">
          <div class="container">

          	<div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">
          		<div class="col-lg-6 col-md-7">
                    <div class="preview">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="{{ asset($products->image)}}" /></div>
                            @foreach($products->secondary_images as $key => $image)
                                <div class="tab-pane" id="pic-{{ $key + 2 }}"><img src="{{ url('/')."/".$image ?? '' }}" /></div>
                            @endforeach
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{ asset($products->image)}}" /></a></li>
                            @foreach($products->secondary_images as $key => $image)
                                <li><a data-target="#pic-{{ $key + 2 }}" data-toggle="tab"><img src="{{ url('/')."/".$image ?? '' }}" /></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
				

          		<div class="col-lg-6 col-md-7">
          			<div class="details_content wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
          				<div class="details_flex_title">
          					<h2 class="details_title text-uppercase">{{$products->name}}</h2>
          					<div class="details_review">
          						@if(!empty($products->rating))
                                    @php
                                        $roundedRating = round($products->rating);
                                    @endphp
                                    {!! str_repeat('<span><i class="fa fa-star"></i></span>', $roundedRating) !!}
                                    {!! str_repeat('<span><i class="fa fa-star-o"></i></span>',5- $roundedRating ) !!}
                                                @else
                                                    <span><i class="lnr lnr-star"></i></span>

                                                    <span><i class="lnr lnr-star"></i></span>

                                                    <span><i class="lnr lnr-star"></i></span>

                                                    <span><i class="lnr lnr-star"></i></span>

                                                    <span><i class="lnr lnr-star"></i></span>
                                                @endif
          						<span class="review_text">{{$products->rating_count}} - customer Review</span>
          					</div>
          				</div>
          				<p>
          					{{$products->description}} 
          				</p>
          				<div class="details_price">
          					<strong class="price_text">${{$products->discounted_price}}.00</strong>
          					@if($products->quantity >= '1') 
          					<span class="in_stuck"><i class="fa fa-check"></i> In stock</span>
          					@else
          					<span class="in_stuck"><i class="fa fa-cross"></i> Out Of stock</span>
          					@endif
          				</div>
          				
          				<ul class="btns_group ul_li">
          				    <form action="{{url('add_to_cart')}}" method="post" id="product_form">
          				        @csrf
          					<li>
          						<div class="quantity_input quantity_boxed">
          							<h4 class="quantity_title text-uppercase">Quantity ({{$products->quantity}})</h4>
          							    <input type="hidden"  name="product_id" value="{{ $products->id }}">
    									<button type="button" class="input_number_decrement">–</button>
    									<input class="input_number" type="text" name="quantity" value="1" required>
    									<button type="button" class="input_number_increment">+</button>
          						</div>
          					</li>
          					
          					
          					@php
                            $size_ids = \DB::table('product_details')->select('size_id')->where('product_id', $products->id)->get();
                            $sizeData = [];
                            
                            foreach ($size_ids as $size_id) {
                                $size = \DB::table('sizes')->select('short_name', 'id')->where('id', $size_id->size_id)->first();
                                
                                if ($size) {
                                    $sizeData[] = $size;
                                }
                            }
                            @endphp
          					<div class="pro-size">
                                <h5>SIZE :</h5>
                                <select class="" name="size_id" >
                                    <option value="">Select Size</option>
                            
                                    @foreach($sizeData as $size)
                                        @if($size->id == $products->size_id)
                                            <option value="{{ $size->id }}" selected>{{ $size->short_name }}</option>
                                        @else
                                            <option value="{{ $size->id }}">{{ $size->short_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
							<button class="btn btn-cart2" type="submit">Add to cart</button>
          					</form>
          				</ul>
          				
          				
          			</div>
          		</div>
          	</div>
            @php
                $ratings = \DB::table('ratings')

                ->select('*')
                ->where('product_id',$products->id)->get();
            @endphp
          	<div class="product_description_wrap wow fadeInUp" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
          		<ul class="tabs_nav ul_li nav" role="tablist">
          			<li>
          				<button class="active" data-bs-toggle="tab" data-bs-target="#product_review" type="button" role="tab" aria-selected="fase" class="">Review ({{$products->rating_count}})</button>
          			</li>
          		</ul>
          		<div class="tab-content">
          			 @foreach($ratings as $rating)
                        <div class="total-reviews">

                            <div class="rev-avatar">

                                <img src="{{asset('frontend/assets/img/about/avatar.jpg')}}" alt="">

                            </div>

                            <div class="review-box">

                                <div class="ratings">
                                    @if(!empty($rating->stars))
                                    @php
                                        $roundedRating = round($rating->stars);
                                    @endphp
                                    {!! str_repeat('<span><i class="fa fa-star"></i></span>', $roundedRating) !!}
                                    {!! str_repeat('<span><i class="fa fa-star-o"></i></span>',5- $roundedRating ) !!}
                                    @else
                                        <span><i class="lnr lnr-star"></i></span>

                                        <span><i class="lnr lnr-star"></i></span>

                                        <span><i class="lnr lnr-star"></i></span>

                                        <span><i class="lnr lnr-star"></i></span>

                                        <span><i class="lnr lnr-star"></i></span>
                                    @endif
                                <!--@for ($i = 0; $i < 5; $i++)-->
                                <!--    @if ($i < $rating->stars)-->
                                <!--        <span class="good"><i class="fa fa-star"></i></span>-->
                                <!--    @else-->
                                <!--        <span><i class="fa fa-star"></i></span>-->
                                <!--    @endif-->
                                <!--@endfor-->
                                  

                                </div>

                                <div class="post-author">

                                    <p><span>{{$rating->user_name}} -</span> {{ \Carbon\Carbon::parse($rating->created_at)->format('Y-m-d') }}</p>

                                </div>

                                <p>{{$rating->description}}</p>

                            </div>

                        </div>
                    @endforeach 
          		</div>
          	</div>

          	<div class="related_products">
          		<h4 class="area_title text-uppercase mb-0 wow fadeInUp" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">Related Product</h4>
          		<div class="row">
          		    @foreach($random_products as $random_product)
          			<div class="col-lg-4 col-md-6 col-sm-6">
          				<div class="shop_card wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
          					<!--<a class="wishlist_btn" href="#!"><i class="fa fa-heart"></i></a>-->
          					<!--<div class="share_btns">-->
          					<!--	<button type="button" class="share_btn">-->
          					<!--		<i class="fa fa-share-alt"></i>-->
          					<!--	</button>-->
          					<!--	<ul class="ul_li">-->
          					<!--		<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>-->
          					<!--		<li><a href="#"><i class="fa fa-twitter"></i></a></li>-->
          					<!--		<li><a href="#"><i class="fa fa-youtube"></i></a></li>-->
          					<!--		<li><a href="#"><i class="fa fa-instagram"></i></a></li>-->
          					<!--		<li><a href="#"><i class="fa fa-linkedin"></i></a></li>-->
          					<!--	</ul>-->
          					<!--</div>-->
          					<a class="item_image" href="{{url('product_detail',$random_product->slug)}}">
          						<img src="{{asset($random_product->image)}}" alt="image_not_found">
          					</a>
          					<div class="item_content">
          						<h3 class="item_title text-uppercase">
          							<a href="{{url('product_detail',$random_product->slug)}}">{{$random_product->name}}</a>
          						</h3>
          						<div class="btns_group">
          							<span class="item_price bg_default_brown">${{$random_product->discounted_price}}</span>
          							<a class="btn btn_border border_black text-uppercase" href="{{url('product_detail',$random_product->slug)}}">Buy Now</a>
          						</div>
          					</div>
          				</div>
          			</div>
          			@endforeach
          		</div>
          	</div>

          </div>
        </section>
	
  
 
  
  
 <!-- fraimwork - jquery include -->

	

	


</body>
</html>

@endsection

@section('script')

<script>
    $(document).ready(function () {
        var a = $('#span_title').html('Product Detail');
    });

    // quantity - start
    // --------------------------------------------------
    (function() {
        window.inputNumber = function(el) {
          var min = el.attr("min") || false;
          var max = el.attr("max") || false;
    
          var els = {};
    
          els.dec = el.prev();
          els.inc = el.next();
    
          el.each(function() {
            init($(this));
          });
    
          function init(el) {
            els.dec.on("click", decrement);
            els.inc.on("click", increment);
    
            function decrement() {
                var value = parseInt(el[0].value, 10);
                if (value > 1) {  // Adjusted condition here
                  value--;
                  el[0].value = value;
                }
            }
    
            function increment() {
              var value = el[0].value;
              value++;
              if (!max || value <= max) {
                el[0].value = value++;
              }
            }
          }
        };
    })();
    inputNumber($(".input_number"));
    // quantity - end
    // --------------------------------------------------
</script>
@endsection
