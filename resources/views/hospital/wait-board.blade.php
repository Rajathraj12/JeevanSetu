@extends('layouts.app')
@section('title', 'Wait Board - JeevanSetu')

@section('content')
@php
$tokens = [
    ['token' => 'T-79', 'patient' => 'Aarav Mehta',   'dept' => 'Cardiology',      'doctor' => 'Dr. Rajiv Sharma',  'status' => 'In Consultation', 'wait' => 0,  'checkin' => '09:00 AM'],
    ['token' => 'T-80', 'patient' => 'Sunita Reddy',  'dept' => 'General Medicine', 'doctor' => 'Dr. Kavita Rao',   'status' => 'Next',            'wait' => 3,  'checkin' => '09:15 AM'],
    ['token' => 'T-81', 'patient' => 'Karan Bose',    'dept' => 'Neurology',        'doctor' => 'Dr. Sneha Mehta',  'status' => 'Waiting',         'wait' => 12, 'checkin' => '09:30 AM'],
    ['token' => 'T-82', 'patient' => 'Nisha Patel',   'dept' => 'Cardiology',       'doctor' => 'Dr. Rajiv Sharma', 'status' => 'Waiting',         'wait' => 25, 'checkin' => '09:45 AM'],
    ['token' => 'T-83', 'patient' => 'Rajat Verma',   'dept' => 'Emergency',        'doctor' => 'Dr. Amit Verma',   'status' => 'Waiting',         'wait' => 30, 'checkin' => '10:00 AM'],
    ['token' => 'T-84', 'patient' => 'Priti Singh',   'dept' => 'Orthopedics',      'doctor' => 'Dr. Suresh Pillai','status' => 'Waiting',         'wait' => 42, 'checkin' => '10:15 AM'],
    ['token' => 'T-85', 'patient' => 'Manoj Kumar',   'dept' => 'General Medicine', 'doctor' => 'Dr. Kavita Rao',   'status' => 'Waiting',         'wait' => 55, 'checkin' => '10:30 AM'],
];
$statusStyle = [
    'In Consultation' => 'bg-emerald-100 text-emerald-700 border border-emerald-200',
    'Next'            => 'bg-blue-100 text-blue-700 border border-blue-200',
    'Waiting'         => 'bg-slate-100 text-slate-600 border border-slate-200',
];
@endphp

