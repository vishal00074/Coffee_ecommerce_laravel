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
    <div class="container-fluid">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="row">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#coffeeNavbarPrimary" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <a href="{{url('/')}}" class="header-logo h-inner">
                    <img src="{{asset('public/assets/frontend/images/logo.png')}}" alt="small-logo">
                </a>
                <div class="collapse navbar-collapse" id="coffeeNavbarPrimary">
                  <ul class="nav navbar-nav navbar-right">
                    <li>
                      <a href="{{url('/')}}">Home</a>
                    </li>
                    <li>
                      <a href="{{url('/shop')}}">Shop</a>
                    </li>
                     <!--<li class="active">
                      <a href="blog.html">blog</a>
                    </li>-->
                    <li>
                      <a href="{{url('/contact_us')}}">Contact</a>
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
                      <a href="{{url('/cart')}}"><i class="fa fa-shopping-cart"><span >{{$count}}</span></i></a>
                    </li>
                    <li class="button-order-now">
                      <a href="{{url('shop')}}">Order Now</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </nav>
	  
        </nav>
        </nav>
        </nav>
        </nav>
        </nav>
        <div class="banner clearfix">
            <div class="banner-img"><img src="{{asset('public/assets/frontend/images/cup.png')}}" alt="image"></div>
            <div class="banner-text">
                <h2>Our special & exclusive <span id="span_title"></span></h2>
            </div>
        </div>
    </div>
    <div class="social-icons">
        <a href="#"></a> <a href="#"></a> <a href="#"></a> <a href="#"></a>
    </div>
</header>