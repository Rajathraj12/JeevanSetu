@extends('layouts.app')
@section('title', 'Book Appointment - JeevanSetu')

@section('content')
<div class="flex flex-col gap-8 max-w-3xl mx-auto w-full">
    <div class="flex flex-col gap-2">
        <a href="{{ route('my-appointments') }}" class="text-secondary font-bold text-sm flex items-center gap-1.5 hover:underline w-fit mb-2">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Back to Appointments
        </a>
        <h2 class="text-headline-lg font-bold text-on-surface mb-1">Book New Appointment</h2>
        <p class="text-body-md text-on-surface-variant">Fill in the details below to schedule your visit.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-8">
        <form action="{{ route('appointments.store') }}" method="POST" class="flex flex-col gap-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Doctor Name -->
                <div class="flex flex-col gap-2">
                    <label for="doctor_name" class="text-label-md font-bold text-on-surface">Doctor Name</label>
                    <select name="doctor_name" id="doctor_name" class="w-full bg-surface-container-low border border-outline-variant/30 text-on-surface rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition-all" required>
                        <option value="" disabled selected>Select a Doctor</option>
                        <option value="Dr. Ananya Sharma">Dr. Ananya Sharma (Cardiology)</option>
                        <option value="Dr. Vikram Singh">Dr. Vikram Singh (General Practice)</option>
                        <option value="Dr. Priya Patel">Dr. Priya Patel (Dermatology)</option>
                        <option value="Dr. Rohan Mehta">Dr. Rohan Mehta (Orthopedics)</option>
                    </select>
                    @error('doctor_name')
                        <p class="text-error text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Specialty (Readonly, auto-filled basically or just let them choose) -->
                <div class="flex flex-col gap-2">
                    <label for="specialty" class="text-label-md font-bold text-on-surface">Specialty</label>
                    <select name="specialty" id="specialty" class="w-full bg-surface-container-low border border-outline-variant/30 text-on-surface rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition-all" required>
                        <option value="" disabled selected>Select Specialty</option>
                        <option value="Cardiology">Cardiology</option>
                        <option value="General Practice">General Practice</option>
                        <option value="Dermatology">Dermatology</option>
                        <option value="Orthopedics">Orthopedics</option>
                    </select>
                    @error('specialty')
                        <p class="text-error text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Appointment Date -->
                <div class="flex flex-col gap-2">
                    <label for="appointment_date" class="text-label-md font-bold text-on-surface">Preferred Date</label>
                    <input type="date" name="appointment_date" id="appointment_date" min="{{ date('Y-m-d') }}" class="w-full bg-surface-container-low border border-outline-variant/30 text-on-surface rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition-all" required>
                    @error('appointment_date')
                        <p class="text-error text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Appointment Time -->
                <div class="flex flex-col gap-2">
                    <label for="appointment_time" class="text-label-md font-bold text-on-surface">Preferred Time</label>
                    <input type="time" name="appointment_time" id="appointment_time" class="w-full bg-surface-container-low border border-outline-variant/30 text-on-surface rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition-all" required>
                    @error('appointment_time')
                        <p class="text-error text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div class="flex flex-col gap-2 md:col-span-2">
                    <label for="location" class="text-label-md font-bold text-on-surface">Clinic Location</label>
                    <select name="location" id="location" class="w-full bg-surface-container-low border border-outline-variant/30 text-on-surface rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition-all" required>
                        <option value="" disabled selected>Select Location</option>
                        <option value="City Heart Institute, Block A, Room 302">City Heart Institute, Block A, Room 302</option>
                        <option value="Wellness Clinic, First Floor">Wellness Clinic, First Floor</option>
                        <option value="Skin Care Clinic">Skin Care Clinic</option>
                        <option value="Bone & Joint Center">Bone & Joint Center</option>
                    </select>
                    @error('location')
                        <p class="text-error text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-4 pt-6 border-t border-outline-variant/30">
                <a href="{{ route('my-appointments') }}" class="px-6 py-3 border border-outline-variant text-on-surface font-bold rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-secondary text-white font-bold rounded-lg hover:bg-secondary/90 shadow-sm transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">calendar_add_on</span>
                    Confirm Booking
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
