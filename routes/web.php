<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DoctorSchedule;
use App\Http\Controllers\ProfileController;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Donor;
use App\Models\Prescription;
use App\Models\Booking;
use Illuminate\Support\Facades\Http;





Route::post('/ai-symptom-checker', function (Request $request) {
    $message = $request->input('message');

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('HF_API_KEY'),
    ])->post('https://api-inference.huggingface.co/models/facebook/blenderbot-400M-distill', [
        'inputs' => "User symptoms: $message. Provide general health info only, not diagnoses.",
    ]);

    if ($response->failed()) {
        return response()->json([
            'reply' => 'Error from Hugging Face: ' . $response->body()
        ], 500);
    }

    $reply = $response->json()[0]['generated_text'] ?? 'Sorry, no reply from AI.';

    return response()->json([
        'reply' => $reply
    ]);
});







Route::get('/admin/bookings/json', function () {
    return Booking::join('users', 'users.id', '=', 'bookings.patient_id')
        ->select(
            'bookings.id',
            'bookings.package_title',
            'bookings.package_price',
            'users.name as patient_name',
            'bookings.booking_date',
            'bookings.time_slot',
            'bookings.amount',
            'bookings.status',
            'bookings.created_at'
        )
        ->get();
});



Route::delete('/admin/bookings/{id}', function ($id) {
    $booking = Booking::findOrFail($id);
    $booking->delete();

    // No success message here
    return redirect('/admin-dashboard')
           ->with('openModal', 'bookings');
})->name('admin.bookings.delete');






// Registration
Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'phone' => 'nullable|string|max:20',
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'password' => Hash::make($validated['password']),
        'status' => 'pending',
        'role' => 'patient',
    ]);

    return redirect()->route('pending')->with('success', 'Account created. Please wait for admin confirmation.');
})->name('register');

// Profile update
Route::middleware(['auth'])->group(function () {
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Homepage redirect
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'doctor') {
            return redirect()->route('doctor.dashboard');
        } elseif ($user->role === 'patient') {
            return redirect()->route('patient.dashboard');
        }
    }

    return view('home'); // guest homepage
});

// Dashboards
Route::middleware(['auth'])->group(function () {
    // Patient dashboard: always load specializations; conditionally load doctors based on session
    Route::get('/patient-dashboard', function () {
        // Load all available specializations
        $specializations = \App\Models\Doctor::whereNotNull('specialization')
            ->distinct()
            ->pluck('specialization');

        // Check if a specialization was selected (stored in session)
        $selectedSpecialization = session('selected_specialization');
        $doctors = null;

        if ($selectedSpecialization) {
            $doctors = \App\Models\Doctor::where('specialization', $selectedSpecialization)
                ->with(['user', 'schedules'])
                ->get();
        }

        // Pass specialization name for Blade
        $specialization = $selectedSpecialization;

        return view('dashboard.patient', compact('specializations', 'doctors', 'specialization'));
    })->name('patient.dashboard');
});

    // Doctor dashboard: fetch schedules via Doctor profile (linked to user_id)



Route::get('/doctor-dashboard', function () {
    $doctor = Auth::user()->doctorProfile;

    if (!$doctor) {
        abort(403, 'Not a doctor account');
    }

    // Fetch all appointments for this doctor
    $appointments = Appointment::where('doctor_id', $doctor->id)
        ->with('patient')
        ->orderBy('date')
        ->get();

    // Extract unique patients from those appointments
    $patients = $appointments->pluck('patient')->unique('id');

    // Load schedules for the doctor and pass to the view
    $doctor->load('schedules');
    $schedules = $doctor->schedules;

    // Load prescriptions authored by this doctor
    $prescriptions = Prescription::where('doctor_id', $doctor->id)
        ->with('patient')
        ->orderByDesc('created_at')
        ->get();

    return view('dashboard.doctor', [
        'appointments' => $appointments,
        'patients'     => $patients,
        'doctor'       => $doctor,
        'schedules'    => $schedules,
        'prescriptions'=> $prescriptions,
    ]);
})->name('doctor.dashboard');

// Doctor: store a prescription for a patient
Route::post('/doctor/prescriptions', function (Request $request) {
    $request->validate([
        'patient_id' => 'required|exists:users,id',
        'content' => 'required|string',
    ]);

    $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();

    $prescription = Prescription::create([
        'doctor_id' => $doctor->id,
        'patient_id' => $request->patient_id,
        'content' => $request->content,
    ]);

    return back()->with(['success' => 'Prescription saved', 'openModal' => 'doctorPatientsModal']);
})->name('doctor.prescriptions.create')->middleware('auth');

