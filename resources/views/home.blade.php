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
          <!-- Bigger square image -->
          <div class="image-square mx-auto mt-3">
            <img src="{{ asset('images/packages/'.$package['image']) }}" alt="{{ $package['title'] }}">
          </div>
                    <div class="card-body">
                        <h6 class="card-title mb-1 text-white">{{ $package['title'] }}</h6>
                        @if($package['subtitle'])
                            <p class="text-light small mb-2">{{ $package['subtitle'] }}</p>
                        @endif
                        <button class="btn btn-outline-light btn-sm mt-2 book-package-btn" data-package='@json($package)'>Book Package</button>
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

<!-- Guest Prompt Modal -->
<div class="modal fade" id="guestPromptModal" tabindex="-1" aria-labelledby="guestPromptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="guestPromptModalLabel">Please Sign In</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="guestPromptBody">
                <p>Please login or create an account to access this feature.</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Visitor Guide Modal -->
<div class="modal fade" id="visitorGuideModal" tabindex="-1" aria-labelledby="visitorGuideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="visitorGuideModalLabel">Visitor Guide</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Ground Floor:</strong> Dispensary, Reception, Patient Registration, Pharmacy.</p>
                <p><strong>First Floor:</strong> Outpatient Clinics, General Medicine, Pediatrics.</p>
                <p><strong>Second Floor:</strong> Cardiology, Cardiac Cath Lab, Cardiac OPD.</p>
                <p><strong>Third Floor:</strong> Neurology, Neurosurgery, EEG Lab.</p>
                <p><strong>Fourth Floor:</strong> Radiology, CT, MRI, Imaging Services.</p>
                <p><strong>Fifth Floor:</strong> Surgical Wards, Recovery, Minor OT.</p>
                <p class="mt-3">Follow signage inside the hospital or ask at Reception for directions. Visiting hours are 10:00–12:00 and 16:00–18:00.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Request Appointment Modal -->
