<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Patient Dashboard | Sunrise Medical Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .navbar {
      background-color: #003366 !important; /* deep blue */
    }
    .dashboard-title {
      color: #003366;
      font-weight: bold;
    }
    .card {
      transition: transform 0.2s, box-shadow 0.2s;
      cursor: pointer;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    .card-icon {
      font-size: 2rem;
      color: #003366;
    }
    .sidebar {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .profile-pic {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #003366;
    }
    .sidebar p {
    margin-bottom: 0.5rem;
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
.dashboard-card {
  background-color: #003366; /* deep blue */
  color: white;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  transition: transform 0.2s, box-shadow 0.2s;
}
.dashboard-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.2);
}
.card-icon {
  font-size: 2rem;
  margin-bottom: 10px;
  color: #ffcc00; /* gold accent for icons */
}
.card-title {
  font-weight: bold;
}
.card-text {
  font-size: 0.95rem;
}
.sidebar {
  background-color: #f8f9fa;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.profile-pic {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
}




  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">
        <img src="{{ asset('images/logo.jpg') }}" alt="Hospital Logo" style="max-height:30px;" class="me-2">
        Sunrise Medical Center
      </a>
      <form method="POST" action="{{ route('logout') }}" class="ms-auto">
        @csrf
        <button type="submit" class="btn btn-outline-light">Logout</button>
      </form>
    </div>
  </nav>

  <!-- Dashboard -->
  <div class="container-fluid">
  <div class="row">
    <!-- Sidebar Profile -->
    <div class="col-md-3">
      <div class="sidebar text-center p-4 mb-4">
        <!-- <img src="{{ Auth::user()->profile_picture 
                        ? asset('storage/'.Auth::user()->profile_picture) 
                        : asset('images/default-avatar.png') }}" 
            alt="Profile Picture" class="profile-pic"> -->

        <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
        <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
        <hr>

        @if(Auth::user()->blood_group)
            <p><strong>Blood Group:</strong> {{ Auth::user()->blood_group }}</p>
        @endif
        @if(Auth::user()->dob)
            <p><strong>DOB:</strong> {{ Auth::user()->dob }}</p>
        @endif
        @if(Auth::user()->gender)
            <p><strong>Gender:</strong> {{ Auth::user()->gender }}</p>
        @endif
        @if(Auth::user()->address)
            <p><strong>Address:</strong> {{ Auth::user()->address }}</p>
        @endif
        @if(Auth::user()->phone)
            <p><strong>Phone:</strong> {{ Auth::user()->phone }}</p>
        @endif
        @if(Auth::user()->emergency_contact)
            <p><strong>Emergency Contact:</strong> {{ Auth::user()->emergency_contact }}</p>
        @endif
        @if(Auth::user()->insurance_provider || Auth::user()->policy_number)
            <p><strong>Insurance:</strong> {{ Auth::user()->insurance_provider }}
            @if(Auth::user()->policy_number) ({{ Auth::user()->policy_number }}) @endif
            </p>
        @endif

        <button class="btn btn-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#profileModal">
            Edit Profile
        </button>
        </div>

    </div>

 <!-- Dashboard Modules -->
    <div class="col-md-9">
      <h1 class="dashboard-title mb-4">Patient Dashboard</h1>
      <div class="row g-4">
        <!-- Appointments -->
        <div class="col-md-4">
          <div class="card h-100 dashboard-card text-center">
            <div class="card-body">
              <div class="card-icon mb-3">📅</div>
              <h5 class="card-title">Appointments</h5>
              <p class="card-text">Coming soon...</p>
            </div>
          </div>
        </div>
        <!-- Prescriptions -->
        <div class="col-md-4">
          <div class="card h-100 dashboard-card text-center">
            <div class="card-body">
              <div class="card-icon mb-3">💊</div>
              <h5 class="card-title">Prescriptions</h5>
              <p class="card-text">View and download prescriptions.</p>
            </div>
          </div>
        </div>
        <!-- Medical Records -->
        <div class="col-md-4">
          <div class="card h-100 dashboard-card text-center">
            <div class="card-body">
              <div class="card-icon mb-3">📄</div>
              <h5 class="card-title">Medical Records</h5>
              <p class="card-text">Access your reports and history.</p>
            </div>
          </div>
        </div>
        <!-- Online Consultation -->
        <div class="col-md-4">
          <div class="card h-100 dashboard-card text-center">
            <div class="card-body">
              <div class="card-icon mb-3">🩺</div>
              <h5 class="card-title">Online Consultation</h5>
              <p class="card-text">Chat or video call with doctors.</p>
            </div>
          </div>
        </div>
        <!-- Blood Donor System -->
        <div class="col-md-4">
          <div class="card h-100 dashboard-card text-center">
            <div class="card-body">
              <div class="card-icon mb-3">🩸</div>
              <h5 class="card-title">Blood Donor System</h5>
              <p class="card-text">Register or request emergency blood.</p>
            </div>
          </div>
        </div>
        <!-- AI Symptom Checker -->
        <div class="col-md-4">
          <div class="card h-100 dashboard-card text-center">
            <div class="card-body">
              <div class="card-icon mb-3">🤖</div>
              <h5 class="card-title">AI Symptom Checker</h5>
              <p class="card-text">Get quick health insights.</p>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>

  <!-- Profile Modal -->
  <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="profileModalLabel">Edit Profile</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Name & Email fetched from registration -->
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
            </div>
            <!-- Editable fields -->
            <div class="mb-3">
              <label class="form-label">Blood Group</label>
              <select class="form-select" name="blood_group">
                <option value="">-- Select Blood Group --</option>
                <option value="A+" {{ Auth::user()->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                <option value="A-" {{ Auth::user()->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                <option value="B+" {{ Auth::user()->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                <option value="B-" {{ Auth::user()->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                <option value="O+" {{ Auth::user()->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                <option value="O-" {{ Auth::user()->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                <option value="AB+" {{ Auth::user()->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                <option value="AB-" {{ Auth::user()->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
            </select>
            </div>
<!-- 
            <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" class="form-control" name="profile_picture">
            </div> -->

            <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="dob" value="{{ Auth::user()->dob }}">
            </div>

            <div class="mb-3">
            <label class="form-label">Gender</label>
            <select class="form-select" name="gender">
                <option value="Male" {{ Auth::user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ Auth::user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ Auth::user()->gender == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            </div>

            <div class="mb-3">
            <label class="form-label">Emergency Contact</label>
            <input type="text" class="form-control" name="emergency_contact" value="{{ Auth::user()->emergency_contact }}">
            </div>

            <div class="mb-3">
            <label class="form-label">Insurance Provider</label>
            <input type="text" class="form-control" name="insurance_provider" value="{{ Auth::user()->insurance_provider }}">
            </div>

            <div class="mb-3">
            <label class="form-label">Policy Number</label>
            <input type="text" class="form-control" name="policy_number" value="{{ Auth::user()->policy_number }}">
            </div>

            <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
            </div>
            <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>


        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


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

</body>
</html>
