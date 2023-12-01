@php
    $types = \DB::table('types')->orderBy('id','asc')->get();
    $heading1 = \DB::table('home__hadings')->where('id',1)->first();
    $heading2 = \DB::table('home__hadings')->where('id',2)->first();
    $heading3 = \DB::table('home__hadings')->where('id',3)->first();
    $heading4 = \DB::table('home__hadings')->where('id',4)->first();
    $heading5 = \DB::table('home__hadings')->where('id',5)->first();
    $info = \DB::table('home__infos')->where('id',1)->first();
    $featur1 = \DB::table('home__features')->where('id',1)->first();
    $featur2 = \DB::table('home__features')->where('id',2)->first();
    $featur3 = \DB::table('home__features')->where('id',3)->first();
    $featur4 = \DB::table('home__features')->where('id',4)->first();
    $offer = \DB::table('home__offers')->where('id',1)->first();
    $customers = \DB::table('happy__customers')->orderBy('id','desc')->get();
    $ids = explode(',', $heading1->product_id);
    $products = \DB::table('products')->whereIn('id', $ids)->get();
    $CBDproduct = \DB::table('products')->where('id',$heading3->product_id)->first();
    $all_products = \DB::table('products')->orderBy('id', 'asc')->get();

    foreach($all_products as $all_product) {
        $price = \DB::table('product_details')
            ->where('product_details.product_id', '=', $all_product->id)
            ->select('product_details.discounted as price')
            ->first();
    
        if ($price) {
            $all_product->price = $price->price;
        }
    }
@endphp

@extends('layout.index')
@section('content')

  <section class="special-menu">
    <div class="container">
      <div>
        <div class="section-number">
          <span>01</span>
        </div>
        <div class="section-heading">
          <h1><span>{{$heading1->heading}}</span></h1>
        
        </div>
      </div>
    
      <div class="order-types-available row">
        <div class="row">
         
            @foreach($products as $product)
          <div class="order-type-wrapper">
            <div class="order-type type-one">
              <figure class="clearfix">
                <div class="img-holder"><a href="{{url('product_detail',$product->slug)}}"><img src="{{asset($product->image)}}" alt="order-type1"></a></div>
                <figcaption>
                  <h3><span>{{$product->name}}</span> </h3><a class="button-primary btn" href="{{url('product_detail',$product->slug)}}">Detail</a>
                </figcaption>
              </figure>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      
    </div>
  </section>
  <section class="midpage-banner1 banner-section">
    <div class="container">
      <div class="img-holder">
        <img class="milk-cup" src="{{asset('public/assets/frontend/images/milk-pour-cup.png')}}" alt="milk-pour-cup">
        <img class="cup" src="{{asset('public/assets/frontend/images/pour-cup.png')}}" alt="pour-cup">
      <div class="milk">
          <img src="{{asset('public/assets/frontend/images/milk-pour2.png')}}" alt="milk-pour2">
      </div>
      <img class="milk-drop" src="{{asset('public/assets/frontend/images/milk-drops.png')}}" alt="milk-drops"></div>
      <div class="banner1-details">
        <h3>{{$info->title}}</h3>
        <p>{!! ($info->description) !!}</p>
      </div>
    </div>
  </section>
  <section class="service-section">
    <div class="container">
      <div>
        <div class="section-number">
          <span>02</span>
        </div>
        <div class="section-heading">
          <h1><span>{{$heading3->heading}}</span></h1>
        
        </div>
      </div>
      <div class="row">
        <img src="{{asset($CBDproduct->image)}}" class="service-side-img animated fadeInLeft" alt="service-img">
        <div class="animated fadeInRight service-details pt-3"></br></br>
       <h3>{{$CBDproduct->name}}</h3>
          <p>{{$CBDproduct->description}}</p>
      <!--    <div class="info-box">-->
						<!--	<ul class="list-style-one">-->
						<!--		<li>More energy</li>-->
						<!--		<li>A reduction in the adverse effects of coffee, such as feeling jittery</li>-->
						<!--		<li>Weight loss</li>-->
						<!--		<li>Better sleep</li>-->
						<!--		<li>Reduced anxiety</li>-->
						<!--	</ul>-->
						<!--</div>-->
						<a href="{{url('product_detail',$CBDproduct->slug)}}" class="button-type-three">Buy Now</a>
        </div>
      </div>
    </div>
    
  </section>
  <section class="midpage-banner2 banner-section">
    <div class="container">
      <h3> <span>{{$heading2->heading}}</span> </h3>
      <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis nam, voluptatibus amet eius. Aperiam voluptate hic fugiat repudiandae, aliquid culpa error doloribus necessitatibus quod, iste quas est sint corporis ipsa!</p>
      <a href="#" class="button-type-three">Know More</a> -->
    </div>
  </section>
  <section class="coffee-feature">
    <div class="container">
      <div>
        <div class="section-number">
          <span>03</span>
        </div>
        
      </div>
      <div class="feature-form clearfix">
	  <div class="row">
        <div class="col-sm-3">
		<img src="{{$featur1->image}}" height="100px" widht="100px">
		<div class="lte-inner"><span class="lte-icon-content"> <span class="lte-header">{{$featur1->title}}</span> 
		<span class="lte-descr">{!! ($featur1->description) !!}</span>
          </span>
        </div>
		
		
		<img src="{{$featur2->image}}" height="100px" widht="100px">   
	    <div class="lte-inner"><span class="lte-icon-content"> 
		<span class="lte-header"> {{$featur2->title}} </span> <span class="lte-descr">{!! ($featur2->description) !!}</span></span></div>
		
		</div>
		<div class="col-sm-6">
		 <img src="{{asset('public/assets/frontend/images/coffee.jpg')}}" class="featre-img" alt="offer image">
		</div>
		<div class="col-sm-3">
	    <img src="{{$featur3->image}}" height="100px" widht="100px">  
		<div class="lte-inner"><span class="lte-icon-content"> <span class="lte-header">{{$featur3->title}}</span> <span class="lte-descr">{!! ($featur3->description) !!} </span></span></div>
		<img src="{{$featur4->image}}" height="100px" widht="100px"> 
		<div class="lte-inner"><span class="lte-icon-content"> <span class="lte-header">{{$featur4->title}} </span> <span class="lte-descr">{!! ($featur4->description) !!} </span></span></div>
		
		
		</div></div>
        
      </div>
    </div>
  </section>
  <section class="banner-section midpage-banner3">
    <div class="container">
      <div class="row">
        <figure class="offer-detail">
          <img src="{{asset($offer->image)}}" alt="offer image">
          <figcaption>
            <p>{{$offer->sub_title}}</p>
            <h3>{{$offer->title}}</h3>
            <p>{{$offer->offer}}</p>
          </figcaption>
        </figure>
        <div class="coupon-code">
          <div class="code-wrapper">
            <a class="code" href="#"><img src="{{asset('public/assets/frontend/images/code.jpg')}}" alt="qr code"></a>
          </div><!-- <img src="{{asset('public/assets/frontend/images/coupon.jpg')}}" alt="coupon image"> -->
        </div>
      </div>
    </div>
  </section>
  <section class="online-store">
    <div class="container">
      <div>
        <div class="section-number">
          <span>04</span>
        </div>
        <div class="section-heading">
          <h1><span>{{$heading4->heading}}</span></h1>
        </div>
      </div>
        <ul class="categories row">
            <li><button data-filter="*" class="selected" onclick="myFunction(event, '')">All</button></li>
            @foreach($types as $type)
                <li><button data-filter="{{ $type->slug }}" onclick="myFunction(event, '{{ $type->id }}')">{{ $type->name }}</button></li>
            @endforeach
        </ul>
      <div class="store-product-list row" id ="store-product">
       @foreach($all_products as $all_product)
        <div class="store-product-wrapper grid-item type3">
          <div class="store-product">
            <div class="imgLiquidFill imgLiquid item-image"><a href="{{url('product_detail',$all_product->slug)}}"><img src="{{asset($all_product->image)}}" alt="product item"></a></div>
            <div class="product-detail">
			<div class="pro-det">
              <h3>{{$all_product->name}}</h3>
              <p>1 pack 250 gm</p></div>
			  <div class="product-rate">
                ${{$all_product->price}}
              </div>
            </div>
            <div class="clearfix add-buy">
           <a href="{{url('product_detail',$all_product->slug)}}" class="buy-btn">Shop Now</a>
            </div>
          </div>
        </div>
       @endforeach
        
      </div>
    </div>
  </section>
  <section class="testimonial-sectn">
    <div class="container">
      <div>
        <div class="section-number">
          <span>05</span>
        </div>
        <div class="section-heading with-gray">
          <h1><span>{{$heading5->heading}}</span></h1>
        
        </div>
      </div>
      <div class="row testimonial">
        <ul class="clearfix testimonial-owl">
            @foreach($customers as $customer)
          <li class="testimonial-item item clearfix">
            <div class="imgLiquidFill imgLiquid"><img src="{{asset($customer->image)}}" alt="member1"></div>
            <div class="name-text">
              <h3>{{$customer->name}}</h3>
              <p>{!! ($customer->description) !!}</p>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
      
    </div>
  </section>


