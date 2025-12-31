<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
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
            width: 280px; /* fixed width for uniform look */
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
        .doctor-info-card {
            max-width: 600px;
            margin: 0 auto 40px auto; /* center and add spacing below */
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
            <a class="navbar-brand fw-bold" href="#">
        <img src="{{ asset('images/logo.jpg') }}" alt="Hospital Logo" style="max-height:30px;" class="me-2">
        Sunrise Medical Center
      </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Doctor Info Card -->
     <h1 class="dashboard-title">Doctor Dashboard</h1>
    <div class="doctor-info-card">
        <h4 class="fw-bold mb-2">{{ Auth::user()->name }}</h4>
        <p class="mb-1">Specialization: {{ Auth::user()->specialization ?? 'General Physician' }}</p>
        <p class="mb-1">Email: {{ Auth::user()->email }}</p>
        <p class="mb-1">Phone: {{ Auth::user()->phone ?? 'N/A' }}</p>

    </div>

    <!-- Dashboard Content -->
    <div class="container">
        
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <!-- My Patients -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">👩‍⚕️</div>
                    <h5 class="card-title">My Patients</h5>
                    <p class="card-text">List of assigned patients will appear here.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">View Patients</a>
                </div>
            </div>
            <!-- Appointments -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">📅</div>
                    <h5 class="card-title">Appointments</h5>
                    <p class="card-text">Upcoming appointments will be shown here.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">Manage Appointments</a>
                </div>
            </div>
            <!-- Prescriptions -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">💊</div>
                    <h5 class="card-title">Prescriptions</h5>
                    <p class="card-text">Prescriptions you’ve issued will be displayed here.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">View Prescriptions</a>
                </div>
            </div>
            <!-- Reports -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">📄</div>
                    <h5 class="card-title">Reports</h5>
                    <p class="card-text">Medical reports and patient history can be accessed here.</p>
                    <a href="#" class="btn btn-outline-light btn-sm mt-2">View Reports</a>
                </div>
            </div>
        </div>
    </div>

<!-- Latest News -->
    <div class="container my-5">
        <h2 class="mb-4">Latest News</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/news-doctor.jpg') }}" class="card-img-top" alt="Doctor">
                    <div class="card-body">
                        <h5 class="card-title">New Specialist Joined</h5>
                        <p class="card-text">We welcome Dr. Nisha, a renowned neurologist, to our team.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/news-camp.jpg') }}" class="card-img-top" alt="Health Camp">
                    <div class="card-body">
                        <h5 class="card-title">Free Health Camp</h5>
                        <p class="card-text">Join our free health camp this weekend for checkups and consultations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/news-icu.jpg') }}" class="card-img-top" alt="ICU Facilities">
                    <div class="card-body">
                        <h5 class="card-title">New ICU Facilities</h5>
                        <p class="card-text">We’ve upgraded our ICU with state-of-the-art equipment for better care.</p>
                    </div>
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
