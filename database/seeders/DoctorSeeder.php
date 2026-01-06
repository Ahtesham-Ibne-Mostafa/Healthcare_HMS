<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch all users with role 'doctor'
        $doctorUsers = User::where('role', 'doctor')->get();

        foreach ($doctorUsers as $user) {
            // Only create if not already exists
            Doctor::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'specialization' => $user->specialization ?? 'General',
                    'qualifications' => $user->qualifications ?? null,
                    'license_number' => $user->license_number ?? null,
                    'years_experience' => $user->years_experience ?? null,
                ]
            );
        }
    }
}
