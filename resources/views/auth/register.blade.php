<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Sunrise Medical Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('{{ asset('images/hospital2.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }
    .overlay {
      position: fixed;
      top:0; left:0; width:100%; height:100%;
      background: rgba(0,0,0,0.5);
      z-index:0;
    }
    .register-card {
      position: relative;
      z-index:1;
      max-width: 500px;
      margin: auto;
      margin-top: 6%;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
      background-color: white;
    }
    .register-header {
      background-color: #003366;
      color: white;
      text-align: center;
      padding: 30px 20px;
    }
    .register-header img {
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
  <div class="register-card">
    <div class="register-header">
      <img src="{{ asset('images/logo.jpg') }}" alt="Hospital Logo">
      <h3 class="mb-0">Sunrise Medical Center</h3>
      <p class="fst-italic">Transforming Healthcare</p>
    </div>
    <div class="p-4">
      <h4 class="mb-4 text-center">Create Your Account</h4>
      @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ url('/register') }}">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input id="name" type="text" class="form-control" name="name" required autofocus>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input id="email" type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input id="phone" type="text" class="form-control" name="phone">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input id="password" type="password" class="form-control" name="password" required>
        </div>
        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
      </form>
      <div class="text-center">
        <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">Already Have an Account? Login</a>
      </div>

      <!-- Inside register-card, after Login button -->
    <div class="text-center mt-3">
    <a href="{{ url('/') }}" class="btn btn-outline-primary w-100">Back to Home</a>
    </div>

    </div>
  </div>
</body>
</html>