<div class="flex flex-col gap-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Wait Board</h2>
            <p class="text-body-md text-on-surface-variant">{{ $hospital ? $hospital->name : 'Your Facility' }} — Live OPD waiting board. Auto-refreshes every 60 seconds.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 text-sm text-secondary font-bold bg-secondary/10 px-4 py-2 rounded-xl">
                <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-secondary"></span></span>
                Live
            </div>
            <button onclick="callNext()" class="bg-secondary hover:bg-secondary/90 text-white font-bold py-2.5 px-5 rounded-xl shadow-sm flex items-center gap-2 transition-colors">
                <span class="material-symbols-outlined text-[20px]">record_voice_over</span> Call Next
            </button>
        </div>
    </div>

    <!-- Now Serving Banner -->
    <div id="now-serving-banner" class="bg-gradient-to-r from-slate-800 to-slate-700 rounded-2xl p-6 md:p-8 text-white flex flex-col md:flex-row items-center gap-6">
        <div class="flex flex-col items-center md:items-start">
            <p class="text-white/60 text-xs uppercase tracking-widest mb-1">Now Serving</p>
            <p id="current-token" class="text-6xl md:text-7xl font-black tracking-tight text-secondary">T-79</p>
        </div>
        <div class="w-px h-16 bg-white/20 hidden md:block"></div>
        <div class="flex flex-col items-center md:items-start text-center md:text-left">
            <p id="current-patient" class="text-2xl font-bold">Aarav Mehta</p>
            <p id="current-dept" class="text-white/60 mt-1">Cardiology · Dr. Rajiv Sharma</p>
            <p class="text-xs text-white/40 mt-2">OPD Room 1 — Please proceed to the consultation room</p>
        </div>
        <div class="ml-auto text-right hidden md:block">
            <p class="text-white/40 text-xs">Next Token</p>
            <p id="next-token-display" class="text-3xl font-bold text-white/80">T-80</p>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">In Queue</p>
            <p id="queue-count" class="text-3xl font-bold text-slate-900">{{ count($tokens) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Avg Wait</p>
            <p class="text-3xl font-bold text-amber-500">~{{ round(array_sum(array_column($tokens, 'wait')) / count($tokens)) }} min</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Served Today</p>
            <p class="text-3xl font-bold text-emerald-600" id="served-count">78</p>
        </div>
    </div>

    <!-- Token Queue Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary">hourglass_empty</span> Queue Status
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Token</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Patient</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Department</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Check-in</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Est. Wait</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100" id="queue-table-body">
                    @foreach($tokens as $i => $t)
                    <tr class="transition-all hover:bg-slate-50 token-row {{ $t['status'] === 'In Consultation' ? 'bg-emerald-50/30' : '' }}" id="row-{{ $t['token'] }}" data-token="{{ $t['token'] }}">
                        <td class="px-6 py-4 font-black text-xl text-secondary">{{ $t['token'] }}</td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900 text-sm">{{ $t['patient'] }}</p>
                            <p class="text-xs text-slate-400">{{ $t['doctor'] }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $t['dept'] }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $t['checkin'] }}</td>
                        <td class="px-6 py-4 text-sm {{ $t['wait'] > 30 ? 'text-red-500 font-bold' : 'text-slate-600' }}">
                            {{ $t['wait'] > 0 ? '~'.$t['wait'].' min' : 'Now' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="token-status text-xs font-bold px-2.5 py-1 rounded-full {{ $statusStyle[$t['status']] }}">{{ $t['status'] }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($t['status'] !== 'In Consultation')
                            <button onclick="skipToken('{{ $t['token'] }}')"
                                class="text-xs font-bold px-3 py-1.5 bg-slate-100 text-slate-600 rounded-lg hover:bg-red-100 hover:text-red-600 transition-colors">
                                Skip
                            </button>
                            @else
                            <button onclick="doneConsultation()"
                                class="text-xs font-bold px-3 py-1.5 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors">
                                Done ✓
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
let queueCount = {{ count($tokens) }};
let servedCount = 78;

function callNext() {
    const rows = document.querySelectorAll('.token-row');
    let nextRow = null;
    rows.forEach(r => {
        const statusEl = r.querySelector('.token-status');
        if (statusEl && statusEl.textContent.trim() === 'Next' && !nextRow) nextRow = r;
    });
    if (!nextRow) { showToast('No more tokens in queue!'); return; }
    const token = nextRow.dataset.token;
    const patient = nextRow.querySelectorAll('td')[1].querySelector('p').textContent;
    const dept = nextRow.querySelectorAll('td')[2].textContent.trim();
    const doctor = nextRow.querySelectorAll('td')[1].querySelectorAll('p')[1].textContent;

    document.getElementById('current-token').textContent = token;
    document.getElementById('current-patient').textContent = patient;
    document.getElementById('current-dept').textContent = dept + ' · ' + doctor;

    nextRow.querySelector('.token-status').className = 'token-status text-xs font-bold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200';
    nextRow.querySelector('.token-status').textContent = 'In Consultation';

    // Find new next
    let foundNext = false;
    rows.forEach(r => {
        const s = r.querySelector('.token-status');
        if (s && s.textContent.trim() === 'Waiting' && !foundNext) {
            s.className = 'token-status text-xs font-bold px-2.5 py-1 rounded-full bg-blue-100 text-blue-700 border border-blue-200';
            s.textContent = 'Next';
            document.getElementById('next-token-display').textContent = r.dataset.token;
            foundNext = true;
        }
    });

    showToast('Calling ' + token + ' — ' + patient);
}

function doneConsultation() {
    const consulting = document.querySelector('.token-row [data-status="In Consultation"]') ||
        [...document.querySelectorAll('.token-status')].find(el => el.textContent.trim() === 'In Consultation')?.closest('tr');
    servedCount++;
    document.getElementById('served-count').textContent = servedCount;
    queueCount = Math.max(0, queueCount - 1);
    document.getElementById('queue-count').textContent = queueCount;
    callNext();
}

function skipToken(token) {
    if (!confirm('Skip ' + token + '?')) return;
    const row = document.getElementById('row-' + token);
    row.style.opacity = '0.4';
    row.querySelector('.token-status').className = 'token-status text-xs font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-400 border border-slate-200';
    row.querySelector('.token-status').textContent = 'Skipped';
    queueCount = Math.max(0, queueCount - 1);
    document.getElementById('queue-count').textContent = queueCount;
    showToast(token + ' skipped.');
}

function showToast(msg) {
    const t = document.createElement('div');
    t.className = 'fixed bottom-6 right-6 z-[999] bg-secondary text-white font-bold px-5 py-3 rounded-xl shadow-xl flex items-center gap-2';
    t.innerHTML = '<span class="material-symbols-outlined">record_voice_over</span>' + msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 2800);
}
</script>
@endsection
