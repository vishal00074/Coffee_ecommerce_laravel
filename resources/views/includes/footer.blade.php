@php
    $footer = \DB::table('footer')->where('id',1)->first();
@endphp

<footer>
    <div class="upper">
      <div class="container">
        <h2>{{$footer->title}}</h2>
        <div><img src="{{asset($footer->image)}}" alt="logo"></div><br><br>
        <div class="footer-nav-wrapper">
          <ul class="footer-nav clearfix">
            <li>
              <a href="{{url('/')}}">Home</a>
            </li>
            <!--<li>-->
            <!--  <a href="menu.html">Menu</a>-->
            <!--</li>-->
            <!--<li>-->
            <!--  <a href="gallery.html">Gallery</a>-->
            <!--</li>-->
            <li>
              <a href="{{url('cart')}}">Cart</a>
            </li>
            <li>
              <a href="{{url('contact_us')}}">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="lower">
        <div class="container">
            <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a> <small>{{$footer->copyright}}</small>
        </div>
    </div>
	<div class="lte-effect-smoke">
		<img src="{{asset('public/assets/frontend/images/coffee-smoke.png')}}" class="lte-effect-item-1" alt=".">
		<img src="{{asset('public/assets/frontend/images/coffee-smoke.png')}}" class="lte-effect-item-2" alt=".">
		<img src="{{asset('public/assets/frontend/images/coffee-smoke.png')}}" class="lte-effect-item-4" alt=".">
		<img src="{{asset('public/assets/frontend/images/coffee-smoke.png')}}" class="lte-effect-item-5" alt=".">
		<img src="{{asset('public/assets/frontend/images/coffee-smoke.png')}}" class="lte-effect-item-6" alt=".">
	</div>
</footer>
  


    <script src="{{asset('public/assets/frontend/scripts/vendor.js')}}"></script> 
    <script src="{{asset('public/assets/frontend/scripts/plugins.js')}}"></script> 
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
    <script src="{{asset('public/assets/frontend/scripts/main.js')}}"></script>