// Patient: include prescriptions when rendering dashboard (already in patient dashboard closure)
Route::middleware(['auth'])->group(function () {
    // modify patient dashboard to include prescriptions for the authenticated patient
    Route::get('/patient-dashboard', function () {
        $specializations = \App\Models\Doctor::whereNotNull('specialization')
            ->distinct()
            ->pluck('specialization');

        $selectedSpecialization = session('selected_specialization');
        $doctors = null;

        if ($selectedSpecialization) {
            $doctors = \App\Models\Doctor::where('specialization', $selectedSpecialization)
                ->with(['user', 'schedules'])
                ->get();
        }

        $specialization = $selectedSpecialization;

        $prescriptions = Prescription::where('patient_id', Auth::id())
            ->with('doctor.user')
            ->orderByDesc('created_at')
            ->get();

        return view('dashboard.patient', compact('specializations', 'doctors', 'specialization', 'prescriptions'));
    })->name('patient.dashboard');
});



// Pending page
Route::get('/pending', function () {
    return view('auth.pending');
})->name('pending');

// Login
Route::post('/login', function (Request $request) {
    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();

        // Admin can always log in
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Block unapproved accounts
        if ($user->status !== 'approved') {
            Auth::logout();
            return redirect()->route('pending')
                ->with('error', 'Please be patient, your account is under construction.');
        }

        // Approved users go to their dashboard
        if ($user->role === 'doctor') {
            return redirect()->route('doctor.dashboard');
        } elseif ($user->role === 'patient') {
            return redirect()->route('patient.dashboard');
        }
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
})->name('login');

// Admin dashboard
Route::get('/admin-dashboard', function () {
    $pendingUsers = \App\Models\User::where('status', 'pending')
        ->where('role', 'patient')
        ->get();

    $patients = \App\Models\User::where('role', 'patient')->get();

    // ✅ Fetch doctors with their linked user info
    $doctors = \App\Models\Doctor::with('user')->get();

    return view('dashboard.admin', compact('pendingUsers','patients','doctors'));
})->name('admin.dashboard');

// Admin: bookings JSON for modal
Route::get('/admin/bookings-json', function () {
    $bookings = \App\Models\Booking::with('patient')->orderByDesc('created_at')->get();

    $payload = $bookings->map(function ($b) {
        return [
            'id' => $b->id,
            'package_title' => $b->package_title,
            'package_price' => $b->package_price,
            'patient' => [ 'id' => $b->patient->id, 'name' => $b->patient->name, 'email' => $b->patient->email ],
            'booking_date' => $b->booking_date,
            'time_slot' => $b->time_slot,
            'amount' => $b->amount,
            'status' => $b->status,
            'notes' => $b->notes,
            'created_at' => $b->created_at,
        ];
    });

    return response()->json(['count' => $payload->count(), 'data' => $payload]);
})->name('admin.bookings.json')->middleware('auth');

// Admin: delete booking
Route::delete('/admin/booking/{id}', function ($id) {
    $b = \App\Models\Booking::findOrFail($id);
    $b->delete();
    return response()->json(['success' => true]);
})->name('admin.booking.delete')->middleware('auth');

// Admin: update booking date/time
Route::post('/admin/booking/{id}/update', function (Request $request, $id) {
    $request->validate([
        'booking_date' => 'required|date',
        'time_slot' => 'required|string',
    ]);
    $b = \App\Models\Booking::findOrFail($id);
    $b->booking_date = $request->booking_date;
    $b->time_slot = $request->time_slot;
    $b->save();
    return response()->json(['success' => true, 'booking' => $b]);
})->name('admin.booking.update')->middleware('auth');

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DonorController;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Appointments
    Route::get('/appointments-json', [AppointmentController::class, 'indexJson'])
        ->name('appointments.json');

    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])
        ->name('appointments.delete');

    Route::post('/appointments/{id}/update', [AppointmentController::class, 'update'])
        ->name('appointments.update');

    // Donors
    Route::get('/donors-json', [DonorController::class, 'indexJson'])
        ->name('donors.json');

    Route::delete('/donors/{id}', [DonorController::class, 'destroy'])
        ->name('donors.delete');
});

// // Admin: List all appointments (JSON)
// Route::get('/admin/appointments-json', function () {
//     $appointments = \App\Models\Appointment::with(['patient','doctor.user'])->orderByDesc('date')->get();

