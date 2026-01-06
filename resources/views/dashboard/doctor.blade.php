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
    <p class="mb-1">
        Specialization:
        {{ Auth::user()->doctorProfile->specialization ?? 'General Physician' }}
    </p>
    <p class="mb-1">Email: {{ Auth::user()->email }}</p>
    <p class="mb-1">Phone: {{ Auth::user()->phone ?? 'N/A' }}</p>
</div>


    <!-- Dashboard Content -->
<div class="container">
    <div class="d-flex flex-wrap justify-content-center gap-4">
        <!-- My Schedule -->
        <div class="card text-center dashboard-card">
            <div class="card-body">
                <div class="card-icon">⏰</div>
                <h5 class="card-title">My Schedule</h5>
                <p class="card-text">Set your weekly availability for appointments.</p>
                <button class="btn btn-outline-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#scheduleModal">
                    Manage Schedule
                </button>
            </div>
        </div>
        @php
            $doctor = Auth::user()->doctorProfile;
        @endphp

        <!-- My Patients Card -->
        <div class="card text-center dashboard-card">
        <div class="card-body">
            <div class="card-icon">👩‍⚕️</div>
            <h5 class="card-title">My Patients</h5>
            <p class="card-text">List of all the patients who booked you.</p>

            <!-- Button to open modal -->
            <button class="btn btn-outline-light btn-sm mt-2" id="openPatientsBtn" data-doctor-id="{{ $doctor->id }}">
            View Patients
            </button>
        </div>
        </div>

        <!-- Appointments Card -->
        <div class="card text-center dashboard-card">
        <div class="card-body">
            <div class="card-icon">📅</div>
            <h5 class="card-title">Appointments</h5>
            <p class="card-text">View all your booked appointments.</p>

            <!-- Button to open modal -->
            <button class="btn btn-outline-light btn-sm mt-2" id="openAppointmentsBtn" data-doctor-id="{{ $doctor->id }}">
            View Appointments
            </button>
        </div>
        </div>







        <!-- Prescriptions -->
        <div class="card text-center dashboard-card">
          <div class="card-body">
            <div class="card-icon">💊</div>
            <h5 class="card-title">Prescriptions</h5>
            <p class="card-text">Prescriptions you’ve issued will be displayed here.</p>
            <button type="button" class="btn btn-outline-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#viewAppointmentsModal">View Prescriptions</button>
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

<!-- View Appointments Modal -->
<div class="modal fade" id="viewAppointmentsModal" tabindex="-1" aria-labelledby="viewAppointmentsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="viewAppointmentsModalLabel">Prescriptions</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <h5>Prescriptions Issued</h5>
        <ul class="list-group">
          @forelse($prescriptions as $pres)
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div>
                <div class="fw-semibold">Patient: {{ $pres->patient->name ?? 'Unknown' }}</div>
                <div class="small text-muted">{{ $pres->created_at->format('d M Y H:i') }}</div>
              </div>
              <div>
                <button class="btn btn-sm btn-outline-primary view-prescription" data-pres='@json(["content" => $pres->content, "patient" => $pres->patient->name ?? ""])'>View</button>
              </div>
            </li>
          @empty
            <li class="list-group-item">No prescriptions yet.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Show Prescription Modal -->
<div class="modal fade" id="showPrescriptionModal" tabindex="-1" aria-labelledby="showPrescriptionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title" id="showPrescriptionModalLabel">Prescription</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="showPrescriptionBody">
        <div class="text-center">Select a prescription to view.</div>
      </div>
    </div>
  </div>
</div>


<!-- Schedule Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="scheduleModalLabel">Set Weekly Availability</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('doctor.schedule') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Select Days:</label><br>
            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="days[]" value="{{ $day }}">
                <label class="form-check-label">{{ $day }}</label>
              </div>
            @endforeach
          </div>

          <div class="row mb-3">
            <div class="col">
              <label class="form-label">Start Time</label>
              <input type="time" name="start_time" class="form-control" required>
            </div>
            <div class="col">
              <label class="form-label">End Time</label>
              <input type="time" name="end_time" class="form-control" required>
            </div>
          </div>

          <button type="submit" class="btn btn-success">Save Schedule</button>
        </form>

        <!-- Show current schedule -->
        <h3 class="mt-4">Your Current Weekly Schedule</h3>
        <table class="table table-striped">
        <thead>
            <tr><th>Day</th><th>Start</th><th>End</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($schedules as $schedule)
            <tr>
                <td>{{ $schedule->day_of_week }}</td>
                <td>{{ $schedule->start_time }}</td>
                <td>{{ $schedule->end_time }}</td>
                <td>
                <form method="POST" action="{{ route('doctor.schedule.delete', $schedule->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4">No schedule set yet.</td></tr>
            @endforelse
        </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<!-- Appointments Modal -->
