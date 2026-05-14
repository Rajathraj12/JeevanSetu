<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hospital;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Seed all hospitals
        $this->call(HospitalSeeder::class);

        // 2. Seed demo patient users
        User::updateOrCreate(
            ['email' => 'patient@jeevansetu.com'],
            [
                'name'     => 'John Doe',
                'password' => Hash::make('password'),
                'role'     => 'patient',
            ]
        );

        User::updateOrCreate(
            ['email' => 'rajath@gmail.com'],
            [
                'name'     => 'Rajath',
                'password' => Hash::make('password'),
                'role'     => 'patient',
            ]
        );

        // 3. Seed hospital admin user linked to Max Hospital
        $maxHospital = Hospital::where('name', 'like', '%Max%')->first();
        if ($maxHospital) {
            User::updateOrCreate(
                ['email' => 'maxhealthcare@gmail.com'],
                [
                    'name'        => 'Max Admin',
                    'password'    => Hash::make('maxhealthcare'),
                    'role'        => 'admin',
                    'hospital_id' => $maxHospital->id,
                ]
            );
        }

        // 4. Seed appointments & medical records for demo patient
        $this->call(AppointmentSeeder::class);
        $this->call(MedicalRecordSeeder::class);
    }
}