<div class="modal fade" id="requestAppointmentModal" tabindex="-1" aria-labelledby="requestAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="requestAppointmentModalLabel">Request Appointment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="requestAppointmentBody">
                <div class="text-center">Loading...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

            <!-- Find Doctors Modal -->
            <div class="modal fade" id="findDoctorsModal" tabindex="-1" aria-labelledby="findDoctorsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="findDoctorsModalLabel">Find Doctors</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="findDoctorsBody">
                            <div class="text-center">Loading...</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const isAuth = {{ auth()->check() ? 'true' : 'false' }};

        function showGuestPromptWithMessage(html) {
            const body = document.getElementById('guestPromptBody');
            body.innerHTML = html || '<p>Please login or create an account to access this feature.</p>';
            // Hide any currently open modals so guest prompt appears on top
            document.querySelectorAll('.modal.show').forEach(function(m){
                try {
                    const inst = bootstrap.Modal.getInstance(m);
                    if (inst) inst.hide();
                    else {
                        // fallback: ensure it's hidden
                        m.classList.remove('show');
                        m.style.display = 'none';
                    }
                } catch(e) {
                    m.classList.remove('show');
                    m.style.display = 'none';
                }
            });
            // Remove any leftover modal backdrops
            document.querySelectorAll('.modal-backdrop').forEach(function(b){ b.remove(); });
            // Ensure the guest prompt modal is attached to body so its z-index is correct
            const gEl = document.getElementById('guestPromptModal');
            if (gEl.parentNode !== document.body) document.body.appendChild(gEl);
            new bootstrap.Modal(gEl).show();
        }

        // Quick links behavior
        document.querySelectorAll('.quick-links a').forEach(function (el) {
            el.addEventListener('click', function (e) {
                const text = this.textContent.trim().toLowerCase();
                if (text === 'visitor guide') {
                    e.preventDefault();
                    new bootstrap.Modal(document.getElementById('visitorGuideModal')).show();
                    return;
                }

                // Special handling: Find a Doctor should be available to guests
                if (text === 'find a doctor') {
                    e.preventDefault();
                    // open find doctors modal and load specializations
                    const fdModalEl = document.getElementById('findDoctorsModal');
                    const fdBody = document.getElementById('findDoctorsBody');
                    fdBody.innerHTML = '<div class="text-center">Loading...</div>';
                    fetch('{{ route('api.specializations') }}', { credentials: 'same-origin' })
                        .then(r => r.json())
                        .then(json => {
                            if(!json || !json.data) { fdBody.innerHTML = '<div>No specializations found.</div>'; return; }
                            let html = '<div class="list-group mb-3">';
                            json.data.forEach(function(spec){
                                html += '<button type="button" class="list-group-item list-group-item-action spec-btn" data-spec="'+spec+'">'+spec+'</button>';
                            });
                            html += '</div><div id="doctorsList"></div>';
                            fdBody.innerHTML = html;
                            // attach handlers
                            document.querySelectorAll('.spec-btn').forEach(function(b){
                                b.addEventListener('click', function(){
                                    const spec = this.getAttribute('data-spec');
                                    const doctorsList = document.getElementById('doctorsList');
                                    doctorsList.innerHTML = '<div class="text-center">Loading doctors for '+spec+'...</div>';
                                    fetch('/api/doctors/'+encodeURIComponent(spec), { credentials: 'same-origin' })
                                        .then(r => r.json())
                                        .then(dj => {
                                            if(!dj || !dj.data || dj.data.length === 0) { doctorsList.innerHTML = '<div>No doctors found for '+spec+'</div>'; return; }
                                            let dh = '<div class="row">';
                                            dj.data.forEach(function(doc){
                                                dh += '<div class="col-md-6"><div class="card mb-2"><div class="card-body">' +
                                                      '<h5 class="card-title">Dr. '+ (doc.name || 'Unknown') +'</h5>' +
                                                      '<p class="mb-1">Specialization: '+ (doc.specialization || '') +'</p>' +
                                                      '<p class="small text-muted">'+ (doc.email || '') + (doc.phone ? ' | '+doc.phone : '') +'</p>' +
                                                      '</div></div></div>';
                                            });
                                            dh += '</div>';
                                            doctorsList.innerHTML = dh;
                                        }).catch(()=>{ doctorsList.innerHTML = '<div class="text-danger">Error loading doctors</div>'; });
                                });
                            });
                        }).catch(()=>{ fdBody.innerHTML = '<div class="text-danger">Error loading specializations</div>'; });
                    new bootstrap.Modal(fdModalEl).show();
                    return;
                }

                // Request Appointment: show doctors and slots (guests see login prompt on booking)
                if (text === 'request appointment') {
                    e.preventDefault();
                    const raModalEl = document.getElementById('requestAppointmentModal');
                    const raBody = document.getElementById('requestAppointmentBody');
                    raBody.innerHTML = '<div class="text-center">Loading...</div>';
                    // load specializations first
                    fetch('{{ route('api.specializations') }}', { credentials: 'same-origin' })
                        .then(r => r.json())
                        .then(json => {
                            if(!json || !json.data) { raBody.innerHTML = '<div>No specializations found.</div>'; return; }
                            let html = '<div class="row"><div class="col-md-4"><div class="list-group">';
                            json.data.forEach(function(spec){
                                html += '<button type="button" class="list-group-item list-group-item-action ra-spec" data-spec="'+spec+'">'+spec+'</button>';
                            });
                            html += '</div></div><div class="col-md-8"><div id="raDoctorsArea">Select a specialization to load doctors</div></div></div>';
                            raBody.innerHTML = html;
                            document.querySelectorAll('.ra-spec').forEach(function(b){
                                b.addEventListener('click', function(){
                                    const spec = this.getAttribute('data-spec');
                                    const area = document.getElementById('raDoctorsArea');
                                    area.innerHTML = '<div class="text-center">Loading doctors for '+spec+'...</div>';
                                    fetch('/api/doctors/'+encodeURIComponent(spec), { credentials: 'same-origin' })
                                        .then(r => r.json())
                                        .then(dj => {
                                            if(!dj || !dj.data || dj.data.length === 0) { area.innerHTML = '<div>No doctors found for '+spec+'</div>'; return; }
                                            let dh = '';
                                            dj.data.forEach(function(doc){
                                                dh += '<div class="card mb-2"><div class="card-body">' +
                                                      '<h5 class="card-title">Dr. '+ (doc.name || 'Unknown') +'</h5>' +
                                                      '<p class="mb-1">'+ (doc.email ? doc.email : '') + (doc.phone ? ' | '+doc.phone : '') +'</p>' +
                                                      '<div><button class="btn btn-sm btn-outline-primary ra-view-slots" data-doc="'+doc.id+'">View Slots</button></div>' +
                                                      '<div class="mt-2 ra-slots-area" id="ra-slots-'+doc.id+'"></div>' +
                                                      '</div></div>';
                                            });
                                            area.innerHTML = dh;
                                            // attach view slots handlers
                                            document.querySelectorAll('.ra-view-slots').forEach(function(sbtn){
                                                sbtn.addEventListener('click', function(){
                                                    const docId = this.getAttribute('data-doc');
                                                    const slotsArea = document.getElementById('ra-slots-'+docId);
                                                    slotsArea.innerHTML = '<div class="small text-muted">Loading slots...</div>';
                                                    fetch('/api/doctor/'+docId+'/slots', { credentials: 'same-origin' })
                                                        .then(r => r.json())
                                                        .then(sj => {
                                                            if(!sj || !sj.data) { slotsArea.innerHTML = '<div>No slots available</div>'; return; }
                                                            let sh = '';
                                                            sj.data.forEach(function(day){
                                                                sh += '<div class="mb-2"><strong>'+day.date+':</strong> ';
                                                                if(day.slots.length === 0) { sh += '<span class="text-muted">No schedule</span>'; }
                                                                day.slots.forEach(function(slot){
                                                                    const btn = '<button class="btn btn-sm btn-outline-success ra-book-slot ms-2" data-doc="'+docId+'" data-date="'+day.date+'" data-slot="'+slot.time_slot+'">'+slot.time_slot+' '+(slot.available? '': '(booked)')+'</button>';
                                                                    sh += btn;
                                                                });
                                                                sh += '</div>';
                                                            });
                                                            slotsArea.innerHTML = sh;
                                                            // attach book slot handlers
                                                            slotsArea.querySelectorAll('.ra-book-slot').forEach(function(bk){
                                                                bk.addEventListener('click', function(e){
                                                                    const docId = this.getAttribute('data-doc');
                                                                    const date = this.getAttribute('data-date');
                                                                    const slot = this.getAttribute('data-slot');
                                                                    if (!isAuth) {
                                                                        // show guest prompt (use helper to ensure it appears on top)
                                                                        e.preventDefault();
                                                                        showGuestPromptWithMessage('<p>Please login or register to book an appointment for '+date+' '+slot+'</p>');
                                                                        return;
                                                                    }
                                                                    // Authenticated: redirect to patient dashboard (they can book there)
                                                                    window.location.href = '/patient-dashboard';
                                                                });
                                                            });
                                                        }).catch(()=>{ slotsArea.innerHTML = '<div class="text-danger">Error loading slots</div>'; });
                                                });
                                            });
                                        }).catch(()=>{ area.innerHTML = '<div class="text-danger">Error loading doctors</div>'; });
                                });
                            });
                        }).catch(()=>{ raBody.innerHTML = '<div class="text-danger">Error loading specializations</div>'; });
                    new bootstrap.Modal(raModalEl).show();
                    return;
                }

                        // For other quick actions require auth
                        if (!isAuth) {
                            e.preventDefault();
                            if (text === 'find a doctor') {
                                showGuestPromptWithMessage('<p>Please login or register to find doctors and view their specializations.</p>');
                            } else if (text === 'request appointment') {
                                showGuestPromptWithMessage('<p>Please login or register to request appointments and view doctor slots.</p>');
                            } else if (text === 'online report') {
                                showGuestPromptWithMessage('<p>Please login or register to access your online reports.</p>');
                            } else if (text === 'telemedicine') {
                                showGuestPromptWithMessage('<p>Please login or register to request telemedicine consultations.</p>');
                            } else {
                                showGuestPromptWithMessage();
                            }
                        } else {
                    // Authenticated: redirect to patient dashboard where functionality exists
                    // Map quick actions to patient-dashboard for now
                    if (text === 'find a doctor' || text === 'request appointment' || text === 'online report' || text === 'telemedicine') {
                        // allow the user to manage these from their dashboard
                        // redirect to patient dashboard
                        window.location.href = '/patient-dashboard';
                    }
                }
            });
        });
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

