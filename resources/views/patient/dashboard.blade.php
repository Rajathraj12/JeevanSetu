@extends('layouts.app')
@section('title', 'Patient Dashboard - JeevanSetu')

@section('content')
@php
    $user = auth()->user();
    $patientName = $user ? $user->name : session('name', 'Patient');
    $firstName = explode(' ', trim($patientName))[0];
@endphp
<div class="flex flex-col gap-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Welcome Back, {{ ucfirst($firstName) }}!</h2>
            <p class="text-body-md text-on-surface-variant">Here is an overview of your health records and upcoming appointments.</p>
        </div>
    </div>

    <!-- Patient Metrics / Quick info -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm border-l-4 border-[#006b55] p-6 flex flex-col relative">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-body-md text-on-surface-variant font-medium">Active OPD Token</h3>
                <div class="p-2 bg-[#e5f6f2] rounded-full text-[#006b55]">
                    <span class="material-symbols-outlined">confirmation_number</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-display-lg font-bold text-on-surface">T-42</span>
            </div>
            <p class="text-sm font-medium text-slate-700 mt-2">Max Super Speciality Hospital</p>
            <p class="text-label-sm text-[#006b55] mt-1 font-bold flex items-center gap-1">
                <span class="material-symbols-outlined text-[14px]">schedule</span> Wait time: ~15 mins
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-blue-500 p-6 flex flex-col relative">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-body-md text-on-surface-variant font-medium">Current Status</h3>
                <div class="p-2 bg-blue-100 rounded-full text-blue-700">
                    <span class="material-symbols-outlined">health_and_safety</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-headline-sm font-bold text-on-surface">Not Admitted</span>
            </div>
            <p class="text-label-sm text-on-surface-variant mt-2">You have no active admissions in the JeevanSetu network.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-[#339780] p-6 flex flex-col relative">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-body-md text-on-surface-variant font-medium">Next Appointment</h3>
                <div class="p-2 bg-[#e5f6f2] rounded-full text-[#339780]">
                    <span class="material-symbols-outlined">calendar_today</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-headline-sm font-bold text-on-surface">Oct 24, 2026</span>
            </div>
            <p class="text-sm font-medium text-slate-700 mt-2">Apollo Hospital, Delhi</p>
            <p class="text-label-sm text-on-surface-variant mt-1 flex items-center gap-1">
                <span class="material-symbols-outlined text-[14px]">person</span> Dr. A. Sharma (Cardiology)
            </p>
        </div>
    </div>

    <!-- Patient Action Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 flex flex-col gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-6">
                <h3 class="text-headline-sm font-bold text-on-surface mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#006b55]">touch_app</span>
                    Quick Actions
                </h3>
                <div class="flex flex-col gap-4">
                    <a href="{{ route('appointments.create') }}" class="w-full bg-[#006b55] hover:bg-[#005644] text-white py-3 px-4 rounded-lg flex items-center justify-between transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined">calendar_add_on</span>
                            <span class="text-label-md font-bold">Book Appointment</span>
                        </div>
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="{{ route('medical-records') }}" class="w-full border-2 border-[#006b55] text-[#006b55] hover:bg-[#006b55] hover:text-white py-3 px-4 rounded-lg flex items-center justify-between transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined">description</span>
                            <span class="text-label-md font-bold">Medical Records</span>
                        </div>
                        <span class="material-symbols-outlined opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">arrow_forward</span>
                    </a>
                    <a href="{{ route('city-beds') }}" class="w-full bg-slate-50 hover:bg-slate-100 text-slate-700 py-3 px-4 rounded-lg flex items-center justify-between transition-colors border border-slate-200 group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-blue-600">ambulance</span>
                            <span class="text-label-md font-bold">Request Bed Transfer</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-6 h-full">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-headline-sm font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#339780]">medical_information</span>
                        Recent Prescriptions
                    </h3>
                    <button class="text-label-sm text-[#006b55] font-bold hover:underline cursor-pointer">View History</button>
                </div>
                
                <div class="flex flex-col divide-y divide-outline-variant/20">
                    <div class="py-4 flex items-start gap-4">
                        <div class="p-2 bg-blue-50 rounded-full text-blue-600 shrink-0 border border-blue-100">
                            <span class="material-symbols-outlined">medication</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between">
                                <p class="text-body-md font-bold text-on-surface">Amoxicillin 500mg</p>
                                <p class="text-label-sm text-slate-500">2 days ago</p>
                            </div>
                            <p class="text-sm text-on-surface-variant mt-1">Take 1 tablet every 8 hours for 7 days.</p>
                            <div class="flex items-center gap-2 mt-2">
                                <p class="text-xs text-[#006b55] font-bold">Dr. R. Gupta</p>
                                <span class="text-slate-300">•</span>
                                <p class="text-xs text-slate-500 font-medium">AIIMS Delhi</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-4 flex items-start gap-4">
                        <div class="p-2 bg-blue-50 rounded-full text-blue-600 shrink-0 border border-blue-100">
                            <span class="material-symbols-outlined">medication</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between">
                                <p class="text-body-md font-bold text-on-surface">Paracetamol 650mg</p>
                                <p class="text-label-sm text-slate-500">1 month ago</p>
                            </div>
                            <p class="text-sm text-on-surface-variant mt-1">Take 1 tablet when needed for fever or pain.</p>
                            <div class="flex items-center gap-2 mt-2">
                                <p class="text-xs text-[#006b55] font-bold">Dr. S. Patel</p>
                                <span class="text-slate-300">•</span>
                                <p class="text-xs text-slate-500 font-medium">Fortis Escorts</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
