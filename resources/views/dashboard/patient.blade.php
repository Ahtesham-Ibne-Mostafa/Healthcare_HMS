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
            <p class="card-text">Manage your appointments.</p>
            <button class="btn btn-outline-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#patientAppointmentsModal">
              View / Book
            </button>
          </div>
        </div>
      </div>

        <!-- Prescriptions -->
        <div class="col-md-4">
          <div class="card h-100 dashboard-card text-center">
            <div class="card-body">
              <div class="card-icon mb-3">💊</div>
              <h5 class="card-title">Prescriptions</h5>
              <p class="card-text">View prescriptions sent by doctors.</p>
              <button class="btn btn-outline-light btn-sm mt-2" id="openMyPrescriptionsBtn">View Prescriptions</button>
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
              <button class="btn btn-outline-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#bloodDonorModal">
                Open
              </button>
            </div>
          </div>
        </div>

        <!-- AI Symptom Checker -->
        <!-- AI Symptom Checker Card -->
        <div class="col-md-4">
          <div class="card h-100 dashboard-card text-center" data-bs-toggle="modal" data-bs-target="#symptomCheckerModal">
            <div class="card-body">
              <div class="card-icon mb-3">🤖</div>
              <h5 class="card-title">AI Symptom Checker</h5>
              <p class="card-text">Get quick health insights.</p>
            </div>
          </div>
        </div>

        <!-- Chat Modal -->
        <div class="modal fade" id="symptomCheckerModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">AI Symptom Checker</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <div id="chatWindow" class="mb-3" style="height:300px; overflow-y:auto; border:1px solid #ddd; padding:10px;"></div>
                <div class="input-group">
                  <input type="text" id="symptomInput" class="form-control" placeholder="Describe your symptoms..." required>
                  <button class="btn btn-primary" type="button" id="askButton">Ask</button>
                </div>
              </div>

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

  <!-- Patient Prescriptions Modal -->
  <div class="modal fade" id="patientPrescriptionsModal" tabindex="-1" aria-labelledby="patientPrescriptionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="patientPrescriptionsModalLabel">Your Prescriptions</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="patientPrescriptionsBody">
          @if(isset($prescriptions) && $prescriptions->count())
            <ul class="list-group">
              @foreach($prescriptions as $pres)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <div class="small text-muted">{{ $pres->created_at->format('d M Y H:i') }}</div>
                    <strong>From: <a href="#" class="view-prescription-link" data-pres='@json($pres)'>Dr. {{ $pres->doctor->user->name ?? 'Unknown' }}</a></strong>
                  </div>
                </li>
              @endforeach
            </ul>
          @else
            <p>No prescriptions yet.</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- View Single Prescription Modal -->
  <div class="modal fade" id="viewPrescriptionModal" tabindex="-1" aria-labelledby="viewPrescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-white">
          <h5 class="modal-title" id="viewPrescriptionModalLabel">Prescription</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="viewPrescriptionBody">
          <div class="text-center">Select a prescription to view.</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var btn = document.getElementById('openMyPrescriptionsBtn');
      if (btn) {
        btn.addEventListener('click', function () {
          var modal = new bootstrap.Modal(document.getElementById('patientPrescriptionsModal'));
          modal.show();
        });
      }

      // Attach click handlers for view links
      document.querySelectorAll('.view-prescription-link').forEach(function (el) {
        el.addEventListener('click', function (e) {
          e.preventDefault();
          var pres = JSON.parse(this.getAttribute('data-pres'));
          var body = document.getElementById('viewPrescriptionBody');
          var html = '<p><strong>Doctor:</strong> ' + (pres.doctor && pres.doctor.user ? pres.doctor.user.name : 'Unknown') + '</p>';
          html += '<p class="small text-muted">' + (pres.created_at || '') + '</p>';
          html += '<hr>';
          html += '<pre style="white-space:pre-wrap;">' + (pres.content || '') + '</pre>';
          body.innerHTML = html;
          var vm = new bootstrap.Modal(document.getElementById('viewPrescriptionModal'));
          vm.show();
        });
      });
    });
  </script>


