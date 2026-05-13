@extends('layouts.app')
@section('title', $hospital->name . ' - Details')

@section('content')
<div class="flex flex-col gap-6 max-w-6xl mx-auto w-full">
    <!-- Breadcrumb & Header -->
    <div class="flex flex-col gap-4">
        <a href="{{ route('city-beds') }}" class="text-secondary font-bold text-sm flex items-center gap-1.5 hover:underline w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Back to City Beds
        </a>
    </div>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl shadow-lg p-8 md:p-10 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 opacity-10 pointer-events-none">
            <span class="material-symbols-outlined text-[250px]">local_hospital</span>
        </div>
        <div class="relative z-10 flex flex-col md:flex-row gap-6 items-start md:items-center">
            <div class="w-20 h-20 bg-white rounded-2xl shadow-md flex items-center justify-center text-secondary shrink-0">
                <span class="material-symbols-outlined text-4xl">domain</span>
            </div>
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="bg-white/20 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-sm">{{ $hospital->type }} Hospital</span>
                    <span class="flex items-center gap-1 text-amber-400 text-sm font-bold">
                        <span class="material-symbols-outlined text-[16px]">star</span> 4.8
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold font-serif mb-2">{{ $hospital->name }}</h2>
                <p class="text-slate-300 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    {{ $hospital->location }} <span class="mx-2">•</span> <span class="font-bold text-secondary-fixed">{{ $hospital->distance }} km away</span>
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Info & Specialties -->
        <div class="lg:col-span-2 flex flex-col gap-8">
            <!-- About -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
                <h3 class="text-xl font-bold text-slate-900 mb-4 font-serif">About {{ $hospital->name }}</h3>
                <p class="text-slate-600 leading-relaxed">
                    {{ $hospital->name }} is a premier {{ strtolower($hospital->type) }} healthcare institution dedicated to providing world-class medical services. Equipped with state-of-the-art technology and a team of internationally trained specialists, the facility ensures comprehensive care across multiple disciplines. From advanced diagnostics to complex surgical interventions, patient safety and clinical excellence remain at the core of our operations.
                </p>
            </div>

            <!-- Centers of Excellence -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
                <h3 class="text-xl font-bold text-slate-900 mb-6 font-serif">Centers of Excellence</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="p-4 bg-red-50 rounded-xl text-center border border-red-100 hover:shadow-md transition-shadow">
                        <span class="material-symbols-outlined text-3xl text-red-500 mb-2">favorite</span>
                        <h4 class="font-bold text-slate-800 text-sm">Cardiology</h4>
                    </div>
                    <div class="p-4 bg-blue-50 rounded-xl text-center border border-blue-100 hover:shadow-md transition-shadow">
                        <span class="material-symbols-outlined text-3xl text-blue-500 mb-2">psychology</span>
                        <h4 class="font-bold text-slate-800 text-sm">Neurology</h4>
                    </div>
                    <div class="p-4 bg-purple-50 rounded-xl text-center border border-purple-100 hover:shadow-md transition-shadow">
                        <span class="material-symbols-outlined text-3xl text-purple-500 mb-2">ribbon</span>
                        <h4 class="font-bold text-slate-800 text-sm">Oncology</h4>
                    </div>
                    <div class="p-4 bg-teal-50 rounded-xl text-center border border-teal-100 hover:shadow-md transition-shadow">
                        <span class="material-symbols-outlined text-3xl text-teal-500 mb-2">accessible</span>
                        <h4 class="font-bold text-slate-800 text-sm">Orthopedics</h4>
                    </div>
                </div>
            </div>

            <!-- Top Specialists -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
                <h3 class="text-xl font-bold text-slate-900 mb-6 font-serif">Top Specialists</h3>
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-4 p-4 border border-slate-100 rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold text-xl shrink-0">DR</div>
                        <div>
                            <h4 class="font-bold text-slate-900">Dr. Rajiv Sharma</h4>
                            <p class="text-sm text-secondary font-medium">Head of Cardiology</p>
                            <p class="text-xs text-slate-500 mt-1">20+ Years Experience</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 border border-slate-100 rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold text-xl shrink-0">SM</div>
                        <div>
                            <h4 class="font-bold text-slate-900">Dr. Sneha Mehta</h4>
                            <p class="text-sm text-secondary font-medium">Senior Neurosurgeon</p>
                            <p class="text-xs text-slate-500 mt-1">15+ Years Experience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Booking & Capacity -->
        <div class="lg:col-span-1 flex flex-col gap-6">
            <!-- Capacity Card -->
            <div class="bg-white rounded-xl shadow-sm border-t-4 border-t-secondary border-x border-b border-slate-200 p-6 sticky top-24">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-900 font-serif">Live Capacity</h3>
                    <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-xs font-bold">{{ $hospital->status }}</span>
                </div>

                <div class="flex flex-col gap-4 mb-8">
                    <!-- ICU -->
                    <div class="flex justify-between items-center p-3 {{ $hospital->icu_beds_available == 0 ? 'bg-red-50 border-red-100' : 'bg-slate-50 border-slate-100' }} border rounded-lg">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase">ICU Beds</p>
                            <p class="text-2xl font-bold {{ $hospital->icu_beds_available == 0 ? 'text-red-600' : 'text-slate-900' }}">{{ $hospital->icu_beds_available }}</p>
                        </div>
                        <div class="text-right">
                            <span class="material-symbols-outlined {{ $hospital->icu_beds_available == 0 ? 'text-red-400' : 'text-slate-400' }} text-3xl">monitor_heart</span>
                        </div>
                    </div>

                    <!-- Emergency -->
                    <div class="flex justify-between items-center p-3 bg-slate-50 border border-slate-100 rounded-lg">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase">Emergency</p>
                            <p class="text-2xl font-bold text-secondary">{{ $hospital->emergency_beds_available }}</p>
                        </div>
                        <div class="text-right">
                            <span class="material-symbols-outlined text-secondary/50 text-3xl">emergency</span>
                        </div>
                    </div>

                    <!-- General -->
                    <div class="flex justify-between items-center p-3 bg-slate-50 border border-slate-100 rounded-lg">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase">General Ward</p>
                            <p class="text-2xl font-bold text-slate-900">{{ $hospital->general_beds_available }}</p>
                        </div>
                        <div class="text-right">
                            <span class="material-symbols-outlined text-slate-400 text-3xl">bed</span>
                        </div>
                    </div>
                </div>

                <!-- Booking Action -->
                @if($hospital->icu_beds_available > 0 || $hospital->general_beds_available > 0 || $hospital->emergency_beds_available > 0)
                <form action="{{ route('hospital.book-bed', $hospital->id) }}" method="POST" class="flex flex-col gap-3">
                    @csrf
                    <label class="text-sm font-bold text-slate-700">Select Requirement</label>
                    <select name="bed_type" class="w-full bg-slate-50 border border-slate-200 text-slate-700 px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                        @if($hospital->icu_beds_available > 0) <option value="ICU">ICU Bed (Critical)</option> @endif
                        @if($hospital->emergency_beds_available > 0) <option value="Emergency">Emergency Room</option> @endif
                        @if($hospital->general_beds_available > 0) <option value="General">General Ward</option> @endif
                    </select>
                    <button type="submit" class="w-full bg-secondary text-white py-3.5 rounded-xl font-bold shadow-md shadow-secondary/30 hover:bg-secondary/90 transition-all flex items-center justify-center gap-2 mt-2">
                        <span class="material-symbols-outlined text-[20px]">how_to_reg</span>
                        Reserve Bed Now
                    </button>
                    <p class="text-[11px] text-center text-slate-500 mt-2">Reserving a bed ensures priority placement. Standard triage protocols apply upon arrival.</p>
                </form>
                @else
                <button disabled class="w-full bg-slate-100 text-slate-500 py-3.5 rounded-xl font-bold cursor-not-allowed text-center border border-slate-200">
                    Currently Full (Waitlist Only)
                </button>
                <p class="text-[11px] text-center text-red-500 mt-3 font-medium">Please select an alternative facility or contact emergency services.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
