<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href={{ asset('css/app.css') }} rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark dark">
    <div class="container">
        <a href="/dashboard" class="navbar-brand"><img src="{{asset('img/widget_api_logo.svg')}}" width="60px"></a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">

            <div class="navbar-nav ms-auto">
              <a href="/dashboard" class="nav-item nav-link mx-3">Home</a>
              <a href="/pricing" class="nav-item nav-link mx-3">Pricing</a>
              <a href="/profile" class="nav-item nav-link mx-3">Profile</a>
              <a href="/logout" class="nav-item nav-link mx-3 special">Logout</a>
              
            </div>
        </div>
  </div>
</nav>

@php
    $widget_name = DB::table('widgets')
    ->select('name')
    ->where('id', $widget_id)
    ->first();

    $widget_page_name = strtolower(str_replace(' ', '_', $widget_name->name));
@endphp

        <!-- Main content !-->

        <div class="container mt-5">
            <div class="row">
                <div class="view col-5">
                    <iframe src="" width="100%" height="500" frameborder="0" scrolling="no" id="live_view"></iframe>
                </div>
                <div class="col-2"><!--extra div--></div>
                <div class="settings col text-white">
                    <h2><u>Settings</u></h2> 
                    <input type="hidden" id="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="widget_page_name" value="{{$widget_page_name}}">
                    <div class="available-setting mt-5" oninput="update()">

                        <!-- Color picker -->
                       <label for="page_bg_color"> Page background color: 
                        <input type="color" class="form-control form-control-color" id="page_bg_color" value="#563d7c" title="Choose your color">
                       </label>

                    </div>
                </div>
            </div>
        </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('/js/widget_settings.js') }}" type="text/javascript"> </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>