//     $payload = $appointments->map(function ($a) {
//         return [
//             'id' => $a->id,
//             'doctor' => $a->doctor ? ($a->doctor->user->name ?? 'Dr') : null,
//             'doctor_id' => $a->doctor_id,
//             'patient' => $a->patient ? ['id'=>$a->patient->id,'name'=>$a->patient->name,'email'=>$a->patient->email] : null,
//             'date' => $a->date,
//             'time_slot' => $a->time_slot,
//             'status' => $a->status,
//             'created_at' => $a->created_at,
//         ];
//     });

//     return response()->json(['count'=>$payload->count(),'data'=>$payload]);
// })->name('admin.appointments.json')->middleware('auth');

// // Admin: delete appointment
// Route::delete('/admin/appointment/{id}', function ($id) {
//     $a = \App\Models\Appointment::findOrFail($id);
//     $a->delete();
//     return response()->json(['success'=>true]);
// })->name('admin.appointment.delete')->middleware('auth');

// // Admin: update appointment date/time
// Route::post('/admin/appointment/{id}/update', function (Request $request, $id) {
//     $request->validate([
//         'date' => 'required|date',
//         'time_slot' => 'required|string',
//     ]);
//     $a = \App\Models\Appointment::findOrFail($id);
//     $a->date = $request->date;
//     $a->time_slot = $request->time_slot;
//     $a->save();
//     return response()->json(['success'=>true,'appointment'=>$a]);
// })->name('admin.appointment.update')->middleware('auth');

// // Admin: donors list (JSON)
// Route::get('/admin/donors-json', function () {
//     $donors = \App\Models\Donor::orderByDesc('created_at')->get();
//     $payload = $donors->map(function($d){
//         return [
//             'id'=>$d->id,
//             'name'=>$d->name,
//             'email'=>$d->email,
//             'phone'=>$d->phone,
//             'blood_group'=>$d->blood_group,
//             'address'=>$d->address,
//             'status'=>$d->status,
//             'created_at'=>$d->created_at
//         ];
//     });
//     return response()->json(['count'=>$payload->count(),'data'=>$payload]);
// })->name('admin.donors.json')->middleware('auth');

// // Admin: delete donor
// Route::delete('/admin/donor/{id}', function ($id) {
//     $d = \App\Models\Donor::findOrFail($id);
//     $d->delete();
//     return response()->json(['success'=>true]);
// })->name('admin.donor.delete')->middleware('auth');


// Admin approval (pending accounts)
Route::post('/admin/approve/{id}', function ($id, Request $request) {
    $user = \App\Models\User::findOrFail($id);
    if ($request->role === 'patient') {
        $user->role = 'patient';
        $user->status = 'approved';
        $user->save();
    }
    return back()->with('success', 'User approved as patient');
})->name('admin.approve');

Route::delete('/admin/delete-user/{id}', function ($id) {
    \App\Models\User::findOrFail($id)->delete();
    return back()->with('success', 'User deleted successfully');
})->name('admin.deleteUser');


// Manage Patients
Route::post('/admin/patient/edit/{id}', function (Request $request, $id) {
    $patient = User::findOrFail($id);
    $patient->update($request->only('name','email','phone'));
    return redirect()->route('admin.dashboard')->with('openModal', 'patients');
})->name('admin.editPatient');

Route::delete('/admin/patient/delete/{id}', function ($id) {
    User::findOrFail($id)->delete();
    return redirect()->route('admin.dashboard')->with('openModal', 'patients');
})->name('admin.deletePatient');

// Add Doctor

use Illuminate\Support\Facades\Validator;

Route::post('/admin/doctor/add', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:20',
        'password' => 'required|string|min:6',
        'specialization' => 'required|string',
    ]);

    if ($validator->fails()) {
        return redirect()->route('admin.dashboard')
                         ->withErrors($validator)
                         ->withInput()
                         ->with('openModal', 'doctors');
    }

    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
        'role' => 'doctor',
        'status' => 'approved',
    ]);

    \App\Models\Doctor::create([
        'user_id' => $user->id,
        'specialization' => $request->specialization,
    ]);

    return redirect()->route('admin.dashboard')
                     ->with('openModal', 'doctors')
                     ->with('success', 'Doctor added successfully');
})->name('admin.addDoctor');

