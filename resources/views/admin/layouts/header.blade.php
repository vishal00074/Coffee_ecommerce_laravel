<!-- Main navbar -->
<div class="navbar navbar-expand-md">
    <div class="navbar-brand">
        <img src="{{auth()->guard('admin')->user()->logo ?? ''}}" class="rounded-ci rcle mr-2"  height="60" alt="">
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <!--<ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block"><i class="icon-paragraph-justify3"></i></a>
            </li>
        </ul>
        <span class="badge bg-success ml-md-3 mr-md-auto">Online</span> -->
        <ul class="navbar-nav" style="margin-left: auto;">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    @php $image=!empty(auth()->guard('admin')->user()->photo) ? asset("assets/admin/img").'/'.auth()->guard('admin')->user()->photo : '' @endphp
                    <img src="{{$image}}" class="rounded-circle mr-2" height="34" alt="">
                    <span>{{ucfirst(Auth::guard('admin')->user()->name)}}</span>
                </a>
    
                <div class="dropdown-menu dropdown-menu-right">
                    <!--<a href="" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>-->
                     <a href="{{url('/admin/profile')}}" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a> 
                    <!--<a href="" class="dropdown-item"><i class="icon-cog5"></i> Change Password</a>-->
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('adminLogout') }}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->
