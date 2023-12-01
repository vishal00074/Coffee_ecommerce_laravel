@php
$contact = \DB::table('contact_us')->where('id',1)->first();
@endphp

@extends('layout.index')
@section('content')
  
  <section class="contact_section sec_ptb_120 bg_default_gray">
          <div class="container">
            <div class="contact_form bg_white wow fadeInUp" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
              <div class="main_contact_info_wrap">
                <div class="contact_info_item">
                  <div class="item_icon"><i class="fa fa-envelope"></i></div>
                  <div class="item_content">
                    <h3 class="item_title text-uppercase">Email Adress</h3>
                    <p>{{$contact->email}}</p>
                  </div>
                </div>
                <div class="contact_info_item">
                  <div class="item_icon"><i class="fa fa-map-marker"></i></div>
                  <div class="item_content">
                    <h3 class="item_title text-uppercase">Our Location</h3>
                    <p>{{$contact->address}}</p>
                  </div>
                </div>
                <div class="contact_info_item">
                  <div class="item_icon"><i class="fa fa-phone"></i></div>
                  <div class="item_content">
                    <h3 class="item_title text-uppercase">Phone Number</h3>
                    <p>{{$contact->phone}}</p>
                  </div>
                </div>
              </div>
              <form action="{{url('user_queries')}}" method="post">
                  @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form_item">
                      <input type="text" name="name" placeholder="Your Name">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form_item">
                      <input type="email" name="email" placeholder="Your Mail">
                    </div>
                  </div>
                </div>
                <div class="form_item">
                  <input type="text" name="subject" placeholder="Enter Your Subject">
                </div>
                <div class="form_item">
                  <textarea name="message" placeholder="Your Message"></textarea>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn_primary text-uppercase">Send Message</button>
                </div>
              </form>
            </div>
          </div>
        </section>
	
	
  <div>{!! ($contact->map) !!}</div>
<!--  <section >-->
<!--    <div >-->
<!--        <div id="map-canvas">{!! ($contact->map) !!}</div>-->
<!--    </div>-->
<!--</section>-->
  
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('Contact Us');
    });
</script>
@endsection