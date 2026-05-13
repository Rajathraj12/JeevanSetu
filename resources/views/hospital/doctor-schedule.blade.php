@extends('layouts.app')
@section('title', 'Doctor Schedule - JeevanSetu')

@section('content')
@php
$doctors = [
    ['name' => 'Dr. Rajiv Sharma',  'specialty' => 'Cardiology',    'avatar' => 'RS', 'color' => 'bg-red-100 text-red-700',    'slots' => ['Mon' => ['9:00 AM','10:00 AM','11:00 AM'], 'Tue' => ['2:00 PM','3:00 PM'], 'Wed' => ['9:00 AM','10:00 AM'], 'Thu' => ['Off'], 'Fri' => ['9:00 AM','11:00 AM'], 'Sat' => ['10:00 AM'], 'Sun' => ['Off']]],
    ['name' => 'Dr. Sneha Mehta',   'specialty' => 'Neurosurgery',  'avatar' => 'SM', 'color' => 'bg-blue-100 text-blue-700',  'slots' => ['Mon' => ['Off'], 'Tue' => ['9:00 AM','10:00 AM'], 'Wed' => ['Off'], 'Thu' => ['9:00 AM','11:00 AM','2:00 PM'], 'Fri' => ['3:00 PM'], 'Sat' => ['9:00 AM'], 'Sun' => ['Off']]],
    ['name' => 'Dr. Amit Verma',    'specialty' => 'Emergency',     'avatar' => 'AV', 'color' => 'bg-teal-100 text-teal-700',  'slots' => ['Mon' => ['8:00 AM','12:00 PM','4:00 PM'], 'Tue' => ['8:00 AM'], 'Wed' => ['8:00 AM','12:00 PM'], 'Thu' => ['8:00 AM'], 'Fri' => ['8:00 AM','12:00 PM','4:00 PM'], 'Sat' => ['Off'], 'Sun' => ['8:00 AM']]],
    ['name' => 'Dr. Kavita Rao',    'specialty' => 'General Medicine','avatar' => 'KR', 'color' => 'bg-purple-100 text-purple-700','slots' => ['Mon' => ['10:00 AM','11:00 AM'], 'Tue' => ['10:00 AM','11:00 AM'], 'Wed' => ['10:00 AM'], 'Thu' => ['10:00 AM','11:00 AM'], 'Fri' => ['Off'], 'Sat' => ['Off'], 'Sun' => ['Off']]],
    ['name' => 'Dr. Suresh Pillai', 'specialty' => 'Orthopedics',   'avatar' => 'SP', 'color' => 'bg-amber-100 text-amber-700','slots' => ['Mon' => ['Off'], 'Tue' => ['Off'], 'Wed' => ['9:00 AM','11:00 AM','2:00 PM'], 'Thu' => ['Off'], 'Fri' => ['9:00 AM','11:00 AM'], 'Sat' => ['9:00 AM'], 'Sun' => ['Off']]],
];
$days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
@endphp