<div class="modal fade" id="appointmentsModal" tabindex="-1" aria-labelledby="appointmentsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="appointmentsModalLabel">My Appointments</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <h4>Upcoming Slots</h4>
        @foreach($schedules as $schedule)
          <h5>{{ $schedule->day_of_week }} ({{ $schedule->start_time }} - {{ $schedule->end_time }})</h5>
          <ul>
            @foreach($schedule->generateSlots() as $slot)
              @php
                $appointment = \App\Models\Appointment::where('doctor_id', Auth::id())
                    ->where('date', now()->next($schedule->day_of_week)->toDateString())
                    ->where('time_slot', $slot)
                    ->first();
              @endphp
              @if($appointment)
                <li class="text-danger">{{ $slot }} - Booked by {{ $appointment->patient->name }}</li>
              @else
                <li class="text-success">{{ $slot }} - Available</li>
              @endif
            @endforeach
          </ul>
        @endforeach
      </div>
    </div>
  </div>
</div>

      <!-- Doctor Appointments (AJAX) Modal -->
      <div class="modal fade" id="doctorAppointmentsModal" tabindex="-1" aria-labelledby="doctorAppointmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="doctorAppointmentsModalLabel">Booked Appointments</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="doctorAppointmentsBody">
              <div class="text-center">Loading...</div>
            </div>
          </div>
        </div>
      </div>

<!-- patients modal --> 
<!-- patients modal (AJAX) -->
<div class="modal fade" id="doctorPatientsModal" tabindex="-1" aria-labelledby="doctorPatientsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="doctorPatientsModalLabel">My Patients</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="doctorPatientsBody">
        <div class="text-center">Loading...</div>
      </div>
    </div>
  </div>
</div>

<!-- Patient Details Modal -->
<div class="modal fade" id="patientDetailsModal" tabindex="-1" aria-labelledby="patientDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title" id="patientDetailsModalLabel">Patient Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="patientDetailsBody">
        <div class="text-center">Select a patient to view details.</div>
      </div>
    </div>
  </div>
