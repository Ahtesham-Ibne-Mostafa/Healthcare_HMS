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
.image-square {
  width: 300px;   /* bigger square */
  height: 300px;
  overflow: hidden;
  border-radius: 12px;
  margin-bottom: 12px;
}
.image-square img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.package-card-bg {
  background-color: #003366; /* deep blue theme */
  border-radius: 12px;
  padding-top: 10px;
}
.package-card-bg .card-body {
  color: white;
}
.btn-purple {
  background-color: #6f42c1;
  color: white;
  border-radius: 25px;
  padding: 8px 20px;
}
.btn-purple:hover {
  background-color: #5a379e;
}

        .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
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

<!-- Health Check Packages Section -->
<div class="container mt-5 px-4">
  <h2 class="text-center mb-4" style="color:#003366;">Health Check Packages</h2>
  <div class="row g-4 justify-content-center">
    @php
      $packages = [
        ['title' => 'Executive Health Check', 'subtitle' => 'Male/Female', 'image' => 'executive.jpg'],
        ['title' => 'Heart Check', 'subtitle' => 'For Men', 'image' => 'heart-men.jpg'],
        ['title' => 'Heart Check', 'subtitle' => 'For Women', 'image' => 'heart-women.jpg'],
        ['title' => 'Whole Body Check', 'subtitle' => 'Men Above 45', 'image' => 'body-men-above.jpg'],
        ['title' => 'Whole Body Check', 'subtitle' => 'Men Below 45', 'image' => 'body-men-below.jpg'],
        ['title' => 'Whole Body Check', 'subtitle' => 'Women Above 45', 'image' => 'body-women-above.jpg'],
        ['title' => 'Whole Body Check', 'subtitle' => 'Women Below 45', 'image' => 'body-women-below.jpg'],
        ['title' => 'General Health Check', 'subtitle' => 'Male Below 40', 'image' => 'general-male.jpg'],
        // Extra packages (hidden initially)
        ['title' => 'Diabetes Care Package', 'subtitle' => '', 'image' => 'diabetes.jpg'],
        ['title' => 'Cancer Screening Package', 'subtitle' => '', 'image' => 'cancer.jpg'],
        ['title' => 'Senior Citizen Health Package', 'subtitle' => '', 'image' => 'senior.jpg'],
        ['title' => 'Women Wellness Package', 'subtitle' => '', 'image' => 'women-wellness.jpg'],
      ];
    @endphp

    @foreach($packages as $index => $package)
      <div class="col-lg-3 col-md-4 col-sm-6 package-card {{ $index >= 8 ? 'd-none extra-package' : '' }}">
        <div class="card h-100 text-center shadow-sm package-card-bg">
          <!-- Bigger square image -->
          <div class="image-square mx-auto mt-3">
            <img src="{{ asset('images/packages/'.$package['image']) }}" alt="{{ $package['title'] }}">
          </div>
          <div class="card-body">
            <h6 class="card-title mb-1 text-white">{{ $package['title'] }}</h6>
            @if($package['subtitle'])
              <p class="text-light small mb-2">{{ $package['subtitle'] }}</p>
            @endif
            <a href="#" class="btn btn-outline-light btn-sm mt-2">See Package</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="text-center mt-4">
    <button id="viewAllBtn" class="btn btn-purple">View All Packages</button>
  </div>
</div>

<script>
  document.getElementById('viewAllBtn').addEventListener('click', function() {
    document.querySelectorAll('.extra-package').forEach(function(card) {
      card.classList.remove('d-none');
    });
    this.style.display = 'none'; // hide button after expanding
  });
</script>



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
