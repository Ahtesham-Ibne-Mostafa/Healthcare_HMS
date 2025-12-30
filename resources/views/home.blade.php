<!DOCTYPE html>
<html>
<head>
    <title>Hospital Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       .hero {
        position: relative;
        height: 600px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-size: cover;
        background-position: center;
        transition: background-image 1s ease-in-out;
    }

    /* Overlay */
    .hero::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5); /* semi-transparent black */
        z-index: 1;
    }

    /* Ensure text is above overlay */
    .hero .container {
        position: relative;
        z-index: 2;
    }


        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .quick-links .btn {
            margin: 10px;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="py-2 px-3 d-flex justify-content-between align-items-center" style="background-color:#003366; color:white;">
        <span>Welcome to Sunrise Medical Center</span>
        <span>📞 10678</span>
    </div>

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color:white;">
    <div class="container">
        <!-- Logo on far left -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('images/logo.jpg') }}" alt="Hospital Logo" style="max-height:40px;" class="me-2">
            <span class="fw-bold" style="color:#003366;">Sunrise Medical Center</span>
        </a>

        <!-- Navigation links -->
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link custom-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link custom-link" href="#">About Us</a></li>
            <li class="nav-item"><a class="nav-link custom-link" href="#">Services</a></li>
            <li class="nav-item"><a class="nav-link custom-link" href="#">Doctors</a></li>
            <li class="nav-item"><a class="nav-link custom-link" href="#">Reports</a></li>
            <li class="nav-item"><a class="nav-link custom-link" href="#">Careers</a></li>
            <li class="nav-item"><a class="nav-link custom-link" href="#">Contact</a></li>
        </ul>

        <!-- Login/Register buttons on far right -->
        <div>
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        </div>
    </div>
</nav>

    <!-- Custom CSS -->
    <style>
        .navbar .nav-link {
            color: #003366; /* deep blue text by default */
            font-weight: 500;
        }
        .navbar .nav-link:hover {
            background-color: #003366; /* deep blue background on hover */
            color: white; /* white text on hover */
            border-radius: 4px;
            transition: 0.3s;
        }
        .btn-outline-primary {
            border-color: #003366;
            color: #003366;
        }
        .btn-outline-primary:hover {
            background-color: #003366;
            color: white;
        }
        .btn-primary {
            background-color: #003366;
            border-color: #003366;
        }
        .btn-primary:hover {
            background-color: #002244; /* slightly darker blue on hover */
        }
    </style>


    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="container">
            <h1>Transforming Healthcare in Bangladesh</h1>
        </div>
    </section>


    <!-- Quick Access -->
    <div class="container text-center my-4 quick-links">
        <a href="#" class="btn btn-outline-primary">Find a Doctor</a>
        <a href="#" class="btn btn-outline-success">Request Appointment</a>
        <a href="#" class="btn btn-outline-info">Online Report</a>
        <a href="#" class="btn btn-outline-warning">Telemedicine</a>
        <a href="#" class="btn btn-outline-secondary">Visitor Guide</a>
    </div>

    <!-- Why Choose Sunrise Medical Center -->
    <div class="container my-5">
        <div class="row align-items-start">
            <!-- Left: Text -->
            <div class="col-md-6">
                <h2 class="mb-4">Why Choose Sunrise Medical Center</h2>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">✔ First JCI-accredited hospital in Bangladesh</li>
                    <li class="list-group-item">✔ 24/7 Emergency and Trauma Care</li>
                    <li class="list-group-item">✔ 425-bed multidisciplinary facility</li>
                    <li class="list-group-item">✔ Advanced diagnostic labs and imaging</li>
                    <li class="list-group-item">✔ Renowned specialists across 30+ departments</li>
                    <li class="list-group-item">✔ Compassionate nursing and patient support</li>
                </ul>
            </div>

            <!-- Right: Image -->
            <div class="col-md-6 d-flex align-items-start">
                <img src="{{ asset('images/why-choose.jpg') }}" class="img-fluid rounded" alt="Hospital Facilities">
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





    <script>
        // Array of image URLs
        const images = [
            "{{ asset('images/hospital3.jpg') }}",
            "{{ asset('images/hospital2.jpg') }}",
            "{{ asset('images/hospital1.jpg') }}"
        ];

        let currentIndex = 0;
        const hero = document.getElementById('hero');

        // Function to change background
        function changeBackground() {
            hero.style.backgroundImage = `url('${images[currentIndex]}')`;
            currentIndex = (currentIndex + 1) % images.length;
        }

        // Initial background
        changeBackground();

        // Change every 2 seconds (2000 ms)
        setInterval(changeBackground, 2000);
    </script>

</body>
</html>
