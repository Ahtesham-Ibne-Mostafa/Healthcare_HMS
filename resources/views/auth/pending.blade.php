<!DOCTYPE html>
<html>
<head>
  <title>Account Pending | Sunrise Medical Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container text-center mt-5">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="alert alert-warning">
      <h4>Your account is under review</h4>
      <p>Please be patient. An administrator will confirm your role soon.</p>
    </div>
    <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
  </div>
</body>
</html>
