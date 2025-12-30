<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Sunrise Medical Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('{{ asset('images/hospital1.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }
    .overlay {
      position: fixed;
      top:0; left:0; width:100%; height:100%;
      background: rgba(0,0,0,0.5);
      z-index:0;
    }
    .login-card {
      position: relative;
      z-index:1;
      max-width: 450px;
      margin: auto;
      margin-top: 8%;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
      background-color: white;
    }
    .login-header {
      background-color: #003366;
      color: white;
      text-align: center;
      padding: 30px 20px;
    }
    .login-header img {
      max-height: 80px;
      margin-bottom: 15px;
    }
    .btn-primary {
      background-color: #003366;
      border-color: #003366;
    }
    .btn-primary:hover {
      background-color: #002244;
    }
    .btn-outline-primary {
      border-color: #003366;
      color: #003366;
    }
    .btn-outline-primary:hover {
      background-color: #003366;
      color: white;
    }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="login-card">
    <div class="login-header">
      <img src="{{ asset('images/logo.jpg') }}" alt="Hospital Logo">
      <h3 class="mb-0">Sunrise Medical Center</h3>
      <p class="fst-italic">Transforming Healthcare</p>
    </div>
    <div class="p-4">
      <h4 class="mb-4 text-center">Login to Your Account</h4>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input id="email" type="email" class="form-control" name="email" required autofocus>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input id="password" type="password" class="form-control" name="password" required>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
          </div>
          <a href="{{ route('password.request') }}" class="btn btn-outline-primary btn-sm">Forgot Password</a>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
      </form>
      <div class="text-center">
        <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Register Now</a>
      </div>
        <!-- Inside login-card, after Register Now button -->
    <div class="text-center mt-3">
    <a href="{{ url('/') }}" class="btn btn-outline-primary w-100">Back to Home</a>
    </div>

    </div>
  </div>
</body>
</html>
