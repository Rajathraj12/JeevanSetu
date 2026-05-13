@extends('layouts.app')
@section('title', 'OPD Queue - JeevanSetu')

@section('content')
@php
    $user = auth()->user();
    $patientName = $user ? $user->name : session('name', 'Patient');
@endphp

<div class="flex flex-col gap-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
        <div>
            <h2 class="text-headline-sm font-bold text-slate-800 mb-1">OPD Token Status</h2>
            <p class="text-sm text-slate-500">Track your appointment progress in real-time.</p>
        </div>
        <div class="text-sm text-slate-500 flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">sync</span>
            Last updated: Just now (10:42 AM)
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            
            <!-- Active Token Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden relative border-l-4 border-l-blue-500">
                <!-- Decorative background shape -->
                <div class="absolute right-0 top-0 w-48 h-full bg-secondary/10 rounded-l-full -mr-16 pointer-events-none"></div>
                
                <div class="p-6 relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span class="inline-block bg-teal-100 text-teal-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-2">Active Token</span>
                            <h3 class="text-6xl font-display font-bold text-slate-800">#1042</h3>
                        </div>
                        <div class="text-secondary opacity-80 mt-2">
                            <span class="material-symbols-outlined text-4xl">local_activity</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Queue Position</p>
                            <p class="text-blue-600 font-medium text-sm">3 people ahead</p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Est. Wait Time</p>
                            <p class="text-secondary font-medium text-sm">~12 minutes</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Consultation Journey Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden border-l-4 border-l-secondary p-6">
                <h4 class="text-sm font-medium text-slate-800 mb-8">Consultation Journey</h4>
                
                <div class="relative flex justify-between items-center px-4">
                    <!-- Connecting Lines -->
                    <div class="absolute left-8 right-8 top-1/2 -translate-y-1/2 h-1 bg-slate-100 -z-10"></div>
                    <div class="absolute left-8 w-1/3 top-1/2 -translate-y-1/2 h-1 bg-secondary-fixed -z-10"></div>

                    <!-- Step 1: Checked-in -->
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-secondary text-white flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-[16px] font-bold">check</span>
                        </div>
                        <div class="text-center">
                            <p class="text-xs font-bold text-slate-800">Checked-in</p>
                            <p class="text-[10px] text-slate-500">10:15 AM</p>
                        </div>
                    </div>

                    <!-- Step 2: Waiting -->
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-teal-50 text-secondary flex items-center justify-center border-2 border-white shadow-sm ring-4 ring-secondary/10">
                            <span class="material-symbols-outlined text-[18px]">hourglass_empty</span>
                        </div>
                        <div class="text-center">
                            <p class="text-xs font-bold text-slate-800">Waiting</p>
                            <p class="text-[10px] text-secondary font-medium">In Progress</p>
                        </div>
                    </div>

                    <!-- Step 3: Called -->
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center border-2 border-white shadow-sm">
                            <span class="material-symbols-outlined text-[16px]">campaign</span>
                        </div>
                        <div class="text-center">
                            <p class="text-xs font-medium text-slate-400">Called</p>
                        </div>
                    </div>

                    <!-- Step 4: In Consultation -->
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center border-2 border-white shadow-sm">
                            <span class="material-symbols-outlined text-[16px]">stethoscope</span>
                        </div>
                        <div class="text-center">
                            <p class="text-xs font-medium text-slate-400">In Consultation</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                        <span class="material-symbols-outlined text-[24px]">group</span>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Dept. Load</p>
                        <p class="text-sm font-bold text-slate-800 mt-0.5">Moderate Traffic</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                        <span class="material-symbols-outlined text-[24px]">weekend</span>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Waiting Area</p>
                        <p class="text-sm font-bold text-slate-800 mt-0.5">Area B - 2nd Floor</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column -->
        <div class="lg:col-span-1 flex flex-col gap-4">
            
            <!-- Doctor Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h4 class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-4">Consulting Doctor</h4>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-xl bg-blue-50 overflow-hidden shrink-0 border border-blue-100">
                        <img src="https://ui-avatars.com/api/?name=Arvind+Mehra&background=e0f2fe&color=0369a1&size=100" alt="Doctor" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Dr. Arvind Mehra</p>
                        <p class="text-xs text-blue-600 mt-0.5 font-medium">Cardiology Specialist</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">Room Number</span>
                        <span class="bg-slate-100 text-slate-800 font-bold px-2 py-1 rounded">OPD-204</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">Availability</span>
                        <span class="font-bold text-slate-800 flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-secondary inline-block"></span> Online</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <button class="w-full bg-[#006b55] hover:bg-[#005644] text-white font-bold py-3.5 px-4 rounded-xl transition-colors flex items-center justify-center gap-2 text-sm">
                <span class="material-symbols-outlined text-[20px]">view_list</span> View Live Wait Board
            </button>

            <a href="#" class="text-center text-xs font-medium text-blue-600 hover:text-blue-700 mt-2 block">
                <span class="material-symbols-outlined text-[14px] align-middle mr-1">help</span>Need Help? Contact Front Desk
            </a>

            <!-- Info Box -->
            <div class="bg-blue-50 rounded-xl p-5 mt-2 border border-blue-100/50">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-blue-600 text-[20px]">info</span>
                    <div>
                        <p class="text-sm font-bold text-slate-800 mb-1">Did you know?</p>
                        <p class="text-xs text-blue-800 leading-relaxed">Please keep your vitals report ready before entering the consultation room for a faster experience.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
