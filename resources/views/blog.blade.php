@extends('layout.index')
@section('content')
  <section class="blog-list-sectn">
    <div class="container">
      <br><br>
      <div class="section-heading-type2">
        <h2>Top Blog and News</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </div>
      <div class="blog-item clearfix">
        <div class="imgLiquid imgLiquidFill blog-img"><img src="{{asset('public/assets/frontend/images/blog-list/blog-img1.jpg')}}" alt="blog-img1"></div>
        <div class="blog-excerpt">
          <h5>26th September, 2015</h5>
          <h2>Really Strong Coffee</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores vel fuga voluptas asperiores facere commodi tempore, veritatis excepturi sit consequatur, esse voluptatum tenetur quos soluta doloribus? A molestiae, dolor at!</p>
          <div class="author-details">
            <div class="imgLiquid imgLiquidFill auth-icon"><img src="{{asset('public/assets/frontend/images/blog-list/author-icon.png')}}" alt="author-icon"></div>
            <h5>Author, <span>Western</span></h5><a href="blogDetails.html" class="button-primary btn">Read More</a>
          </div>
        </div>
      </div>
      <div class="blog-item clearfix">
        <div class="imgLiquid imgLiquidFill blog-img"><img src="{{asset('public/assets/frontend/images/blog-list/blog-img2.jpg')}}" alt="blog-img2"></div>
        <div class="blog-excerpt">
          <h5>26th September, 2015</h5>
          <h2>Really Strong Coffee</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores vel fuga voluptas asperiores facere commodi tempore, veritatis excepturi sit consequatur, esse voluptatum tenetur quos soluta doloribus? A molestiae, dolor at! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque unde aperiam laudantium quae delectus accusantium, fugit accusamus ullam reprehenderit. Nemo accusamus, nihil deserunt ratione. Quis porro sed quam, eum facere! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae fugiat architecto quis, eaque perspiciatis totam beatae! Eaque deleniti repudiandae cumque, provident praesentium error consequatur, dolores pariatur explicabo odit iure? Laboriosam.</p>
          <div class="author-details">
            <div class="imgLiquid imgLiquidFill auth-icon"><img src="{{asset('public/assets/frontend/images/blog-list/author-icon.png')}}" alt="author-icon"></div>
            <h5>Author, <span>Western</span></h5><a href="blogDetails.html" class="button-primary btn">Read More</a>
          </div>
        </div>
      </div>
      <div class="blog-item clearfix">
        <div class="imgLiquid imgLiquidFill blog-img"><img src="{{asset('public/assets/frontend/images/blog-list/blog-img3.jpg')}}" alt="blog-img3"></div>
        <div class="blog-excerpt">
          <h5>26th September, 2015</h5>
          <h2>Really Strong Coffee</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores vel fuga voluptas asperiores facere commodi tempore, veritatis excepturi sit consequatur, esse voluptatum tenetur quos soluta doloribus? A molestiae, dolor at!</p>
          <div class="author-details">
            <div class="imgLiquid imgLiquidFill auth-icon"><img src="{{asset('public/assets/frontend/images/blog-list/author-icon.png')}}" alt="author-icon"></div>
            <h5>Author, <span>Western</span></h5><a href="blogDetails.html" class="button-primary btn">Read More</a>
          </div>
        </div>
      </div>
      <div class="blog-item clearfix">
        <div class="imgLiquid imgLiquidFill blog-img"><img src="{{asset('public/assets/frontend/images/blog-list/blog-img4.jpg')}}" alt="blog-img4"></div>
        <div class="blog-excerpt">
          <h5>26th September, 2015</h5>
          <h2>Really Strong Coffee</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores vel fuga voluptas asperiores facere commodi tempore, veritatis excepturi sit consequatur, esse voluptatum tenetur quos soluta doloribus? A molestiae, dolor at! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque impedit sunt repudiandae rerum eum perspiciatis maiores. Quaerat, officiis, odit. Iusto reiciendis rem unde ea, voluptatibus est accusamus facilis quae quasi?</p>
          <div class="author-details">
            <div class="imgLiquid imgLiquidFill auth-icon"><img src="{{asset('public/assets/frontend/images/blog-list/author-icon.png')}}" alt="author-icon"></div>
            <h5>Author, <span>Western</span></h5><a href="blogDetails.html" class="button-primary btn">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var a = $('#span_title').html('Blog');
    });
</script>
@endsection