<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// routes/web.php


Route::middleware(['auth'])->group(function () {
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect('/admin-dashboard');
        } elseif ($user->hasRole('doctor')) {
            return redirect('/doctor-dashboard');
        } else {
            return redirect('/patient-dashboard');
        }
    }

    // Guest users see the hospital homepage
    return view('home');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/patient-dashboard', function () {
        return view('dashboard.patient');
    });

    Route::get('/doctor-dashboard', function () {
        return view('dashboard.doctor');
    });

    Route::get('/admin-dashboard', function () {
        return view('dashboard.admin');
    });
});

