<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href={{ asset('css/app.css') }} rel="stylesheet">
    <title>Login</title>
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark dark">
      <div class="container">
          <a href="/" class="navbar-brand"><img src="{{asset('img/widget_api_logo.svg')}}" width="60px"></a>
          <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
  
              <div class="navbar-nav ms-auto">
                <a href="/" class="nav-item nav-link mx-3">Home</a>
                <a href="/pricing" class="nav-item nav-link mx-3">Pricing</a>
                @if(session()->has('username_'))
                    <a href="/dashboard" class="nav-item nav-link mx-3">Dashboard</a>
                    <a href="/register" class="nav-item nav-link mx-3 special">Logout</a>
                @else
                    <a href="/register" class="nav-item nav-link mx-3 special">Register</a>
                @endif
                
              </div>
          </div>
    </div>
  </nav>


        <div class="container">
            <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-light fs-5">Login</h5>
                    <form action="{{ url('/letme_in') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
        
                    <div class="d-grid">
                        <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign
                        in</button>
                    </div>

                    @if(session('login_error'))
                        <p class="text-center text-danger mt-3"> {{ session('login_error') }} </p>
                    @endif
                    <hr class="my-4">
                    <p class="text-center">Don't have an account? <a href="{{ url('/register') }}">Register</a></p>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>