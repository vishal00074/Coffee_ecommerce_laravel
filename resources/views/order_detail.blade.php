@php
$total = $order_data->quantity * $order_data->total;
@endphp

@extends('layout.index')
@section('content')


<section class="h-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-8">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header rate-card px-4 py-5">
            <div class="rate-box">
            <h5 class="text-muted mb-0">Thanks for your Order, <span style="color: #a8729a;"></span></h5>
            <h5 class="text-muted mb-0">Order ID : {{$order_data->order_id}}<span style="color: #a8729a;"></span></h5></div>
            <button class="btn btn-cart2 mt-2" data-toggle="modal" data-target="#rate">Rate Product</button>
          </div>
          <div class="card-body  details-order">
            <div class="card shadow-0 border p-0">
              <div class="card-body">
                <div class="row pdct">
                  <div class="col-md-2">
                    <a href="{{url('product_detail',$data->slug)}}"><img src="{{asset($order_data->product_image)}}"
                      class="img-fluid" alt="Phone"></a>
                  </div>
                  <div class="col-md-6 text-center d-flex justify-content-center align-items-center">
                    <a href="{{url('product_detail',$data->slug)}}"><p class="text-muted mb-0">{{$order_data->product_name}}</p></a>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Qty: {{$order_data->quantity}}</p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">${{$total}}</p>
                  </div>
                </div>
                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                <div class="subtotal">
                <div class="row d-flex align-items-center">
                    <div class="col-md-12">
                    <p class="text-muted mb-0 small">Track Order</p>
                    </div>
                                        
                </div>

           
            <div class="d-flex justify-content-between pt-2">
                <p class="text-muted mb-0"><span class="fw-bold me-4">Order Status</span> 
                                           @if($order_data->order_status == 0)
                                           Pending
                                           @elseif($order_data->order_status == 1)
                                           Confirmed
                                           @elseif($order_data->order_status == 2)
                                           Shipping
                                           @elseif($order_data->order_status == 3)
                                           Out for delivery
                                           @elseif($order_data->order_status == 4)
                                           Delivered
                                           @elseif($order_data->order_status == 5)
                                           Canceled
                                           @endif
                                    </p>
            </div>
            
            <div class="d-flex justify-content-between pt-2">
                <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> ${{$total}}</p>
            </div>

            <div class="d-flex justify-content-between mb-5">
              <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p>
            </div>
          </div>
          <div class="card-footer border-0 px-4 py-5" >
            <h5 class="d-flex align-items-center justify-content-end text-white  mb-0">Total
              Paid: <span class="h2 mb-0 ms-2">${{$total}}</span></h5>
          </div></div>
        </div>
      </div>
    </div>
  </div>
</section>


<div id="rate" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Feedback</h4>
            </div>
            <div class="modal-body">
                <div id="message" style="text-align: center; color: green;"></div>
                <div class="form-group">
                    <span id="updatecapacitymodalerrortext" style="color:red"></span>
                </div>
                <form action="{{url('rating')}}" method="post" id="ratingForm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$order_data->product_id}}" >
                  <div class="form-group">
                  <div class="form-group">
                          <div class="col">
                              <label class="col-form-label">
                                  Your Name<span class="text-danger">*</span></label>
                              <input type="text" name="user_name" class="form-control" required="">
                          </div>
                      </div>
                          <div class="form-group">
                              <div class="col">
                                  <label class="col-form-label">
                                      Your Review<span class="text-danger">*</span></label>
                                  <textarea class="form-control" name="description" required=""></textarea>
                              </div>
                          </div>
                          
<div id="full-stars-example-two">
    <div class="rating-group">
        <input disabled checked class="rating__input rating__input--none" name="stars" id="rating3-none" value="0" type="radio">
        <label aria-label="1 star" class="rating__label" for="rating3-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="stars" id="rating3-1" value="1" type="radio">
        <label aria-label="2 stars" class="rating__label" for="rating3-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="stars" id="rating3-2" value="2" type="radio">
        <label aria-label="3 stars" class="rating__label" for="rating3-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="stars" id="rating3-3" value="3" type="radio">
        <label aria-label="4 stars" class="rating__label" for="rating3-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="stars" id="rating3-4" value="4" type="radio">
        <label aria-label="5 stars" class="rating__label" for="rating3-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="stars" id="rating3-5" value="5" type="radio">
    </div>

</div>

                      <button class="btn btn__bg" type="submit">Send</button>
                      <!-- <button type="submit" id="updateCapacityBtn" class="btn btn-info ">Save</button> -->
                  </div>
                </form>
            </div>
           
        </div>
  </div>
</div>
@endsection