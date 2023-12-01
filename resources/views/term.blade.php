@extends('layout.index')
@section('content') 
    
    <!-- main wrapper start -->
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area common-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <h1>Terms & Conditions</h1>
                                <!--<ul class="breadcrumb">-->
                                <!--    <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>-->
                                <!--    <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>-->
                                <!--</ul>-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->
        
        <!-- contact area start -->
        <div class="contact-area section-space">
            <div class="container">
                <div class="row">
                    {!! $term->description ?? 'Terms & Conditions' !!}
                </div>
            </div>
        </div>
        <!-- about wrapper end -->
    </main>
    <!-- main wrapper end -->

@endsection

@section('script')
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('Term&Conditions');
    });
</script>
@endsection