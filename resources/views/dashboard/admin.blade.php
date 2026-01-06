<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <button class="btn btn-outline-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#appointmentsModal">Manage Appointments</button>
                </div>
            </div>

            <!-- Blood Donors -->
            <div class="card text-center dashboard-card">
                <div class="card-body">
                    <div class="card-icon">🩸</div>
                    <h5 class="card-title">Blood Donors</h5>
                    <p class="card-text">Add or remove blood donors.</p>
                <button class="btn btn-outline-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#donorsModal">Manage Donors</button>
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
                <button class="btn btn-outline-light btn-sm mt-2"
                  data-bs-toggle="modal"
                  data-bs-target="#bookingsModal">
                  Manage Bookings
                </button>

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

    <!-- Bookings Modal -->
<div class="modal fade" id="bookingsModal" tabindex="-1" aria-labelledby="bookingsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="bookingsModalLabel">Manage Bookings</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Patient</th>
              <th>Package</th>
              <th>Price</th>
              <th>Date</th>
              <th>Time Slot</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="bookingsTableBody">
            <!-- Rows injected by JavaScript -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const bookingsModal = document.getElementById('bookingsModal');
  const csrf = '{{ csrf_token() }}';

  function loadBookings() {
    fetch("{{ url('/admin/bookings/json') }}")
      .then(response => response.json())
      .then(data => {
        const tbody = document.getElementById('bookingsTableBody');
        tbody.innerHTML = "";

        data.forEach((booking, index) => {
          tbody.innerHTML += `
            <tr>
              <td>${index + 1}</td>
              <td>${booking.patient_name}</td>
              <td>${booking.package_title}</td>
              <td>${booking.package_price}</td>
              <td>${booking.booking_date}</td>
              <td>${booking.time_slot}</td>
              <td>${booking.status}</td>
              <td>
                <form method="POST" action="/admin/bookings/${booking.id}" style="display:inline;">
                  <input type="hidden" name="_token" value="${csrf}">
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          `;
        });
      })
      .catch(err => console.error("Error fetching bookings:", err));
  }

  // Load when modal is opened manually
  bookingsModal.addEventListener('show.bs.modal', loadBookings);

  // If modal is already open after redirect, load immediately
  if (bookingsModal.classList.contains('show')) {
    loadBookings();
  }
});
</script>








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
                  <form method="POST" action="{{ route('admin.approve', $user->id) }}" style="display:inline;">
                    @csrf
                    <button name="role" value="patient" class="btn btn-info btn-sm">Approve as Patient</button>
                  </form>

                  <form method="POST" action="{{ route('admin.deleteUser', $user->id) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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

  <!-- Add Doctor Button -->
<button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addDoctorForm">
  ➕ Add New Doctor
</button>

<!-- Add Doctor Form (hidden until button clicked) -->
<div class="collapse" id="addDoctorForm">
  <div class="card card-body">

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <form method="POST" action="{{ route('admin.addDoctor') }}">
      @csrf
      <div class="row mb-2">
        <div class="col-md-6">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-12">
          <label class="form-label">Specialization</label>
          <select name="specialization" class="form-select" required>
            <option value="">Select specialization</option>
            <option value="Medicine">Medicine</option>
            <option value="Cardiology">Cardiology</option>
            <option value="Neurology">Neurology</option>
            <option value="Orthopedics">Orthopedics</option>
            <option value="Pediatrics">Pediatrics</option>
            <option value="Oncologist">Oncologist</option>
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-primary mt-2">Save Doctor</button>
    </form>

  </div>
</div>

<hr class="my-4">

<!-- Existing Doctors Table -->
<h5 class="mb-3">Existing Doctors</h5>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Name</th><th>Email</th><th>Phone</th><th>Specialization</th><th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($doctors as $doctor)
      <tr>
        <td>{{ $doctor->user->name }}</td>
        <td>{{ $doctor->user->email }}</td>
        <td>{{ $doctor->user->phone }}</td>
        <td>{{ $doctor->specialization }}</td>
        <td>
          <form method="POST" action="{{ route('admin.deleteDoctor', $doctor->id) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@if(session('success') || session('error'))
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header {{ session('success') ? 'bg-success text-white' : 'bg-danger text-white' }}">
        <h5 class="modal-title">{{ session('success') ? 'Success' : 'Error' }}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>{{ session('success') ?? session('error') }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
  feedbackModal.show();
});
</script>
@endif


    

