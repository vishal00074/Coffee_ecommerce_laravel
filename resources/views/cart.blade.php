@extends('layout.index')
@section('content')
  
    <section class="cart_section sec_ptb_120 bg_default_gray">
    @if(count($carts)>0)
    <div class="container">
        <div class="cart_table">
            <table class="table">
                <thead class="text-uppercase wow fadeInUp" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <tr>
                        <th >Product</th>
						<th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
						<th>Remove</th>
                        <th>subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{url('update_cart')}}" method="post">
                    @csrf
                    @foreach($carts as $cart)
                    <tr class="wow fadeInUp" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                        <td>
                            <div class="carttable_product_item">
                                <div class="item_image">
                                    <img src="{{asset($cart->image)}}" alt="image_not_found">
                                </div>
                            </div>
                        </td>
						<td><div class="carttable_product_item"> <h3 class="item_title">{{$cart->name}}</h3></div></td>
                        <td><span class="price_text1">${{$cart->price}}.00</span></td>
                        <td>
                            <div class="quantity_input">

                                    <input type="hidden" name="cid[]" value="{{$cart->cid}}">
                                    <button type="button" class="input_number_decrement">–</button>
                                    <input class="input_number" name="quantity[]" type="text" value="{{$cart->quantity}}">
                                    <button type="button" class="input_number_increment">+</button>
                            </div>
                        </td>
						<td><div class="carttable_product_item">  <a href="{{url('remove_cart',$cart->cid)}}" class="remove_btn"><i class="fa fa-times"></i></a></div></td>
                        @php
                            $total = $cart->price * $cart->quantity;
                        @endphp
                        <td><span class="price_text2">${{$total}}.00</span></td>
                    </tr>
                    
                    @endforeach
                    <tr>
					
                        <td colspan="6"><button type="submit" class="btn btn-success text-dark">Update</button></td>    
                    </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <!--<ul class="carttable_footer ul_li_right wow fadeInUp" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">-->
        <!--    <li>-->
                <!--<button type="submit">Update</button>-->
        <!--    </li>-->
        <!--</ul>-->
        
        <ul class="carttable_footer ul_li_right wow fadeInUp" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <li>
                <div class="total_price text-uppercase">
                    <span>total</span>
                    <span class="total">${{$total_price}}.00</span>
                </div>
            </li>
            <li>
                <a href="{{url('checkout' )}}" class="btn btn_primary text-uppercase" id="grand_total" >proceed to checkout</a>
            </li>
        </ul>
    </div>
    @else		<div class="empy-cart"><img src="../public/assets/frontend/images/empty-cart.png" alt="empty-img" />
    <h2 class="text text-center"><b>Ooops!! No product available in Cart !!!</b></h2></div>
    @endif
</section>
 
@endsection


@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('Shopping Cart');
        
        function updateSubtotal(inputElement, priceElement) {
            var quantity = parseInt(inputElement.val());
            var price = parseFloat(priceElement.text().replace('$', '')); // Assuming price is in format $X.XX
            
            var subtotal = quantity * price;
            inputElement.closest('tr').find('.price_text2').text('$' + subtotal.toFixed(2));
            
            updateTotal();
        }
        
        function updateTotal() {
            var total = 0;
            $('.price_text2').each(function() {
                total += parseFloat($(this).text().replace('$', ''));
            });
            $('.total').text('$' + total.toFixed(2));
          inputTotal();  
        }
        
        function inputTotal(){
            var total = 0;
            $('.price_text2').each(function() {
                total += parseFloat($(this).text().replace('$', ''));
            });
            $('.total').text('$' + total.toFixed(2));
          inputTotal(); 
        }
        
        // Quantity increment and decrement
        $(".input_number_increment, .input_number_decrement").on("click", function () {
            var inputElement = $(this).siblings(".input_number");
            var priceElement = $(this).closest('tr').find('.price_text1','.total');
            updateSubtotal(inputElement, priceElement);
        });
        
        $(".input_number").on("input", function () {
            var inputElement = $(this);
            var priceElement = inputElement.closest('tr').find('.price_text1','.total');
            updateSubtotal(inputElement, priceElement);
        });
    });

    // quantity - start
    // --------------------------------------------------
    $('.input_number_decrement').click(function() {
        var input = $(this).next('input');
        var value = parseInt(input.val(), 10);
        if(value > 1) {
            input.val(value - 1);
        }
    });

    $('.input_number_increment').click(function() {
        var input = $(this).prev('input');
        var value = parseInt(input.val(), 10);
        input.val(value + 1);
    });
    inputNumber($(".input_number"));
    // quantity - end
    // --------------------------------------------------
</script>



@endsection