// Delete Doctor
Route::delete('/admin/doctor/delete/{id}', function ($id) {
    $doctor = \App\Models\Doctor::findOrFail($id);
    $doctor->delete();
    $doctor->user()->delete(); // also delete linked user

    return redirect()->route('admin.dashboard')->with('openModal', 'doctors')->with('success', 'Doctor deleted successfully');
})->name('admin.deleteDoctor');


// Doctor sets weekly schedule
Route::post('/doctor/schedule', function (Request $request) {
    $request->validate([
        'days'       => 'required|array',
        'start_time' => 'required',
        'end_time'   => 'required|after:start_time',
    ]);

    $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();

foreach ($request->days as $day) {
    \App\Models\DoctorSchedule::updateOrCreate(
        [
            'doctor_id'  => $doctor->id,   // ✅ doctor.id
            'day_of_week'=> $day,
        ],
        [
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
        ]
    );
}



    return back()->with([
    'success' => 'Schedule updated successfully',
    'openModal' => 'scheduleModal'   // ✅ tell Blade which modal to reopen
]);

})->name('doctor.schedule');

// Doctor deletes a schedule entry
Route::delete('/doctor/schedule/{id}', function ($id) {
    $doctorProfile = Doctor::where('user_id', Auth::id())->firstOrFail();

    DoctorSchedule::where('doctor_id', $doctorProfile->id)
        ->where('id', $id)
        ->delete();

    return redirect()->route('doctor.dashboard')->with([
        'success' => 'Schedule deleted successfully',
        'openModal' => 'schedule'
    ]);
})->name('doctor.schedule.delete');

// Patient searches doctors by specialization
Route::get('/search-doctors', function (Request $request) {
    $specialization = $request->specialization;

    $doctors = Doctor::where('specialization', $specialization)
                     ->with(['user','schedules'])
                     ->get();

    return view('search.doctors', compact('doctors', 'specialization'));
})->name('search.doctors');

// API: list specializations (JSON)
Route::get('/api/specializations', function () {
    $specs = \App\Models\Doctor::whereNotNull('specialization')
        ->distinct()
        ->pluck('specialization')
        ->values();

    return response()->json(['count' => $specs->count(), 'data' => $specs]);
})->name('api.specializations');

// API: doctors by specialization (JSON)
Route::get('/api/doctors/{specialization}', function ($specialization) {
    $doctors = \App\Models\Doctor::where('specialization', $specialization)
        ->with('user')
        ->get()
        ->map(function ($d) {
            return [
                'id' => $d->id,
                'name' => $d->user->name ?? null,
                'email' => $d->user->email ?? null,
                'phone' => $d->user->phone ?? null,
                'specialization' => $d->specialization,
            ];
        });

    return response()->json(['count' => $doctors->count(), 'data' => $doctors]);
})->name('api.doctors.bySpecialization');

// API: doctor slots for next 7 days
Route::get('/api/doctor/{id}/slots', function ($id) {
    $doctor = \App\Models\Doctor::with('schedules')->find($id);
    if (!$doctor) {
        return response()->json(['count' => 0, 'data' => []]);
    }

    $result = [];
    $today = \Carbon\Carbon::today();
    for ($i = 0; $i < 7; $i++) {
        $date = $today->copy()->addDays($i)->toDateString();
        $weekday = \Carbon\Carbon::parse($date)->format('l');
        $schedule = $doctor->schedules->firstWhere('day_of_week', $weekday);
        if (!$schedule) {
            $result[] = ['date' => $date, 'slots' => []];
            continue;
        }

        // generateSlots() assumed on DoctorSchedule model
        $slots = [];
        if (method_exists($schedule, 'generateSlots')) {
            $slots = $schedule->generateSlots();
        } else {
            $slots = [$schedule->start_time . ' - ' . $schedule->end_time];
        }

        // mark availability by checking appointments for the date and slot
        $availability = [];
        foreach ($slots as $slot) {
            $booked = \App\Models\Appointment::where('doctor_id', $doctor->id)
                ->where('date', $date)
                ->where('time_slot', $slot)
                ->count();
            $availability[] = ['time_slot' => $slot, 'available' => ($booked == 0)];
        }

        $result[] = ['date' => $date, 'slots' => $availability];
    }

    return response()->json(['count' => count($result), 'data' => $result]);
})->name('api.doctor.slots');

