<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #003366 !important; /* deep blue theme */
        }
        .dashboard-title {
            color: #003366;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }
        .dashboard-card {
            background-color: #003366; /* deep blue cards */
            color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            width: 280px;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.2);
        }
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #ffcc00; /* gold accent */
        }
        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
        }
        .admin-info-card {
            max-width: 600px;
            margin: 0 auto 40px auto;
            background-color: #003366;
            color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Healthcare HMS</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Admin Info Card -->
    <div class="admin-info-card">
        <h4 class="fw-bold mb-2">{{ Auth::user()->name }}</h4>
        <p class="mb-1">Role: Administrator</p>
        <p class="mb-1">Email: {{ Auth::user()->email }}</p>
        <a href="#" class="btn btn-light btn-sm mt-2">Edit Profile</a>
    </div>

    <!-- Dashboard Content -->
    <div class="container">
        <h1 class="dashboard-title">Admin Dashboard</h1>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <!-- Manage Patients -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">🧑‍⚕️</div>
                    <h5 class="card-title">Manage Patients</h5>
                    <p class="card-text">Add, remove, or edit patient information.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">Manage Patients</a>
                </div>
            </div>
            <!-- Manage Doctors -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">👨‍⚕️</div>
                    <h5 class="card-title">Manage Doctors</h5>
                    <p class="card-text">Add, remove, or edit doctor information.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">Manage Doctors</a>
                </div>
            </div>
            <!-- Manage Appointments -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">📅</div>
                    <h5 class="card-title">Appointments</h5>
                    <p class="card-text">View and manage all appointments.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">Manage Appointments</a>
                </div>
            </div>
            <!-- Blood Donors -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">🩸</div>
                    <h5 class="card-title">Blood Donors</h5>
                    <p class="card-text">Add or remove blood donors.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">Manage Donors</a>
                </div>
            </div>
            <!-- Medical Records -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">📄</div>
                    <h5 class="card-title">Medical Records</h5>
                    <p class="card-text">View and manage patient medical records.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">View Records</a>
                </div>
            </div>
            <!-- Bookings -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">📑</div>
                    <h5 class="card-title">Bookings</h5>
                    <p class="card-text">View all service and package bookings.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">Manage Bookings</a>
                </div>
            </div>
            <!-- System Settings -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">⚙️</div>
                    <h5 class="card-title">System Settings</h5>
                    <p class="card-text">Manage system configurations and controls.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">Settings</a>
                </div>
            </div>
        </div>
    </div>


    
<!-- Footer Section -->
<footer class="pt-5 pb-3 mt-5" style="background-color:#003366; color:white;">
    <div class="container">
        <div class="row">
            <!-- Contact Info -->
            <div class="col-md-4 mb-4">
                <h5>Contact Us</h5>
                <p><strong>Sunrise Medical Center</strong></p>
                <p>Email: info@sunrisemedical.com</p>
                <p>Phone: 📞 10678</p>
                <a href="#" class="btn btn-outline-light btn-sm">Send Query</a>
            </div>

            <!-- Hospital Branding -->
            <div class="col-md-4 mb-4 text-center">
                <h4 class="fw-bold">Sunrise Medical Center</h4>
                <p class="fst-italic">Transforming Healthcare</p>
                <!-- Logo in footer center -->
                <img src="{{ asset('images/logo.jpg') }}" alt="Hospital Logo" class="img-fluid mt-3" style="max-height:80px;">
            </div>

            <!-- location -->
            <div class="col-md-4 mb-4 ms-auto text-end">
                <h5>Dhaka</h5>
                <p class="mt-3">
                    Sunrise Medical Center</p>
                    <p>Plot # 81, Block-E, Bashundhara R/A, Dhaka 1229, Bangladesh.
                </p>
</div>

        </div>

        <hr style="border-color:white;">
        <div class="text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Sunrise Medical Center. All rights reserved.</p>
        </div>
    </div>
</footer>


</body>
</html>
