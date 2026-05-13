<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalRecord;
use App\Models\User;

class MedicalRecordSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'patient@jeevansetu.com')->first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'John Doe',
                'email' => 'patient@jeevansetu.com',
                'password' => bcrypt('password'),
                'role' => 'patient'
            ]);
        }

        MedicalRecord::create([
            'user_id' => $user->id,
            'title' => 'Comprehensive Metabolic Panel',
            'type' => 'Lab Report',
            'status' => 'Normal',
            'record_date' => '2023-10-24',
            'doctor_name' => 'Dr. Sharma (Endocrinology)',
            'hospital_name' => 'City Health Clinic',
        ]);

        MedicalRecord::create([
            'user_id' => $user->id,
            'title' => 'Hypertension Medication Update',
            'type' => 'Prescription',
            'status' => null,
            'record_date' => '2023-09-12',
            'doctor_name' => 'Dr. Patel (Cardiology)',
            'hospital_name' => 'Metro Heart Institute',
        ]);

        MedicalRecord::create([
            'user_id' => $user->id,
            'title' => 'Post-Op Appendectomy Summary',
            'type' => 'Discharge Summary',
            'status' => 'Requires Follow-up',
            'record_date' => '2023-08-05',
            'doctor_name' => 'Dr. Singh (General Surgery)',
            'hospital_name' => 'Global Care Hospital',
        ]);

        MedicalRecord::create([
            'user_id' => $user->id,
            'title' => 'MRI Scan - Lumbar Spine',
            'type' => 'Imaging',
            'status' => null,
            'record_date' => '2023-05-20',
            'doctor_name' => 'Dr. Verma (Radiology)',
            'hospital_name' => 'Advanced Imaging Center',
        ]);
    }
}
