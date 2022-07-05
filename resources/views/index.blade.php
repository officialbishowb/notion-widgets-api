<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href={{ asset('css/app.css') }} rel="stylesheet">
    <title>Home</title>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark dark">
    <div class="container">
        <a href="#" class="navbar-brand"><img src="{{asset('img/widget_api_logo.svg')}}" width="60px"></a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">

            <div class="navbar-nav ms-auto">
              <a href="#" class="nav-item nav-link mx-3">Home</a>
              <a href="/pricing" class="nav-item nav-link mx-3">Pricing</a>
              <a href="/login" class="nav-item nav-link mx-3 special">Login</a>
              <a href="/register" class="nav-item nav-link mx-3 special">Register</a>
              
            </div>
        </div>
  </div>
</nav>


<!-- Main content -->

@php
  
  $widgets = DB::table('widgets')->get();

@endphp
<div class="container mt-5">
  <div class="row">
    @foreach($widgets as $widget)
    <div class="card col m-3" width="23rem;">
      <img src="{{$widget->image_path}}" class="card-img-top" alt="{{$widget->name}}">
      <hr>
      <div class="card-body text-center">
        <h5 class="card-title">{{$widget->name}}</h5>
        @if(session()->has('username_'))
          @php
            $is_premium  = DB::table('api_tokens')
                          ->select('token_type')
                          ->where('username', session()->get('username_'))
                          ->first();
            $is_premium = $is_premium->token_type == "free_token" ? false : true;
          @endphp
            @if($is_premium)
              <button class="btn btn-primary mt-2" onclick="window.location.href='/widget/{{ $widget->id }}'">Embed it</button>
            @elseif(!$is_premium && $widget->type == "premium_widget")
              <button class="btn btn-primary mt-2" onclick="window.location.href='/upgrade'">Upgrade to Premium</button>
            @else
              <button class="btn btn-primary mt-2" onclick="window.location.href='/pricing'">Embed it</button>
            @endif
        @else
          <button class="btn btn-primary mt-2" onclick="window.location.href='/widget/{{ $widget->id }}'">Embed it</button>
        @endif
      </div>
    </div>
    @endforeach
  </div>
</div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>