</div>

      <!-- Prescription Modal (doctor writes) -->
      <div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" action="{{ route('doctor.prescriptions.create') }}">
              @csrf
              <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="prescriptionModalLabel">Write Prescription</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="patient_id" id="prescription_patient_id">
                <div class="mb-3">
                  <label class="form-label">Patient</label>
                  <input type="text" id="prescription_patient_name" class="form-control" disabled>
                </div>
                <div class="mb-3">
                  <label class="form-label">Prescription (raw text)</label>
                  <textarea name="content" id="prescription_content" class="form-control" rows="6" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Prescription</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>
            </form>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('openAppointmentsBtn');
    if (!btn) return;

    btn.addEventListener('click', function (e) {
      var doctorId = this.getAttribute('data-doctor-id');
      var modalEl = document.getElementById('doctorAppointmentsModal');
      var modal = new bootstrap.Modal(modalEl);
      var body = document.getElementById('doctorAppointmentsBody');

      body.innerHTML = '<div class="text-center">Loading...</div>';

      var url = '/doctor/' + doctorId + '/appointments-json';
      fetch(url, {
        credentials: 'same-origin',
        headers: { 'Accept': 'application/json' }
      })
      .then(function (res) {
        if (!res.ok) throw new Error('Network response was not ok: ' + res.status);
        var ct = res.headers.get('content-type') || '';
        if (ct.indexOf('application/json') === -1) {
          return res.text().then(function (text) {
            console.error('Expected JSON, got:', text);
            throw new Error('Invalid JSON response');
          });
        }
        return res.json();
      })
      .then(function (payload) {
        // payload may be an array (legacy) or an object with { data, count, doctor_id_used }
        var appointments = Array.isArray(payload) ? payload : (payload.data || []);

        if (!appointments || appointments.length === 0) {
          var info = '';
          if (payload && payload.doctor_id_used) {
            info = '<p class="small text-muted">(queried doctor id: ' + payload.doctor_id_used + ', found: ' + (payload.count || 0) + ')</p>';
          }
          body.innerHTML = '<p>No appointments found.</p>' + info;
          modal.show();
          return;
        }

        var list = document.createElement('ul');
        list.className = 'list-group';

        appointments.forEach(function (a) {
          var li = document.createElement('li');
          li.className = 'list-group-item';

          var date = new Date(a.date);
          var dateStr = isNaN(date.getTime()) ? a.date : date.toLocaleDateString(undefined, { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' });

          var patientName = (a.patient && a.patient.name) ? a.patient.name : 'Unknown Patient';

          li.textContent = dateStr + ' (' + (a.time_slot || '') + ') — Patient: ' + patientName + ' — Status: ' + (a.status || 'N/A');
          list.appendChild(li);
        });

        body.innerHTML = '';
        body.appendChild(list);
        modal.show();
      })
      .catch(function (err) {
        console.error(err);
        body.innerHTML = '<p class="text-danger">Failed to load appointments.</p>';
        modal.show();
      });
    });

    // Patients: open and fetch
    var pbtn = document.getElementById('openPatientsBtn');
    if (pbtn) {
      pbtn.addEventListener('click', function () {
        var doctorId = this.getAttribute('data-doctor-id');
        var modalEl = document.getElementById('doctorPatientsModal');
        var modal = new bootstrap.Modal(modalEl);
        var body = document.getElementById('doctorPatientsBody');
        body.innerHTML = '<div class="text-center">Loading...</div>';

        var url = '/doctor/' + doctorId + '/patients-json';
        fetch(url, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
          .then(function (res) { if (!res.ok) throw new Error(res.status); return res.json(); })
          .then(function (payload) {
            var patients = payload.data || [];
            if (!patients.length) {
              body.innerHTML = '<p>No patients found.</p><p class="small text-muted">(doctor id: ' + (payload.doctor_id||'') + ')</p>';
              modal.show();
              return;
            }

            var list = document.createElement('div');
            list.className = 'list-group';

            patients.forEach(function (p) {
              var item = document.createElement('div');
              item.className = 'list-group-item d-flex justify-content-between align-items-center';
              item.innerHTML = '<div><strong>' + (p.name||'') + '</strong><br><small>' + (p.email||'') + ' • ' + (p.phone||'') + '</small></div>';
              // View Details button
              var viewBtn = document.createElement('button');
              viewBtn.className = 'btn btn-sm btn-outline-primary me-2';
              viewBtn.textContent = 'View Details';
              viewBtn.setAttribute('data-patient', JSON.stringify(p));
              viewBtn.addEventListener('click', function () {
                var patient = JSON.parse(this.getAttribute('data-patient'));
                var detailsEl = document.getElementById('patientDetailsBody');
                var html = '<div class="text-center mb-3">';
                if (patient.profile_picture) html += '<img src="' + patient.profile_picture + '" class="img-fluid rounded-circle mb-2" style="max-width:90px;">';
                html += '</div>';
                html += '<p><strong>Name:</strong> ' + (patient.name||'') + '</p>';
                html += '<p><strong>Email:</strong> ' + (patient.email||'') + '</p>';
                html += '<p><strong>Phone:</strong> ' + (patient.phone||'') + '</p>';
                if (patient.address) html += '<p><strong>Address:</strong> ' + patient.address + '</p>';
                if (patient.blood_group) html += '<p><strong>Blood Group:</strong> ' + patient.blood_group + '</p>';
                if (patient.dob) html += '<p><strong>DOB:</strong> ' + patient.dob + '</p>';
                if (patient.gender) html += '<p><strong>Gender:</strong> ' + patient.gender + '</p>';
                if (patient.emergency_contact) html += '<p><strong>Emergency:</strong> ' + patient.emergency_contact + '</p>';
                if (patient.insurance_provider) html += '<p><strong>Insurance:</strong> ' + patient.insurance_provider + '</p>';
                detailsEl.innerHTML = html;
                var detailsModal = new bootstrap.Modal(document.getElementById('patientDetailsModal'));
                detailsModal.show();
              });
              item.appendChild(viewBtn);

              // Write Prescription button
              var writeBtn = document.createElement('button');
              writeBtn.className = 'btn btn-sm btn-success';
              writeBtn.textContent = 'Write Prescription';
              writeBtn.setAttribute('data-patient', JSON.stringify(p));
              writeBtn.addEventListener('click', function () {
                var patient = JSON.parse(this.getAttribute('data-patient'));
                // populate prescription modal
                var pid = document.getElementById('prescription_patient_id');
                var pname = document.getElementById('prescription_patient_name');
                var content = document.getElementById('prescription_content');
                pid.value = patient.id || '';
                pname.value = patient.name || '';
                content.value = '';
                var pm = new bootstrap.Modal(document.getElementById('prescriptionModal'));
                pm.show();
              });
              item.appendChild(writeBtn);
              list.appendChild(item);
            });

            body.innerHTML = '';
            body.appendChild(list);
            modal.show();
          })
          .catch(function (err) {
            console.error(err);
            body.innerHTML = '<p class="text-danger">Failed to load patients.</p>';
            modal.show();
          });
      });
    }

    // View prescription from list (delegated handler) — robust against text nodes
    document.body.addEventListener('click', function (e) {
      try {
        var el = e.target;
        while (el && el.nodeType !== 1) el = el.parentNode; // walk up to element node
        if (!el) return;
        var btn = el.closest ? el.closest('.view-prescription') : null;
        if (!btn) return;

        var presAttr = btn.getAttribute('data-pres');
        console.debug('view-prescription clicked', presAttr);

        var pres = { content: '', patient: '' };
        try { pres = JSON.parse(presAttr || '{}'); } catch (err) { pres.content = presAttr || ''; }

        var content = pres.content || '';
        var patient = pres.patient || '';
        var body = document.getElementById('showPrescriptionBody');
        var html = '<p><strong>Patient:</strong> ' + patient + '</p>';
        html += '<hr>';
        html += '<pre style="white-space:pre-wrap;">' + (content || '') + '</pre>';
        body.innerHTML = html;
        var modal = new bootstrap.Modal(document.getElementById('showPrescriptionModal'));
        modal.show();
      } catch (err) {
        console.error('Prescription view handler error', err);
      }
    });
  });
</script>
@if(session('openModal'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modalId = "{{ session('openModal') }}";
        var modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();
    });
</script>
@endif


</body>
</html>
