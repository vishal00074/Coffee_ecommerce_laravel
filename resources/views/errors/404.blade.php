<!DOCTYPE html>
<html class="no-js">
<head>
    @include('includes.head')
</head>
<body>
  <div class="section section-padding">
    <div class="container">
        <div class="login-register-form">
            <h2 class="title">Page Not Found</h2>
            <p>The page you are trying to access could not be found. Please try looking for something else</p>
            <form>
                <div class="row row-cols-1 g-4">
                    <div class="col">
                        <a href="{{url('/')}}">
                            <input class="btn btn-dark btn-primary-hover rounded-0 w-100" type="button" value="Go To Homepage">
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
  