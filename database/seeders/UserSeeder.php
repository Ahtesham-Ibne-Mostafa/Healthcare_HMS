<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        // Doctor user
        $doctor = User::create([
            'name' => 'Dr. Strange',
            'email' => 'doctor@example.com',
            'password' => bcrypt('password'),
        ]);
        $doctor->assignRole('doctor');

        // Patient user
        $patient = User::create([
            'name' => 'John Doe',
            'email' => 'patient@example.com',
            'password' => bcrypt('password'),
        ]);
        $patient->assignRole('patient');
    }
}