<!-- Health Check Packages Section -->
<div class="container mt-5 px-4">
  <h2 class="text-center mb-4" style="color:#003366;">Health Check Packages</h2>
  <div class="row g-4 justify-content-center">
    @php
      $packages = [
        ['title' => 'Executive Health Check', 'subtitle' => 'Male/Female', 'image' => 'executive.jpg', 'price' => 799.00, 'description' => 'Comprehensive executive screening including blood tests, ECG, and physician consult.'],
        ['title' => 'Heart Check', 'subtitle' => 'For Men', 'image' => 'heart-men.jpg', 'price' => 499.00, 'description' => 'Cardiac profile and ECG focused package for men.'],
        ['title' => 'Heart Check', 'subtitle' => 'For Women', 'image' => 'heart-women.jpg', 'price' => 499.00, 'description' => 'Cardiac profile and ECG focused package for women.'],
        ['title' => 'Whole Body Check', 'subtitle' => 'Men Above 45', 'image' => 'body-men-above.jpg', 'price' => 699.00, 'description' => 'Extended panels and imaging for men above 45.'],
        ['title' => 'Whole Body Check', 'subtitle' => 'Men Below 45', 'image' => 'body-men-below.jpg', 'price' => 599.00, 'description' => 'Comprehensive health checks for men below 45.'],
        ['title' => 'Whole Body Check', 'subtitle' => 'Women Above 45', 'image' => 'body-women-above.jpg', 'price' => 699.00, 'description' => 'Extended panels and imaging for women above 45.'],
        ['title' => 'Whole Body Check', 'subtitle' => 'Women Below 45', 'image' => 'body-women-below.jpg', 'price' => 599.00, 'description' => 'Comprehensive health checks for women below 45.'],
        ['title' => 'General Health Check', 'subtitle' => 'Male Below 40', 'image' => 'general-male.jpg', 'price' => 299.00, 'description' => 'Basic health screening package.'],
        // Extra packages (hidden initially)
        ['title' => 'Diabetes Care Package', 'subtitle' => '', 'image' => 'diabetes.jpg', 'price' => 249.00, 'description' => 'Glucose tolerance, HbA1c and dietician consult.'],
        ['title' => 'Cancer Screening Package', 'subtitle' => '', 'image' => 'cancer.jpg', 'price' => 999.00, 'description' => 'Comprehensive cancer screening panels and imaging.'],
        ['title' => 'Senior Citizen Health Package', 'subtitle' => '', 'image' => 'senior.jpg', 'price' => 549.00, 'description' => 'Tailored senior checks including bone profile and cardiac tests.'],
        ['title' => 'Women Wellness Package', 'subtitle' => '', 'image' => 'women-wellness.jpg', 'price' => 399.00, 'description' => 'Women-focused screening including gynecological tests.'],
      ];
    @endphp

    @foreach($packages as $index => $package)
      <div class="col-lg-3 col-md-4 col-sm-6 package-card {{ $index >= 8 ? 'd-none extra-package' : '' }}">
        <div class="card h-100 text-center shadow-sm package-card-bg">
          <div class="image-square mx-auto mt-3">
            <img src="{{ asset('images/packages/'.$package['image']) }}" alt="{{ $package['title'] }}">
          </div>
          <div class="card-body">
            <h6 class="card-title mb-1 text-white">{{ $package['title'] }}</h6>
            @if($package['subtitle'])
              <p class="text-light small mb-1">{{ $package['subtitle'] }}</p>
            @endif
            @if(!empty($package['description']))
              <p class="text-light small mb-1">{{ $package['description'] }}</p>
            @endif
            <p class="fw-bold text-white mb-2">Price: ৳{{ number_format($package['price'], 2) }}</p>
            <button class="btn btn-outline-light btn-sm mt-2 book-package-btn" 
                    data-package='@json($package)'>Book Package</button>
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

