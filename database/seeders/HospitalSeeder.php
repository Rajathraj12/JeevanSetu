<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing hospitals
        \App\Models\Hospital::query()->delete();
        
        // Handle Postgres identity reset if needed
        if (config('database.default') === 'pgsql') {
            \Illuminate\Support\Facades\DB::statement('ALTER SEQUENCE hospitals_id_seq RESTART WITH 1');
        }

        \App\Models\Hospital::insert([
            [
                'name' => 'AIIMS New Delhi',
                'type' => 'Government',
                'location' => 'Ansari Nagar, New Delhi',
                'distance' => 3.1,
                'general_beds_total' => 2500,
                'general_beds_available' => 345,
                'icu_beds_total' => 200,
                'icu_beds_available' => 12,
                'emergency_beds_total' => 250,
                'emergency_beds_available' => 28,
                'status' => 'Accepting',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Safdarjung Hospital',
                'type' => 'Government',
                'location' => 'Ring Road, New Delhi',
                'distance' => 2.4,
                'general_beds_total' => 1500,
                'general_beds_available' => 12,
                'icu_beds_total' => 100,
                'icu_beds_available' => 0,
                'emergency_beds_total' => 150,
                'emergency_beds_available' => 0,
                'status' => 'Full',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Max Super Speciality Hospital',
                'type' => 'Private',
                'location' => 'Saket, New Delhi',
                'distance' => 5.8,
                'general_beds_total' => 500,
                'general_beds_available' => 120,
                'icu_beds_total' => 80,
                'icu_beds_available' => 25,
                'emergency_beds_total' => 50,
                'emergency_beds_available' => 18,
                'status' => 'High Capacity',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Fortis Escorts Heart Institute',
                'type' => 'Private',
                'location' => 'Okhla Road, New Delhi',
                'distance' => 7.2,
                'general_beds_total' => 310,
                'general_beds_available' => 55,
                'icu_beds_total' => 90,
                'icu_beds_available' => 0,
                'emergency_beds_total' => 40,
                'emergency_beds_available' => 5,
                'status' => 'ICU Full',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Apollo Hospitals',
                'type' => 'Private',
                'location' => 'Sarita Vihar, New Delhi',
                'distance' => 8.5,
                'general_beds_total' => 700,
                'general_beds_available' => 200,
                'icu_beds_total' => 150,
                'icu_beds_available' => 50,
                'emergency_beds_total' => 100,
                'emergency_beds_available' => 45,
                'status' => 'High Capacity',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lok Nayak Hospital (LNJP)',
                'type' => 'Government',
                'location' => 'Jawaharlal Nehru Marg, New Delhi',
                'distance' => 4.2,
                'general_beds_total' => 2000,
                'general_beds_available' => 0,
                'icu_beds_total' => 120,
                'icu_beds_available' => 0,
                'emergency_beds_total' => 200,
                'emergency_beds_available' => 5,
                'status' => 'Critical',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sir Ganga Ram Hospital',
                'type' => 'Private',
                'location' => 'Rajinder Nagar, New Delhi',
                'distance' => 6.1,
                'general_beds_total' => 675,
                'general_beds_available' => 30,
                'icu_beds_total' => 110,
                'icu_beds_available' => 3,
                'emergency_beds_total' => 75,
                'emergency_beds_available' => 12,
                'status' => 'Accepting',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
