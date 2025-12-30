<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Healthcare HMS</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light">Logout</button>
            </form>

        </div>
    </nav>

    <div class="container">
        <h1>Admin Dashboard</h1>

        <div class="card mt-3">
            <div class="card-header">Manage Patients</div>
            <div class="card-body">
                <p>Patient list will appear here.</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">Manage Doctors</div>
            <div class="card-body">
                <p>Doctor list will appear here.</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">System Settings</div>
            <div class="card-body">
                <p>Admin controls and settings will be shown here.</p>
            </div>
        </div>
    </div>
</body>
</html>
