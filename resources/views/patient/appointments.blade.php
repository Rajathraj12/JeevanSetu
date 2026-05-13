@extends('layouts.app')
@section('title', 'My Appointments - JeevanSetu')

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">My Appointments</h2>
            <p class="text-body-md text-on-surface-variant">Manage your upcoming visits and view past records.</p>
        </div>
        <a href="{{ route('appointments.create') }}" class="bg-secondary hover:bg-secondary/90 text-white font-bold py-2.5 px-6 rounded-full shadow-sm flex items-center gap-2 transition-colors">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Book New Appointment
        </a>
    </div>

    @if(session('success'))
    <div class="bg-secondary/10 border border-secondary text-secondary px-4 py-3 rounded-lg flex items-center gap-2">
        <span class="material-symbols-outlined">check_circle</span>
        <p class="font-bold">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Upcoming Appointments -->
    <div>
        <h3 class="text-headline-sm font-bold text-on-surface mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-secondary">calendar_month</span>
            Upcoming Appointments
        </h3>
        <hr class="border-outline-variant/30 mb-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($upcoming as $appointment)
            <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-6 flex flex-col sm:flex-row gap-6 relative border-l-4 {{ $appointment->status == 'Confirmed' ? 'border-l-secondary' : 'border-l-slate-400' }}">
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="text-body-lg font-bold text-on-surface">{{ $appointment->doctor_name }}</h4>
                        @if($appointment->status == 'Confirmed')
                            <span class="px-3 py-1 bg-[#e5f6f2] text-secondary text-xs font-bold rounded-full">Confirmed</span>
                        @else
                            <span class="px-3 py-1 bg-slate-200 text-slate-700 text-xs font-bold rounded-full">{{ $appointment->status }}</span>
                        @endif
                    </div>
                    <p class="text-body-sm text-on-surface-variant mb-4">{{ $appointment->specialty }}</p>
                    
                    <div class="flex flex-wrap gap-4 mb-4">
                        <div class="flex items-center gap-1.5 text-on-surface-variant">
                            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                            <span class="text-sm">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-on-surface-variant">
                            <span class="material-symbols-outlined text-[18px]">schedule</span>
                            <span class="text-sm">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-1.5 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[18px] shrink-0 mt-0.5">location_on</span>
                        <span class="text-sm">{{ $appointment->location }}</span>
                    </div>
                </div>
                
                <div class="flex flex-col gap-3 shrink-0 sm:w-32 border-t sm:border-t-0 sm:border-l border-outline-variant/30 pt-4 sm:pt-0 sm:pl-6">
                    <form action="{{ route('appointments.reschedule', $appointment->id) }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="w-full border border-on-surface text-on-surface hover:bg-slate-50 font-bold py-2 px-4 rounded-lg text-sm transition-colors text-center">
                            Reschedule
                        </button>
                    </form>
                    <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="w-full border border-error text-error hover:bg-red-50 font-bold py-2 px-4 rounded-lg text-sm transition-colors text-center">
                            Cancel
                        </button>
                    </form>
                    <a href="#" class="w-full text-secondary font-bold text-sm flex items-center justify-center gap-1.5 mt-auto pt-2 hover:underline">
                        <span class="material-symbols-outlined text-[18px]">directions</span>
                        Directions
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 text-center py-8 bg-slate-50 rounded-xl border border-outline-variant/30">
                <p class="text-on-surface-variant">No upcoming appointments found.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Past Visits -->
    <div class="mt-4">
        <h3 class="text-headline-sm font-bold text-on-surface mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-secondary">history</span>
            Past Visits
        </h3>
        <hr class="border-outline-variant/30 mb-6">
        
        <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-outline-variant/30">
                            <th class="py-4 px-6 text-sm font-bold text-on-surface">Date</th>
                            <th class="py-4 px-6 text-sm font-bold text-on-surface">Doctor</th>
                            <th class="py-4 px-6 text-sm font-bold text-on-surface">Specialty</th>
                            <th class="py-4 px-6 text-sm font-bold text-on-surface">Status</th>
                            <th class="py-4 px-6 text-sm font-bold text-on-surface text-right">Records</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse($past as $appointment)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6 text-sm text-on-surface-variant">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                            <td class="py-4 px-6 text-sm font-bold text-on-surface">{{ $appointment->doctor_name }}</td>
                            <td class="py-4 px-6 text-sm text-on-surface-variant">{{ $appointment->specialty }}</td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-slate-200 text-slate-700 text-xs font-bold rounded-full">{{ $appointment->status }}</span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline font-medium text-sm flex items-center justify-end gap-1.5">
                                    <span class="material-symbols-outlined text-[18px]">description</span>
                                    View Report
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-sm text-on-surface-variant">No past visits found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-6 text-center">
            <a href="#" class="text-secondary font-bold text-sm hover:underline">View All Past History</a>
        </div>
    </div>
</div>
@endsection
