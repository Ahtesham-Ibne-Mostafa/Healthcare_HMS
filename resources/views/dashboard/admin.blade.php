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
            background-color: #003366 !important;
        }
        .dashboard-title {
            color: #003366;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }
        .dashboard-card {
            background-color: #003366;
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
            color: #ffcc00;
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

    <!-- Admin Info Card -->
    <div class="admin-info-card">
        <h4 class="fw-bold mb-2">{{ Auth::user()->name }}</h4>
        <p class="mb-1">Role: Administrator</p>
        <p class="mb-1">Email: {{ Auth::user()->email }}</p>
    </div>

    <!-- Dashboard Content -->
    <div class="container">
        <h1 class="dashboard-title">Admin Dashboard</h1>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            
            <!-- Pending Accounts Card -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">⏳</div>
                    <h5 class="card-title">Pending Accounts</h5>
                    <p class="card-text">Review new registrations and assign roles.</p>
                    <!-- Button triggers modal -->
                    <button class="btn btn-outline-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#pendingModal">
                        Review Accounts
                    </button>
                </div>
            </div>



            <!-- Manage Patients -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">🧑‍⚕️</div>
                    <h5 class="card-title">Manage Patients</h5>
                    <p class="card-text">Remove, or edit patient information.</p>
                    <button class="btn btn-outline-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#patientsModal">
                        Manage Patients
                    </button>
                </div>
            </div>

            <!-- Manage Doctors -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">👨‍⚕️</div>
                    <h5 class="card-title">Manage Doctors</h5>
                    <p class="card-text">Remove, or edit doctor information.</p>
                    <button class="btn btn-outline-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#doctorsModal">
                        Manage Doctors
                    </button>
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

    

    <!-- Pending Accounts Modal -->
<div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- modal-lg makes it wider -->
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="pendingModalLabel">Pending Accounts</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th><th>Email</th><th>Phone</th><th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pendingUsers as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                  <form method="POST" action="{{ route('admin.approve', $user->id) }}">
                    @csrf
                    <button name="role" value="doctor" class="btn btn-success btn-sm">Approve as Doctor</button>
                    <button name="role" value="patient" class="btn btn-info btn-sm">Approve as Patient</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Patients Modal -->
<div class="modal fade" id="patientsModal" tabindex="-1" aria-labelledby="patientsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="patientsModalLabel">Manage Patients</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        <table class="table table-striped">
          <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr></thead>
          <tbody>
            @foreach($patients as $patient)
              <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->email }}</td>
                <td>{{ $patient->phone }}</td>
                <td>
                  <form method="POST" action="{{ route('admin.editPatient', $patient->id) }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                  </form>
                  <form method="POST" action="{{ route('admin.deletePatient', $patient->id) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<!-- Doctors Modal -->
<div class="modal fade" id="doctorsModal" tabindex="-1" aria-labelledby="doctorsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="doctorsModalLabel">Manage Doctors</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        <table class="table table-striped">
          <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr></thead>
          <tbody>
            @foreach($doctors as $doctor)
              <tr>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->email }}</td>
                <td>{{ $doctor->phone }}</td>
                <td>
                  <form method="POST" action="{{ route('admin.editDoctor', $doctor->id) }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                  </form>
                  <form method="POST" action="{{ route('admin.deleteDoctor', $doctor->id) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
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
function togglePending() {
    const section = document.getElementById('pendingSection');
    section.style.display = (section.style.display === 'none') ? 'block' : 'none';
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@if(session('openModal') === 'patients')
<script>
    var myModal = new bootstrap.Modal(document.getElementById('patientsModal'));
    myModal.show();
</script>
@endif

@if(session('openModal') === 'doctors')
<script>
    var myModal = new bootstrap.Modal(document.getElementById('doctorsModal'));
    myModal.show();
</script>
@endif

@if(session('openModal') === 'pending')
<script>
    var myModal = new bootstrap.Modal(document.getElementById('pendingModal'));
    myModal.show();
</script>
@endif



</body>
</html>
