<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\ProfileController;

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
    Route::get('/patient-dashboard', function () {
        return view('dashboard.patient');
    })->name('patient.dashboard');

    Route::get('/doctor-dashboard', function () {
        return view('dashboard.doctor');
    })->name('doctor.dashboard');

    // ✅ Only one admin-dashboard route, with patients & doctors included
    // Route::get('/admin-dashboard', function () {
    //     $pendingUsers = User::where('status', 'pending')->get();
    //     $patients = User::where('role', 'patient')->get();
    //     $doctors = User::where('role', 'doctor')->get();
    //     return view('dashboard.admin', compact('pendingUsers','patients','doctors'));
    // })->name('admin.dashboard');
});

// Pending page
Route::get('/pending', function () {
    return view('auth.pending');
})->name('pending');

// Login
Route::post('/login', function (Request $request) {
    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();

        // ✅ Admin can always log in
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 🚫 Block unapproved doctor/patient accounts
        if ($user->status !== 'approved') {
            Auth::logout();
            return redirect()->route('pending')
                ->with('error', 'Please be patient, your account is under construction.');
        }

        // ✅ Approved users go to their dashboard
        if ($user->role === 'doctor') {
            return redirect()->route('doctor.dashboard');
        } elseif ($user->role === 'patient') {
            return redirect()->route('patient.dashboard');
        }
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
})->name('login');

// Admin dashboard (single route, includes all data)
Route::get('/admin-dashboard', function () {
    $pendingUsers = User::where('status', 'pending')->get();
    $patients = User::where('role', 'patient')->get();
    $doctors = User::where('role', 'doctor')->get();
    return view('dashboard.admin', compact('pendingUsers','patients','doctors'));
})->name('admin.dashboard');


// Admin approval (pending accounts)
Route::post('/admin/approve/{id}', function (Request $request, $id) {
    $user = User::findOrFail($id);
    $user->role = $request->role; // doctor or patient
    $user->status = 'approved';
    $user->save();

    // ✅ Reopen pending accounts modal after action
    return redirect()->route('admin.dashboard')->with('openModal', 'pending');
})->name('admin.approve');


// Manage Patients (direct add/edit/delete → instantly approved)
Route::post('/admin/patient/add', function (Request $request) {
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'role' => 'patient',
        'status' => 'approved',   // ✅ directly approved
    ]);
    return redirect()->route('admin.dashboard')->with('openModal', 'patients');
})->name('admin.addPatient');



Route::post('/admin/patient/edit/{id}', function (Request $request, $id) {
    $patient = User::findOrFail($id);
    $patient->update($request->only('name','email','phone'));
    return redirect()->route('admin.dashboard')->with('openModal', 'patients');
})->name('admin.editPatient');

Route::delete('/admin/patient/delete/{id}', function ($id) {
    User::findOrFail($id)->delete();
    return redirect()->route('admin.dashboard')->with('openModal', 'patients');
})->name('admin.deletePatient');


// Manage Doctors (direct add/edit/delete → instantly approved)
Route::post('/admin/doctor/add', function (Request $request) {
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'role' => 'doctor',
        'status' => 'approved',   // ✅ directly approved
    ]);
    return redirect()->route('admin.dashboard')->with('openModal', 'doctors');
})->name('admin.addDoctor');


Route::post('/admin/doctor/edit/{id}', function (Request $request, $id) {
    $doctor = User::findOrFail($id);
    $doctor->update($request->only('name','email','phone'));
    return redirect()->route('admin.dashboard')->with('openModal', 'doctors');
})->name('admin.editDoctor');

Route::delete('/admin/doctor/delete/{id}', function ($id) {
    User::findOrFail($id)->delete();
    return redirect()->route('admin.dashboard')->with('openModal', 'doctors');
})->name('admin.deleteDoctor');



Route::get('/admin-dashboard', function () {
    $pendingUsers = User::where('status', 'pending')->get();
    $patients = User::where('role', 'patient')->get();
    $doctors = User::where('role', 'doctor')->get();
    return view('dashboard.admin', compact('pendingUsers','patients','doctors'));
})->name('admin.dashboard');
