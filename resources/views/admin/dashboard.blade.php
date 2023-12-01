@extends('admin.app')

@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card wlcm">
                <div class="row">
                    <div class="col-md-5 p-4">
                        <img src="{{asset('public/assets/admin/img/dashboard.jpg')}}" alt=" "  height="220px" width="290px">
                    </div>
                    <div class="col-md-7 p-4">
                        <h4>Welcome <span>Back</span></h4>
                    </div>
                </div>
            </div>
            
            <div class="row dashboard">
                @if(auth()->guard('admin')->user())
                <div class="col-md-3 mb-2">
                    <div class="card bg-teal-400 p-3 text-center">
                        <div class="card-body">
                            <h4>General Settings</h4>
                            <div>
                                <a href="{{url('/admin/general')}}" class="btn btn-white btn-sm text-dark">VIEW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card bg-teal-400 p-3 text-center">
                        <div class="card-body">
                            <h4>Add Product</h4>
                            <div>
                                <a href="{{url('/admin/products/create')}}" class="btn btn-white btn-sm text-dark">VIEW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card bg-teal-400 p-3 text-center">
                        <div class="card-body">
                            <h4>Orders</h4>
                            <div>
                                <a href="{{url('/admin/orders')}}" class="btn btn-white btn-sm text-dark">VIEW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card bg-teal-400 p-3 text-center">
                        <div class="card-body">
                            <h4>User Queries</h4>
                            <div>
                                <a href="{{url('/admin/user_quries')}}" class="btn btn-white btn-sm text-dark">VIEW</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
        </div>
    </div>
</div>
@endsection