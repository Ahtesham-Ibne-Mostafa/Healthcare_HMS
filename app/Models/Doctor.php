<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'qualifications',
        'license_number',
        'years_experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

// app/Models/Doctor.php
    public function schedules()
    {
        return $this->hasMany(\App\Models\DoctorSchedule::class, 'doctor_id');
    }


    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id')->with('patient');
    }

    public function patients()
    {
        return $this->appointments->pluck('patient')->unique();
    }
}