// Patient books appointment
Route::post('/book-appointment/{doctor_id}', function (Request $request, $doctor_id) {
    $request->validate([
        'date' => 'required|date',
        'specialization' => 'required|string',
    ]);

    $date = $request->date;
    $specialization = $request->specialization;

    $weekday = \Carbon\Carbon::parse($date)->format('l');
    $doctor = Doctor::findOrFail($doctor_id);
    $schedule = $doctor->schedules->firstWhere('day_of_week', $weekday);

    if(!$schedule){
        return redirect()->route('patient.dashboard')->with([
            'openModal' => 'patientAppointmentsModal',
            'error' => 'Doctor not available on this day',
            'selected_specialization' => $specialization,
        ]);
    }

    $slots = $schedule->generateSlots();
    $bookedCount = Appointment::where('doctor_id',$doctor->id)
        ->where('date',$date)
        ->count();

    $alreadyBooked = Appointment::where('doctor_id',$doctor->id)
        ->where('date',$date)
        ->where('patient_id', Auth::id())
        ->exists();

    if($alreadyBooked){
        return redirect()->route('patient.dashboard')->with([
            'openModal' => 'patientAppointmentsModal',
            'error' => 'You already booked this doctor on this day',
            'selected_specialization' => $specialization,
        ]);
    }

    if($bookedCount >= count($slots)){
        return redirect()->route('patient.dashboard')->with([
            'openModal' => 'patientAppointmentsModal',
            'error' => 'No slots available for this day',
            'selected_specialization' => $specialization,
        ]);
    }

    Appointment::create([
        'doctor_id'  => $doctor->id,   // ✅ doctor.id from doctors table
        'patient_id' => Auth::id(),
        'date'       => $date,
        'time_slot'  => $schedule->start_time . ' - ' . $schedule->end_time,
        'status'     => 'booked',
    ]);

    return redirect()->route('patient.dashboard')->with([
        'openModal' => 'patientAppointmentsModal',
        'success' => 'Appointment booked successfully',
        'selected_specialization' => $specialization,
    ]);
})->name('book.appointment');

// Patient: book a service/package (packages are defined in the patient view)
Route::post('/book-package', function (Request $request) {
    $request->validate([
        'package_title' => 'required|string',
        'package_price' => 'nullable|numeric',
        'booking_date'  => 'required|date',
    ]);

    $booking = \App\Models\Booking::create([
        'package_title' => $request->package_title,
        'package_price' => $request->package_price,
        'patient_id'    => Auth::id(),
        'booking_date'  => $request->booking_date,
        'time_slot'     => $request->time_slot,
        'amount'        => $request->package_price ?? null,
        'notes'         => $request->notes ?? null,
        'status'        => 'pending',
    ]);

    return redirect()->route('patient.dashboard')->with(['package_success' => 'Package booking created successfully', 'openModal' => 'bookPackageModal']);
})->name('book.package')->middleware('auth');


// List doctors by specialization
Route::get('/patient/doctors/{specialization}', function ($specialization) {
    $doctors = Doctor::with('user','schedules')
        ->where('specialization', $specialization)
        ->get();

    return back()->with([
        'doctors' => $doctors,
        'selected_specialization' => $specialization,
        'openModal' => 'patientAppointmentsModal'
    ]);
})->name('patient.doctors.bySpecialization');

// Admin adds doctor
Route::post('/admin/add-doctor', function (Request $request) {
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string',
        'password' => 'required|string|min:6',
        'specialization' => 'required|string',

        'status' => 'approved',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
        'role' => 'doctor',
        'status' => 'approved',
    ]);

    Doctor::create([
        'user_id' => $user->id,
        'specialization' => $request->specialization,
    ]);

    return back()->with('success', 'Doctor added successfully');
})->name('admin.addDoctor');


// Be a Donor (auto-register from patient profile)
Route::post('/donors/be', function () {
    $user = auth()->user();

    // Check if profile is complete
    if (!$user->address || !$user->blood_group) {
        return back()
            ->with('error', 'Please complete your profile (address & blood group) before registering as donor.')
            ->with('openModal', 'bloodDonorModal');
    }

    // Prevent duplicate donor entry
    if (Donor::where('user_id', $user->id)->exists()) {
        return back()
            ->with('info', 'You are already registered as a donor.')
            ->with('openModal', 'bloodDonorModal');
    }

    Donor::create([
        'user_id'     => $user->id,
        'name'        => $user->name,
        'email'       => $user->email,
        'phone'       => $user->phone,
        'address'     => $user->address,
        'blood_group' => $user->blood_group,
        'status'      => 'active',
    ]);

    return back()
        ->with('success', 'You are now registered as a donor!')
        ->with('openModal', 'bloodDonorModal');
})->name('donors.be');


