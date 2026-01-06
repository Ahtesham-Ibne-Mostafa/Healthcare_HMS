<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function indexJson()
    {
        $appointments = Appointment::with(['patient', 'doctor.user'])
            ->orderByDesc('date')
            ->get();

        return response()->json([
            'count' => $appointments->count(),
            'data' => $appointments->map(function ($a) {
                return [
                    'id'        => $a->id,
                    'doctor'    => optional($a->doctor?->user)->name,
                    'doctor_id' => $a->doctor_id,
                    'patient'   => $a->patient ? [
                        'id'    => $a->patient->id,
                        'name'  => $a->patient->name,
                        'email' => $a->patient->email,
                    ] : null,
                    'date'      => $a->date,
                    'time_slot' => $a->time_slot,
                    'status'    => $a->status,
                    'created_at'=> $a->created_at,
                ];
            })
        ]);
    }

    public function destroy($id)
    {
        Appointment::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'date'      => ['required', 'date'],
            'time_slot' => ['required', 'string'],
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($data);

        return response()->json([
            'success' => true,
            'appointment' => $appointment
        ]);
    }
}