<!-- Book Package Modal -->
<div class="modal fade" id="bookPackageModal" tabindex="-1" aria-labelledby="bookPackageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ url('/book-package') }}">
        @csrf
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="bookPackageModalLabel">Book Package</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          @if(session('package_success'))
            <div class="alert alert-success">{{ session('package_success') }}</div>
          @endif
          <input type="hidden" name="package_title" id="bk_package_title">
          <input type="hidden" name="package_price" id="bk_package_price">

          <div class="mb-2">
            <label class="form-label">Package</label>
            <div id="bk_package_name" class="fw-bold"></div>
          </div>

          <div class="mb-2">
            <label class="form-label">Amount</label>
            <div id="bk_package_amount" class="fw-bold"></div>
          </div>

          <div class="mb-2">
            <label class="form-label">Preferred Date</label>
            <input type="date" name="booking_date" class="form-control" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Preferred Time (optional)</label>
            <input type="text" name="time_slot" class="form-control" placeholder="e.g. 10:00 - 11:00">
          </div>

          <div class="mb-2">
            <label class="form-label">Notes (optional)</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Confirm Booking</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.book-package-btn').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        const pkg = JSON.parse(this.getAttribute('data-package'));
        document.getElementById('bk_package_title').value = pkg.title;
        document.getElementById('bk_package_price').value = pkg.price;
        document.getElementById('bk_package_name').textContent = pkg.title;
        document.getElementById('bk_package_amount').textContent = '৳' + Number(pkg.price).toFixed(2);
        var modal = new bootstrap.Modal(document.getElementById('bookPackageModal'));
        modal.show();
      });
    });
  });
</script>


<!-- Patient Appointments Modal -->
<div class="modal fade" id="patientAppointmentsModal" tabindex="-1" aria-labelledby="patientAppointmentsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="patientAppointmentsModalLabel">My Appointments</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        {{-- Past appointments --}}
        <h4>Past Appointments</h4>
        <ul>
          @forelse(Auth::user()->appointments ?? [] as $appointment)
            <li>
              {{ \Carbon\Carbon::parse($appointment->date)->format('l, d M Y') }}
              ({{ $appointment->time_slot }})
              with Dr. {{ $appointment->doctor->user->name }}
            </li>
          @empty
            <li>No appointments yet.</li>
          @endforelse
        </ul>

        {{-- Specialization list --}}
        <h4 class="mt-4">Book New Appointment</h4>
        <p>Select a specialization to see available doctors:</p>
        <div class="d-flex flex-wrap gap-2 mb-3">
          @foreach($specializations as $spec)
            <form method="GET" action="{{ route('patient.doctors.bySpecialization', $spec) }}" class="d-inline">
              <button type="submit" class="btn btn-primary btn-sm mb-2">{{ $spec }}</button>
            </form>
          @endforeach
        </div>

        {{-- Doctors list --}}
        @if(session('doctors'))
          <h4>Doctors for {{ session('selected_specialization') }}</h4>

          @forelse(session('doctors') as $doctor)
            <div class="card mb-3">
              <div class="card-body">
                <h5>Dr. {{ $doctor->user->name }}</h5>
                <p>Email: {{ $doctor->user->email }} | Phone: {{ $doctor->user->phone }}</p>

                <ul>
                  @php
                    $days = collect(range(0,6))->map(fn($i) => now()->addDays($i));
                  @endphp

                  @foreach($days as $day)
                    @php
                      $weekday = $day->format('l');
                      $schedule = $doctor->schedules->firstWhere('day_of_week', $weekday);
                      $totalSlots = 0;
                      if($schedule){
                          $slots = $schedule->generateSlots();
                          $bookedCount = \App\Models\Appointment::where('doctor_id',$doctor->id)
                            ->where('date',$day->toDateString())
                            ->count();
                          $totalSlots = count($slots) - $bookedCount;
                      }
                    @endphp

                    <li>
                      {{ $day->format('l, d M Y') }}:
                      @if($schedule)
                        {{ $schedule->start_time }} - {{ $schedule->end_time }} |
                        {{ $totalSlots }} slots available
                        @if($totalSlots > 0)
                          <form method="POST" action="{{ route('book.appointment', $doctor->id) }}">
                            @csrf
                            <input type="hidden" name="date" value="{{ $day->toDateString() }}">
                            <input type="hidden" name="specialization" value="{{ session('selected_specialization') }}">
                            <button type="submit" class="btn btn-sm btn-primary">Confirm Booking</button>
                          </form>
                        @endif
                      @else
                        No schedule
                      @endif
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          @empty
            <p>No doctors found for specialization: {{ session('selected_specialization') }}</p>
          @endforelse
        @endif

        {{-- Feedback messages --}}
        @if(session('success'))
          <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

      </div>
    </div>
  </div>