// Search Donors (exclude self)

Route::get('/donors/search', function (Request $request) {
    $bloodGroup = $request->query('blood_group');

    $donors = Donor::where('blood_group', $bloodGroup)
        ->where('status', 'active')
        ->where('user_id', '!=', auth()->id())
        ->get();

    return redirect()->route('patient.dashboard', [
        'blood_group' => $bloodGroup
    ])->with([
        'donors' => $donors,
        'bloodGroup' => $bloodGroup,
        'openModal' => 'bloodDonorModal',
    ]);
})->name('donors.search');




// Remove Donorship
Route::delete('/donors/remove', function () {
    $donor = Donor::where('user_id', auth()->id())->first();

    if ($donor) {
        $donor->delete();
        return back()
            ->with('success', 'You have removed your donor registration.')
            ->with('openModal', 'bloodDonorModal');
    }

    return back()
        ->with('error', 'You are not registered as a donor.')
        ->with('openModal', 'bloodDonorModal');
})->name('donors.remove');




Route::get('/doctor/appointments', function () {
    $doctor = Doctor::where('user_id', Auth::id())->with(['appointments.patient'])->firstOrFail();

    return back()->with([
        'appointments' => $doctor->appointments,
        'openModal' => 'appointmentsModal'
    ]);
})->name('doctor.appointments');

// API: Return appointments for a given doctor as JSON (used by AJAX)
Route::get('/doctor/{id}/appointments-json', function ($id) {
    // Try treating $id as a doctors.id first
    $appointments = App\Models\Appointment::where('doctor_id', $id)
        ->with('patient')
        ->orderBy('date')
        ->get();

    $doctorIdUsed = $id;

    // If none found, check if $id is a users.id and find doctor by user_id
    if ($appointments->isEmpty()) {
        $doctor = App\Models\Doctor::where('user_id', $id)->first();
        if ($doctor) {
            $doctorIdUsed = $doctor->id;
            $appointments = App\Models\Appointment::where('doctor_id', $doctorIdUsed)
                ->with('patient')
                ->orderBy('date')
                ->get();
        }
    }

    return response()->json([
        'doctor_id_used' => $doctorIdUsed,
        'count' => $appointments->count(),
        'data' => $appointments,
    ]);
})->name('doctor.appointments.json')->middleware('auth');

// API: Return unique patients for a given doctor as JSON (used by AJAX)
Route::get('/doctor/{id}/patients-json', function ($id) {
    // Resolve doctor id (accept doctor.id or user.id)
    $doctor = App\Models\Doctor::where('id', $id)->orWhere('user_id', $id)->first();
    if (!$doctor) {
        return response()->json(['count' => 0, 'data' => []]);
    }

    $appointments = App\Models\Appointment::where('doctor_id', $doctor->id)
        ->with('patient')
        ->get();

    // Extract unique patients
    $patients = $appointments->pluck('patient')->unique('id')->values();

    // Map to safe payload
    $payload = $patients->map(function ($p) {
        return [
            'id' => $p->id,
            'name' => $p->name,
            'email' => $p->email,
            'phone' => $p->phone,
            'address' => $p->address ?? null,
            'blood_group' => $p->blood_group ?? null,
            'dob' => $p->dob ?? null,
            'gender' => $p->gender ?? null,
            'emergency_contact' => $p->emergency_contact ?? null,
            'insurance_provider' => $p->insurance_provider ?? null,
            'policy_number' => $p->policy_number ?? null,
            'profile_picture' => $p->profile_picture ? asset('storage/' . $p->profile_picture) : null,
        ];
    });

    return response()->json([
        'doctor_id' => $doctor->id,
        'count' => $payload->count(),
        'data' => $payload,
    ]);
})->name('doctor.patients.json')->middleware('auth');


Route::get('/doctor/patients', function (Request $request) {
    // Find the doctor profile for the logged-in user
    $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();

    // Get all patients who booked this doctor
    $appointments = Appointment::where('doctor_id', $doctor->id)->with('patient')->get();

    // Extract unique patients
    $patients = $appointments->pluck('patient')->unique();

    // Apply search filter if provided
    if ($request->filled('search')) {
        $patients = $patients->filter(function ($patient) use ($request) {
            return stripos($patient->name, $request->search) !== false;
        });
    }

    return back()->with([
        'patients' => $patients,
        'openModal' => 'patientsModal'
    ]);
})->name('doctor.patients');

