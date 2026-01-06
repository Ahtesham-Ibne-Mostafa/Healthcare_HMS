<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_title', 'package_price', 'patient_id', 'booking_date', 'time_slot', 'amount', 'status', 'notes'
    ];

// app/Models/Booking.php
public function patient()
{
    return $this->belongsTo(User::class, 'patient_id');
}
public function package()
{
    return $this->belongsTo(Package::class, 'package_id');
}

}
