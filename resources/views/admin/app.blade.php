<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.head')
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">

</head>
<body>
    <div class="loading hide"><img src="{{asset('assets/admin/img/loader.gif')}}"></div>
    @if(Auth::guard('admin')->user())
        @include('admin.layouts.header')
    @endif
        <!-- Page content -->
        <div class="page-content">
            @include('admin.layouts.sidebar')
            <!-- Main content -->
    		<div class="content-wrapper">
                <div class="content-inner">
                @if(Auth::guard('admin')->user())
                    @php $bread2=''; @endphp
                    <!-- Page header -->
                    <!--<div class="page-header page-header-light">-->
                    <!--    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">-->
                    <!--        <div class="d-flex">-->
                    <!--            <h6 class="mt-2">ADMIN-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!-- /page header -->
                @endif
    
                @yield('content')
                
                
                
                @if(Auth::guard('admin'))
                    @include('admin.layouts.footer')
                @endif
                </div>
            </div>
            <script>
                var base_url = `<?php echo URL::to('/');?>`;
                var asset_url = `<?php echo URL::to('/');?>`;
                $(document).ready(function(){
                    var success = `<?php echo Session::get('success'); ?>`;
                    if(success){
                        notify('success',success)
                    }
                    
                    var error = `<?php echo Session::get('error'); ?>`;
                    if(error){
                        notify('error',error)
                    }
                });
                var swalInit = swal.mixin({
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-light'
                });
            </script>
            
            @yield('script')
        </div>
    </body>
</html>