<!-- Appointments Modal -->
<div class="modal fade" id="appointmentsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Appointments</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" id="appointmentsModalBody">
        <div class="text-center py-3">Loading appointments...</div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const modalEl = document.getElementById('appointmentsModal');
  const bodyEl  = document.getElementById('appointmentsModalBody');

  modalEl.addEventListener('shown.bs.modal', loadAppointments);

  function loadAppointments() {
    bodyEl.innerHTML = '<div class="text-center py-3">Loading appointments...</div>';

    fetch('/admin/appointments-json', { credentials: 'same-origin' })
      .then(r => r.json())
      .then(res => {
        if (!res.data || res.data.length === 0) {
          bodyEl.innerHTML = '<div class="text-center">No appointments found</div>';
          return;
        }

        let html = `
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th>#</th>
                <th>Doctor</th>
                <th>Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
        `;

        res.data.forEach(a => {
          html += `
            <tr data-id="${a.id}">
              <td>${a.id}</td>
              <td>${a.doctor ?? 'N/A'}</td>
              <td>${a.patient?.name ?? 'Unknown'}</td>
              <td>${a.date ?? ''}</td>
              <td>${a.time_slot ?? ''}</td>
              <td>
                <button class="btn btn-sm btn-danger appt-delete" data-id="${a.id}">
                  Delete
                </button>
              </td>
            </tr>
          `;
        });

        html += '</tbody></table>';
        bodyEl.innerHTML = html;

        bodyEl.querySelectorAll('.appt-delete').forEach(btn => {
          btn.addEventListener('click', deleteAppointment);
        });
      })
      .catch(() => {
        bodyEl.innerHTML = '<div class="text-danger">Failed to load appointments</div>';
      });
  }

  function deleteAppointment(e) {
    const id = e.currentTarget.dataset.id;
    if (!confirm('Delete this appointment?')) return;

    fetch(`/admin/appointments/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      credentials: 'same-origin'
    })
    .then(r => r.json())
    .then(j => {
      if (j.success) {
        document.querySelector(`tr[data-id="${id}"]`)?.remove();
      } else {
        alert('Delete failed');
      }
    })
    .catch(() => alert('Delete failed'));
  }
});
</script>




<!-- Donors Modal -->
<div class="modal fade" id="donorsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Blood Donors</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" id="donorsModalBody">
        <div class="text-center py-3">Loading donors...</div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const modalEl = document.getElementById('donorsModal');
  const bodyEl  = document.getElementById('donorsModalBody');

  modalEl.addEventListener('shown.bs.modal', loadDonors);

  function loadDonors() {
    bodyEl.innerHTML = '<div class="text-center py-3">Loading donors...</div>';

    fetch('/admin/donors-json', { credentials: 'same-origin' })
      .then(r => r.json())
      .then(res => {
        if (!res.data || res.data.length === 0) {
          bodyEl.innerHTML = '<div class="text-center">No donors found</div>';
          return;
        }

        let html = `
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Blood Group</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
        `;

        res.data.forEach(d => {
          html += `
            <tr data-id="${d.id}">
              <td>${d.id}</td>
              <td>${d.name}</td>
              <td>${d.blood_group}</td>
              <td>${d.phone}</td>
              <td>
                <button class="btn btn-sm btn-danger donor-delete" data-id="${d.id}">
                  Delete
                </button>
              </td>
            </tr>
          `;
        });

        html += '</tbody></table>';
        bodyEl.innerHTML = html;

        bodyEl.querySelectorAll('.donor-delete').forEach(btn => {
          btn.addEventListener('click', deleteDonor);
        });
      })
      .catch(() => {
        bodyEl.innerHTML = '<div class="text-danger">Failed to load donors</div>';
      });
  }

  function deleteDonor(e) {
    const id = e.currentTarget.dataset.id;
    if (!confirm('Delete this donor?')) return;

    fetch(`/admin/donors/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      credentials: 'same-origin'
    })
    .then(r => r.json())
    .then(j => {
      if (j.success) {
        document.querySelector(`tr[data-id="${id}"]`)?.remove();
      } else {
        alert('Delete failed');
      }
    })
    .catch(() => alert('Delete failed'));
  }
});
</script>


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

@if(session('openModal') === 'bookings')
<script>
    var myModal = new bootstrap.Modal(document.getElementById('bookingsModal'));
    myModal.show();
</script>
@endif




</body>
</html>
