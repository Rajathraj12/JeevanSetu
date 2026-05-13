<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find or create a patient user
        $user = User::where('email', 'patient@jeevansetu.com')->first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'John Doe',
                'email' => 'patient@jeevansetu.com',
                'password' => bcrypt('password'),
                'role' => 'patient'
            ]);
        }

        // Upcoming Appointments
        Appointment::create([
            'user_id' => $user->id,
            'doctor_name' => 'Dr. Ananya Sharma',
            'specialty' => 'Cardiology',
            'status' => 'Confirmed',
            'appointment_date' => '2023-10-24',
            'appointment_time' => '10:30:00',
            'location' => 'City Heart Institute, Block A, Room 302',
        ]);

        Appointment::create([
            'user_id' => $user->id,
            'doctor_name' => 'Dr. Vikram Singh',
            'specialty' => 'General Practice',
            'status' => 'Pending',
            'appointment_date' => '2023-11-02',
            'appointment_time' => '14:15:00',
            'location' => 'Wellness Clinic, First Floor',
        ]);

        // Past Appointments
        Appointment::create([
            'user_id' => $user->id,
            'doctor_name' => 'Dr. Priya Patel',
            'specialty' => 'Dermatology',
            'status' => 'Completed',
            'appointment_date' => '2023-09-15',
            'appointment_time' => '09:00:00',
            'location' => 'Skin Care Clinic',
        ]);

        Appointment::create([
            'user_id' => $user->id,
            'doctor_name' => 'Dr. Rohan Mehta',
            'specialty' => 'Orthopedics',
            'status' => 'Completed',
            'appointment_date' => '2023-08-02',
            'appointment_time' => '11:30:00',
            'location' => 'Bone & Joint Center',
        ]);

        Appointment::create([
            'user_id' => $user->id,
            'doctor_name' => 'Dr. Ananya Sharma',
            'specialty' => 'Cardiology',
            'status' => 'Completed',
            'appointment_date' => '2023-06-20',
            'appointment_time' => '10:00:00',
            'location' => 'City Heart Institute, Block A, Room 302',
        ]);
    }
}