@endsection

@section('script')

<script>
    function myFunction(event, typeName) {
        event.preventDefault();

        console.log('Selected type:', typeName);

        $.ajax({
            url: '{{url('/type_data')}}',
            type: 'GET',
            dataType: 'json',
            data: {
                id: typeName
            },
            success: function(data) {
                var products = data.products;
                var productsHtml = '';
                var baseUrl = '<?php echo url('/'); ?>';

                for (var i = 0; i < products.length; i++) {
                    var productUrl = baseUrl + '/product_detail/' + products[i].slug;
                    productsHtml += '<div class="store-product-wrapper grid-item type3">';
                    productsHtml += '<div class="store-product">';
                    productsHtml += '<div class="imgLiquidFill  item-image"><a href="' + productUrl + '"><img src=' + products[i].image + ' alt="product item"></a></div>';
                    productsHtml += '<div class="product-detail">';
                    productsHtml += '<div class="pro-det">';
                    productsHtml += '<h3>' + products[i].name + '</h3>';
                    productsHtml += '<p>1 pack 250 gm</p></div>';
                    productsHtml += '<div class="product-rate">';
                    productsHtml += '$' + products[i].discounted_price;
                    productsHtml += '</div>';
                    productsHtml += '</div>';
                    productsHtml += '<div class="clearfix add-buy">';
                    productsHtml += '<a href="' + productUrl + '" class="buy-btn">Shop Now</a>';
                    productsHtml += '</div>';
                    productsHtml += '</div>';
                    productsHtml += '</div>';
                }
                $('#store-product').empty().append(productsHtml);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>

@endsection