<div class="flex flex-col gap-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Doctor Schedule</h2>
            <p class="text-body-md text-on-surface-variant">{{ $hospital ? $hospital->name : 'Your Facility' }} — Weekly shift management for all doctors.</p>
        </div>
        <button onclick="document.getElementById('add-shift-modal').classList.remove('hidden')"
            class="bg-secondary hover:bg-secondary/90 text-white font-bold py-2.5 px-5 rounded-xl shadow-sm flex items-center gap-2 transition-colors">
            <span class="material-symbols-outlined text-[20px]">add</span> Add Shift
        </button>
    </div>

    <!-- Today's On-Duty Summary -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-secondary">today</span> On Duty Today (Thursday)
        </h3>
        <div class="flex flex-wrap gap-3">
            @foreach($doctors as $doc)
                @php $todaySlots = $doc['slots']['Thu'] ?? ['Off']; @endphp
                @if($todaySlots !== ['Off'])
                <div class="flex items-center gap-3 bg-slate-50 border border-slate-200 px-4 py-3 rounded-xl">
                    <div class="w-9 h-9 rounded-full {{ $doc['color'] }} flex items-center justify-center font-bold text-sm">{{ $doc['avatar'] }}</div>
                    <div>
                        <p class="font-bold text-sm text-slate-900">{{ $doc['name'] }}</p>
                        <p class="text-xs text-secondary font-medium">{{ implode(', ', $todaySlots) }}</p>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Weekly Schedule Grid -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary">calendar_today</span> Weekly Schedule
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[800px]">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase w-52">Doctor</th>
                        @foreach($days as $day)
                        <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase text-center">{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($doctors as $doc)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full {{ $doc['color'] }} flex items-center justify-center font-bold text-sm shrink-0">{{ $doc['avatar'] }}</div>
                                <div>
                                    <p class="font-bold text-slate-900 text-sm">{{ $doc['name'] }}</p>
                                    <p class="text-xs text-slate-400">{{ $doc['specialty'] }}</p>
                                </div>
                            </div>
                        </td>
                        @foreach($days as $day)
                        @php $slots = $doc['slots'][$day] ?? ['Off']; @endphp
                        <td class="px-3 py-4 text-center align-top">
                            @if($slots === ['Off'])
                                <span class="text-xs text-slate-400 font-medium">Off</span>
                            @else
                                <div class="flex flex-col gap-1 items-center">
                                    @foreach($slots as $slot)
                                    <span class="text-[10px] font-bold bg-secondary/10 text-secondary px-2 py-0.5 rounded-full whitespace-nowrap">{{ $slot }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Doctors List -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary">stethoscope</span> All Doctors
            </h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-6">
            @foreach($doctors as $doc)
            <div class="border border-slate-200 rounded-xl p-4 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-full {{ $doc['color'] }} flex items-center justify-center font-bold text-lg shrink-0">{{ $doc['avatar'] }}</div>
                <div>
                    <p class="font-bold text-slate-900">{{ $doc['name'] }}</p>
                    <p class="text-xs text-secondary font-medium">{{ $doc['specialty'] }}</p>
                    <button onclick="showToast('Editing {{ $doc['name'] }}'s schedule...')" class="text-[11px] text-slate-400 hover:text-secondary mt-1 flex items-center gap-1 transition-colors">
                        <span class="material-symbols-outlined text-[14px]">edit</span> Edit Schedule
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Add Shift Modal -->
<div id="add-shift-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-slate-800 px-6 py-4 flex justify-between items-center">
            <h3 class="text-white font-bold text-lg">Add / Edit Shift</h3>
            <button onclick="document.getElementById('add-shift-modal').classList.add('hidden')" class="text-white/60 hover:text-white"><span class="material-symbols-outlined">close</span></button>
        </div>
        <div class="p-6 flex flex-col gap-4">
            <div><label class="block text-sm font-bold text-slate-700 mb-1">Doctor</label>
                <select class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none">
                    @foreach($doctors as $doc)<option>{{ $doc['name'] }}</option>@endforeach
                </select></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-bold text-slate-700 mb-1">Day</label>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none">
                        @foreach($days as $d)<option>{{ $d }}</option>@endforeach
                    </select></div>
                <div><label class="block text-sm font-bold text-slate-700 mb-1">Shift Time</label>
                    <input type="time" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none"></div>
            </div>
            <button onclick="document.getElementById('add-shift-modal').classList.add('hidden'); showToast('Shift added successfully!');"
                class="w-full bg-secondary text-white font-bold py-3 rounded-xl hover:bg-secondary/90 transition-colors shadow-md mt-2">Save Shift</button>
        </div>
    </div>
</div>

<script>
function showToast(msg) {
    const t = document.createElement('div');
    t.className = 'fixed bottom-6 right-6 z-[999] bg-secondary text-white font-bold px-5 py-3 rounded-xl shadow-xl flex items-center gap-2';
    t.innerHTML = '<span class="material-symbols-outlined">check_circle</span>' + msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 2800);
}
document.getElementById('add-shift-modal').addEventListener('click', e => { if(e.target===e.currentTarget) e.currentTarget.classList.add('hidden'); });
</script>
@endsection