</div>


<!-- Blood Donor Modal -->
<div class="modal fade" id="bloodDonorModal" tabindex="-1" aria-labelledby="bloodDonorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="bloodDonorModalLabel">Blood Donor System</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        {{-- Feedback messages INSIDE modal --}}
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Register as Donor -->
        <h5>Blood Donor Status</h5>

        @php
            $isDonor = \App\Models\Donor::where('user_id', auth()->id())->exists();
        @endphp

        @if(!$isDonor)
            {{-- Show Be a Donor button only if not already a donor --}}
            <form method="POST" action="{{ route('donors.be') }}">
                @csrf
                <button type="submit" class="btn btn-success">Be a Donor</button>
            </form>
        @else
            {{-- Show Remove Donorship button only if already a donor --}}
            <form method="POST" action="{{ route('donors.remove') }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2">Remove Donorship</button>
            </form>
        @endif


        <hr class="my-4">

        <!-- Search Donors -->
        <h5>Search Donors</h5>
        <form method="GET" action="{{ route('donors.search') }}">
          <div class="row">
            <div class="col-md-6">
              <select name="blood_group" class="form-select" required>
                @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $group)
                  <option value="{{ $group }}" {{ (session('bloodGroup') == $group) ? 'selected' : '' }}>
                    {{ $group }}
                  </option>
                @endforeach
              </select>

            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </div>
        </form>

        @if(session('donors'))
          <h6 class="mt-3">Available Donors for {{ session('bloodGroup') }}</h6>
          <table class="table table-striped">
            <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Address</th></tr></thead>
            <tbody>
              @forelse(session('donors') as $donor)
                <tr>
                  <td>{{ $donor->name }}</td>
                  <td>{{ $donor->email }}</td>
                  <td>{{ $donor->phone }}</td>
                  <td>{{ $donor->address }}</td>
                </tr>
              @empty
                <tr><td colspan="4">No donors found</td></tr>
              @endforelse
            </tbody>
          </table>
        @endif


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
    

{{-- Auto reopen modal after redirect --}}
@if(session('openModal'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modalId = @json(session('openModal'));
    const modalEl = document.getElementById(modalId);
    if (modalEl) {
      new bootstrap.Modal(modalEl).show();
    }
  });
</script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
  const chatWindow = document.getElementById('chatWindow');
  const askButton = document.getElementById('askButton');

  askButton.addEventListener('click', function() {
    const input = document.getElementById('symptomInput').value;
    if (!input) return;

    chatWindow.innerHTML += `<div><strong>You:</strong> ${input}</div>`;

    fetch('/ai-symptom-checker', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ message: input })
    })
    .then(res => {
      if (!res.ok) return res.text().then(text => { throw new Error(text) });
      return res.json();
    })
    .then(data => {
      chatWindow.innerHTML += `<div><strong>AI:</strong> ${data.reply}</div>`;
      chatWindow.scrollTop = chatWindow.scrollHeight;
    })
    .catch(err => {
      chatWindow.innerHTML += `<div><strong>Error:</strong> ${err}</div>`;
    });
  });
});
</script>



</body>
</html>
