@php
    $types = \DB::table('types')->orderBy('id','asc')->get();
@endphp

@extends('layout.index')
@section('content')

  <section class="productPage">
    <div class="container">
      <ul class="categories row">
        <li><button data-filter="*" class="selected" onclick="myFunction(event, '')">All</button></li>
            @foreach($types as $type)
                <li><button data-filter="{{ $type->slug }}" onclick="myFunction(event, '{{ $type->id }}')">{{ $type->name }}</button></li>
            @endforeach
      </ul>
      <div class="store-product-list row" id="store-product">
          @foreach($products as $product)
        <div class="store-product-wrapper grid-item type1">
          <div class="store-product">
            <div class="imgLiquidFill imgLiquid item-image">
                <a href="{{url('product_detail',$product->slug)}}"><img src="{{asset($product->image)}}" alt="product item"></a>
            </div>
            <div class="product-detail">
			<h3>{{$product->name}}</h3>
              <div class="product-rate">
                ${{$product->discounted_price}}
              </div>
              
            </div>
           <div class="clearfix add-buy">
            
          <a href="{{url('product_detail',$product->slug)}}" class="buy-btn">Shop Now</a>
          </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection


@section('script')
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('Shop Now');
    });
    
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