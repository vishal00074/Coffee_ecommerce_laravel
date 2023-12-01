<!DOCTYPE html>
<html class="no-js">
<head>
    @include('includes.head')
    @yield('css')
</head>

@php
    $domain = url('/');
    $currenturl = request()->url();
@endphp

@if($domain != $currenturl)
<body class="menu-page inner-page">
@include('includes.header_sec')

@else
<body class="home-page">
@include('includes.header')
@endif
    
    @yield('content')

  
    @include('includes.footer')
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{asset('public/assets/frontend/scripts/toastr.min.js')}}"></script> 
    
    
    <script>
        if ("{{ session('success') }}") {
            toastr.success("{{ session('success') }}", "Success", {
                positionClass: "toast-top-right",
            });
        }
        
        if ("{{ session('error') }}") {
            toastr.error("{{ session('error') }}", "Error", {
                positionClass: "toast-top-right",
            });
        }
        
        if ("{{ session('info') }}") {
            toastr.info("{{ session('info') }}", "Info", {
                positionClass: "toast-top-right",
            });
        }
        
        if ("{{ session('warning') }}") {
            toastr.warning("{{ session('warning') }}", "Warning", {
                positionClass: "toast-top-right",
            });
        }
    </script>
  
    @yield('script')
</body>
</html>