<!-- Bootstrap JS (required for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Guest Book Package Modal (moved to end of body) -->
<div class="modal fade" id="guestBookPackageModal" tabindex="-1" aria-labelledby="guestBookPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="guestBookPackageModalLabel">Book Package</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="guest_pkg_info">
                    <h5 id="guest_pkg_title"></h5>
                    <p id="guest_pkg_subtitle" class="small text-muted"></p>
                    <p id="guest_pkg_description"></p>
                    <p class="fw-bold">Price: ৳<span id="guest_pkg_price"></span></p>
                </div>
                <div class="alert alert-info mt-3">
                    Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">create an account</a> to complete package bookings.
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('login') }}" class="btn btn-primary">Login to Book</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.book-package-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                var pkg = JSON.parse(this.getAttribute('data-package'));
                document.getElementById('guest_pkg_title').textContent = pkg.title || '';
                document.getElementById('guest_pkg_subtitle').textContent = pkg.subtitle || '';
                document.getElementById('guest_pkg_description').textContent = pkg.description || '';
                document.getElementById('guest_pkg_price').textContent = (pkg.price ? Number(pkg.price).toFixed(2) : '---');
                var modal = new bootstrap.Modal(document.getElementById('guestBookPackageModal'));
                modal.show();
            });
        });
    });
</script>

</body>
</html>
