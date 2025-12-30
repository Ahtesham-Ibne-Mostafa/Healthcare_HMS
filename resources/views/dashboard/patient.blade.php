<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Healthcare HMS</a>
            <form method="POST" action="{{ route('logout') }}" class="ms-auto">
                @csrf
                <button type="submit" class="btn btn-outline-light">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <h1>Patient Dashboard</h1>

        <div class="card mt-3">
            <div class="card-header">My Appointments</div>
            <div class="card-body">
                <p>You have no appointments scheduled yet.</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">Prescriptions</div>
            <div class="card-body">
                <p>No prescriptions available.</p>
            </div>
        </div>
    </div>
</body>
</html>
+