@extends('admin.app')

@section('content')

<div class="content">
    
    <div class="card">
        <div class="card-header header-elements-inline s-filter">
        	<div class="col-sm-6 mb-1" align="left">
			    <h6 class="card-title"><b>Orders Details</b></h6>
            </div>
        	<div class="col-sm-6 text-right" align="right">
				<a  class="btn btn-success btn-sm" href="{{ url('/admin/orders') }}" class="text-white"> <i class="icon-circle-left2 mr-1"></i> Back</a>
				
			</div>
        </div>
        
        @php
            $useraddress = DB::table('user_address')->where('user_id',$data->user_id)->first();
            $products = DB::table('products')->where('id',$data->product_id)->first();
        @endphp
        
        <div class="row">
            <div class="col-md-8 p-3">
                <div>
                    <h5>TRANSACTION ID &nbsp; : &nbsp; {{$data->order_id ?? ''}}</h5>
                    <div>
                        <i class="icon-calendar"></i> &nbsp;&nbsp; Date &nbsp;: <span class="mt-2 m-2">{{\Carbon\Carbon::parse($data->created_at)->format('d-M-Y')}}</span><br>
                    </div>
                </div>
                
                <div class="table-responsive mt-3">
                    <table class="table">
                        <thead  class="table-primary">
                            <tr>
                                <th>IMAGE</th>
                                <th>PRODUCT NAME</th>
                                <th>QUANTITY</th>
                                <th>PRICE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payment as $detail)
                                @php
                                    $products = DB::table('products')->where('id',$detail->product_id)->first();
                                    
                                @endphp
                                <tr>
                                    <td><img src="{{url('/',$products->image ?? '')}}" height="60px" width="60px" class="rounded" alt="no image"></td>
                                    <td>{{$products->name  ?? ''}}</td>
                                    <th>{{$detail->quantity}}</th>
                                    <td>{{$detail->total}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" align="right"><b>Total Amount</b></td>
                                <td>{{$amount}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="row dashboard">
                    <div class="col-md-12">
                        <div class="card bg-teal-400 p-3 text-center">
                            <div class="card-body">
                                <h4><u>USER INFORMATION</u></h4>
                                <div>
                                    <span class="title-color">Name : {{$useraddress->shipping_name}}</span><br>
                                    <span class="title-color break-all">Email : {{$useraddress->shipping_email}}</span><br>
                                    <span class="title-color break-all">Phone no. : {{$useraddress->phone}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <form class="OrderDetails bg-secondary p-3" action="{{url('/admin/orders')}}" method="POST">
                        @csrf
                        <h6 class="ml-2 text-white">ORDER STATUS</h6>
                        <input type="hidden" name="order_id" value="{{$data->order_id}}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" name="order_status" id="SelectOption">
                                    <option value="0" {{$data->order_status == "0" ? "selected" : "" ;}}>Pending</option>
                                    <option value="1" {{$data->order_status == "1" ? "selected" : "" ;}}>Confirmed</option>
                                    <option value="2" {{$data->order_status == "2" ? "selected" : "" ;}}>Shipping</option>
                                    <option value="3" {{$data->order_status == "3" ? "selected" : "" ;}}>Out for delivery</option>
                                    <option value="4" {{$data->order_status == "4" ? "selected" : "" ;}}>Delivered</option>
                                    <option value="5" {{$data->order_status == "5" ? "selected" : "" ;}}>Cancel</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" id="submit_form">UPDATE
                                <i class="icon-paperplane ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /page length options -->
</div>
@endsection


@section('script')
<script>
    $(document).ready(function(){
        var select = document.getElementById("SelectOption");
        var beforeSelect = select.selectedIndex;
        for (var i = 0; i < select.options.length; i++) {
            if (i < beforeSelect) {
                select.options[i].style.display = "none";
            } else {
                select.options[i].style.display = "block";
            }
        }
    });
</script>
@endsection