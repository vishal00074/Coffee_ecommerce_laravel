

<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">
        <div class="card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item">
                    <a href="{{url('/admin')}}" class="nav-link {{Request::segment(1)=='' ? 'active' : ''}}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/general')}}" class="nav-link {{Request::segment(1)=='general' ? 'active' : ''}}">
                        <i class="icon-cog2"></i>
                        <span>
                            General
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/type')}}" class="nav-link {{Request::segment(1)=='general' ? 'active' : ''}}">
                        <i class="fas fa-tasks"></i>
                        <span>
                            Types
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/grind')}}" class="nav-link {{Request::segment(1)=='general' ? 'active' : ''}}">
                        <i class="fas fa-list"></i>
                        <span>
                            Grind List
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('/admin/products')}}" class="nav-link {{Request::segment(1)=='general' ? 'active' : ''}}">
                        <i class="fas fa-box"></i>
                        <span>
                           Products 
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-files-empty"></i>Web Pages
                    </a>
                    <div class="dropdown-menu">
                        <!--<a href="{{url('/admin/home')}}" class="nav-link ">-->
                        <!--   <i class="icon-minus2"></i>-->
                        <!--   <span>Home</span>-->
                        <!--</a>-->
                        <a href="{{url('/admin/home_header')}}" class="nav-link ">
                            <i class="icon-minus2"></i>
                            <span>Home Header</span>
                        </a>
                        <a href="{{url('/admin/happy_customer')}}" class="nav-link ">
                            <i class="icon-minus2"></i>
                            <span>Happy Customer</span>
                        </a>
                        <a href="{{url('/admin/contact')}}" class="nav-link ">
                            <i class="icon-minus2"></i>
                            <span>Contact Us</span>
                        </a>
                        <!--<a href="{{url('/admin/about_us')}}" class="nav-link ">-->
                        <!--    <i class="icon-minus2"></i>-->
                        <!--    <span>About Us</span>-->
                        <!--</a>-->
                        <!--<a href="{{url('/admin/blogs')}}" class="nav-link ">-->
                        <!--    <i class="icon-minus2"></i>-->
                        <!--    <span>Blog</span>-->
                        <!--</a>-->
                        <!--<a href="{{url('/admin/refund_policy')}}" class="nav-link ">-->
                        <!--    <i class="icon-minus2"></i>-->
                        <!--    <span>Refund Policy</span>-->
                        <!--</a>-->
                        <!--<a href="{{url('/admin/shipping_policy')}}" class="nav-link ">-->
                        <!--    <i class="icon-minus2"></i>-->
                        <!--    <span>Shipping Policy</span>-->
                        <!--</a>-->
                        <!--<a href="{{url('/admin/policy')}}" class="nav-link ">-->
                        <!--    <i class="icon-minus2"></i>-->
                        <!--    <span>Privacy Policy</span>-->
                        <!--</a>-->
                        <a href="{{url('/admin/terms')}}" class="nav-link ">
                            <i class="icon-minus2"></i>
                            <span>Terms & Conditions</span>
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/user_quries')}}" class="nav-link {{Request::segment(1)=='' ? 'active' : ''}}">
                        <i class="fas fa-user"></i>
                        <span>
                            User Quries
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/orders')}}" class="nav-link {{Request::segment(1)=='' ? 'active' : ''}}">
                        <i class="fas fa-luggage-cart"></i>
                        <span>
                            Orders
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /sidebar content -->
</div>