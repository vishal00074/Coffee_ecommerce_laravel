@extends('layout.index')

@section('content') 
<div class="vh-100 d-flex justify-content-center align-items-center">
            <div>
                
                <div class="text-center thnk-page">
                    <h1>Thank You !</h1>
                    <p>Order has been Placed</p>
                    <a  href="{{ url('/') }}" class="butn-dark2">Back Home</a>
                </div>
            </div>
</div>           
@endsection    

@section('script')
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('ThankYou');
    });
</script>
@endsection