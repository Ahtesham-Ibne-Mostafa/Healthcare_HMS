<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    public function doctor()
{
    return $this->belongsTo(Doctor::class, 'doctor_id');
}


    /**
     * Generate slots for this schedule.
     * Each hour = 3 patients (20 minutes each).
     */
    public function generateSlots()
    {
        $slots = [];
        $start = strtotime($this->start_time);
        $end   = strtotime($this->end_time);

        while ($start < $end) {
            // 3 slots per hour = 20 minutes each
            for ($i = 0; $i < 3; $i++) {
                $slotTime = date('H:i', $start + ($i * 20 * 60));
                $slots[] = $slotTime;
            }
            $start += 3600; // move to next hour
        }

        return $slots;
    }


}
