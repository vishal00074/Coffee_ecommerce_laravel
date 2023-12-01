@php
if(auth()->check()){ // Checking if the user is authenticated
    $userID = auth()->user()->id;
  
    $cart = DB::table('carts')->where('user_id', $userID)->get(); // Using DB facade
    $count = count($cart);
} else {
    $guestId = session()->get('guest_id');
    
    $cart = DB::table('carts')->where('user_id', $guestId)->get(); // Using DB facade
    $count = count($cart);
}
@endphp

<header>
    <div class="header-body">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="row">
            <div class="brand">
              <a href="{{url('/')}}">
              <p>SINCE 1939</p><img src="{{asset('public/assets/frontend/images/logo.png')}}" alt="Brand Logo" class="logo"></a>
            </div>
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#coffeeNavbarPrimary" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div><a href="{{url('/')}}" class="header-logo">Coffee and You <img src="{{asset('public/assets/frontend/images/logo.png')}}" alt="logo" width="100" ></a>
            <div class="collapse navbar-collapse" id="coffeeNavbarPrimary">
              <ul class="nav navbar-nav navbar-right">
                <li class="active">
                  <a href="{{url('/')}}">Home</a>
                </li>
                <li>
                  <a href="{{url('shop')}}">Shop</a>
                </li>
                <!--<li>-->
                <!--  <a href="{{url('blog')}}">blog</a>-->
                <!--</li>-->
                <li>
                  <a href="{{url('contact_us')}}">Contact</a>
                </li>
                <li class="user-hover">
                    <a href="#">
                        <i class="fa fa-user"></i>
                    </a>
                    <div>
                        <ul class="dropdown-list">
                            @guest
                            <li><a href="{{ url('/login') }}">login</a></li>
                            <li><a href="{{ url('/register') }}">register</a></li>
                            @else
                            <li><a href="{{ route('sign-out') }}">Sign out</a></li>
                            <li><a href="{{url('/profile')}}">my account</a></li>
                            @endif
                        </ul>
                    </div>
                </li>
                
                <li>
                  <a href="{{url('cart')}}"><i class="fa fa-shopping-cart"><span >{{$count}}</span></i></a>
                </li>
                <li class="button-order-now">
                  <a href="{{url('shop')}}">Order Now</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="banner">
        <div class="container">
          <div class="social-icons">
            <a href="#"></a> <a href="#"></a> <a href="#"></a> <a href="#"></a>
          </div>
          <div class="banner-image">
            <p>SINCE 1939</p>
            <div class="banner-img-holder">
              <img class="logo-cup" src="{{asset('public/assets/frontend/images/banner/logo-cup.png')}}" alt="Banner Images">
              <img class="logo" src="{{asset('public/assets/frontend/images/banner/logo.png')}}" alt="Banner Images">
              <img class="cup" src="{{asset('public/assets/frontend/images/banner/cup.png')}}" alt="Banner Images">
              <img class="premium-text" src="{{asset('public/assets/frontend/images/banner/txt2.png')}}" alt="Banner Images">
              <img class="coffee-text" src="{{asset('public/assets/frontend/images/banner/txt1.png')}}" alt="Banner Images">
              <div class="coffee-drop">
                  <img src="{{asset('public/assets/frontend/images/banner/coffee-drop3.png')}}" alt="Banner Images">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>