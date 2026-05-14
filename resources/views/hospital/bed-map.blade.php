@extends('layouts.app')
@section('title', 'Bed Map - JeevanSetu')

@section('content')
<div class="flex flex-col gap-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Live Bed Map</h2>
            <p class="text-body-md text-on-surface-variant">{{ $hospital ? $hospital->name : 'Your Facility' }} — Click any bed to update its status.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-5 bg-white border border-slate-200 px-5 py-2.5 rounded-xl shadow-sm text-sm">
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-emerald-400 inline-block"></span> Available</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-red-400 inline-block"></span> Occupied</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-amber-400 inline-block"></span> Cleaning</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-slate-300 inline-block"></span> Maintenance</span>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @php
            $totalIcu = $hospital ? $hospital->icu_beds_total : 10;
            $availIcu = $hospital ? $hospital->icu_beds_available : 3;
            $totalEmg = $hospital ? $hospital->emergency_beds_total : 15;
            $availEmg = $hospital ? $hospital->emergency_beds_available : 7;
            $totalGen = $hospital ? $hospital->general_beds_total : 50;
            $availGen = $hospital ? $hospital->general_beds_available : 22;
            $totalAll = $totalIcu + $totalEmg + $totalGen;
            $availAll = $availIcu + $availEmg + $availGen;
        @endphp
        <div class="bg-white rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Total Beds</p>
            <p class="text-3xl font-bold text-slate-900">{{ $totalAll }}</p>
            <p class="text-xs text-emerald-600 font-bold mt-1"><span id="summary-all-avail">{{ $availAll }}</span> Available</p>
        </div>
        <div class="bg-red-50 rounded-xl border border-red-100 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-red-500 uppercase mb-1">ICU Ward</p>
            <p class="text-3xl font-bold text-red-700"><span id="summary-icu-avail">{{ $availIcu }}</span><span class="text-sm font-normal text-slate-400">/{{ $totalIcu }}</span></p>
            <p class="text-xs text-slate-500 mt-1">Available</p>
        </div>
        <div class="bg-teal-50 rounded-xl border border-teal-100 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-teal-600 uppercase mb-1">Emergency</p>
            <p class="text-3xl font-bold text-teal-700"><span id="summary-emg-avail">{{ $availEmg }}</span><span class="text-sm font-normal text-slate-400">/{{ $totalEmg }}</span></p>
            <p class="text-xs text-slate-500 mt-1">Available</p>
        </div>
        <div class="bg-slate-50 rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">General Ward</p>
            <p class="text-3xl font-bold text-slate-800"><span id="summary-gen-avail">{{ $availGen }}</span><span class="text-sm font-normal text-slate-400">/{{ $totalGen }}</span></p>
            <p class="text-xs text-slate-500 mt-1">Available</p>
        </div>
    </div>

    <!-- ICU Ward -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="bg-red-50 border-b border-red-100 px-6 py-4 flex items-center gap-3">
            <span class="material-symbols-outlined text-red-500">monitor_heart</span>
            <h3 class="font-bold text-red-700 text-lg">ICU Ward</h3>
            <span class="ml-auto text-xs font-bold text-red-500 bg-red-100 px-3 py-1 rounded-full">{{ $totalIcu }} Beds Total</span>
        </div>
        <div class="p-6 grid grid-cols-5 sm:grid-cols-8 md:grid-cols-10 gap-3">
            @for ($i = 1; $i <= $totalIcu; $i++)
                @php $status = $i <= $availIcu ? 'available' : ($i <= $totalIcu - 2 ? 'occupied' : 'cleaning'); @endphp
                <button
                    onclick="openBedModal('ICU-{{ sprintf('%02d', $i) }}', '{{ $status }}')"
                    data-ward="ICU"
                    data-status="{{ $status }}"
                    class="bed-cell aspect-square rounded-xl flex flex-col items-center justify-center gap-1 text-xs font-bold border-2 transition-all hover:scale-105 hover:shadow-md cursor-pointer
                        {{ $status === 'available' ? 'bg-emerald-50 border-emerald-300 text-emerald-700' : '' }}
                        {{ $status === 'occupied' ? 'bg-red-50 border-red-300 text-red-700' : '' }}
                        {{ $status === 'cleaning' ? 'bg-amber-50 border-amber-300 text-amber-700' : '' }}"
                    title="ICU-{{ sprintf('%02d', $i) }} — {{ ucfirst($status) }}"
                >
                    <span class="material-symbols-outlined text-[18px]">
                        {{ $status === 'available' ? 'check_circle' : ($status === 'occupied' ? 'person' : 'cleaning') }}
                    </span>
                    <span>ICU-{{ sprintf('%02d', $i) }}</span>
                </button>
            @endfor
        </div>
    </div>

    <!-- Emergency Ward -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="bg-teal-50 border-b border-teal-100 px-6 py-4 flex items-center gap-3">
            <span class="material-symbols-outlined text-teal-600">emergency</span>
            <h3 class="font-bold text-teal-700 text-lg">Emergency Ward</h3>
            <span class="ml-auto text-xs font-bold text-teal-600 bg-teal-100 px-3 py-1 rounded-full">{{ $totalEmg }} Beds Total</span>
        </div>
        <div class="p-6 grid grid-cols-5 sm:grid-cols-8 md:grid-cols-10 gap-3">
            @for ($i = 1; $i <= $totalEmg; $i++)
                @php $status = $i <= $availEmg ? 'available' : ($i <= $totalEmg - 1 ? 'occupied' : 'maintenance'); @endphp
                <button
                    onclick="openBedModal('EMG-{{ sprintf('%02d', $i) }}', '{{ $status }}')"
                    data-ward="EMG"
                    data-status="{{ $status }}"
                    class="bed-cell aspect-square rounded-xl flex flex-col items-center justify-center gap-1 text-xs font-bold border-2 transition-all hover:scale-105 hover:shadow-md cursor-pointer
                        {{ $status === 'available' ? 'bg-emerald-50 border-emerald-300 text-emerald-700' : '' }}
                        {{ $status === 'occupied' ? 'bg-red-50 border-red-300 text-red-700' : '' }}
                        {{ $status === 'maintenance' ? 'bg-slate-100 border-slate-300 text-slate-500' : '' }}"
                    title="EMG-{{ sprintf('%02d', $i) }} — {{ ucfirst($status) }}"
                >
                    <span class="material-symbols-outlined text-[18px]">
                        {{ $status === 'available' ? 'check_circle' : ($status === 'occupied' ? 'person' : 'build') }}
                    </span>
                    <span>EMG-{{ sprintf('%02d', $i) }}</span>
                </button>
            @endfor
        </div>
    </div>

    <!-- General Ward -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center gap-3">
            <span class="material-symbols-outlined text-slate-600">bed</span>
            <h3 class="font-bold text-slate-700 text-lg">General Ward</h3>
            <span class="ml-auto text-xs font-bold text-slate-600 bg-slate-200 px-3 py-1 rounded-full">{{ $totalGen }} Beds Total</span>
        </div>
        <div class="p-6 grid grid-cols-5 sm:grid-cols-8 md:grid-cols-10 gap-3">
            @for ($i = 1; $i <= $totalGen; $i++)
                @php 
                    if ($i <= $availGen) $status = 'available';
                    elseif ($i <= $totalGen - 5) $status = 'occupied';
                    elseif ($i <= $totalGen - 2) $status = 'cleaning';
                    else $status = 'maintenance';
                @endphp
                <button
                    onclick="openBedModal('GEN-{{ sprintf('%02d', $i) }}', '{{ $status }}')"
                    data-ward="GEN"
                    data-status="{{ $status }}"
                    class="bed-cell aspect-square rounded-xl flex flex-col items-center justify-center gap-1 text-xs font-bold border-2 transition-all hover:scale-105 hover:shadow-md cursor-pointer
                        {{ $status === 'available' ? 'bg-emerald-50 border-emerald-300 text-emerald-700' : '' }}
                        {{ $status === 'occupied' ? 'bg-red-50 border-red-300 text-red-700' : '' }}
                        {{ $status === 'cleaning' ? 'bg-amber-50 border-amber-300 text-amber-700' : '' }}
                        {{ $status === 'maintenance' ? 'bg-slate-100 border-slate-300 text-slate-500' : '' }}"
                    title="GEN-{{ sprintf('%02d', $i) }} — {{ ucfirst($status) }}"
                >
                    <span class="material-symbols-outlined text-[18px]">
                        {{ $status === 'available' ? 'check_circle' : ($status === 'occupied' ? 'person' : ($status === 'cleaning' ? 'cleaning' : 'build')) }}
                    </span>
                    <span>{{ sprintf('%02d', $i) }}</span>
                </button>
            @endfor
        </div>
    </div>
</div>

<!-- Bed Status Modal -->
<div id="bed-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
        <div class="bg-slate-800 px-6 py-4 flex justify-between items-center">
            <div>
                <p class="text-white/60 text-xs uppercase tracking-widest">Bed Management</p>
                <h3 id="modal-bed-id" class="text-white font-bold text-xl mt-0.5">BED-00</h3>
            </div>
            <button onclick="closeBedModal()" class="text-white/60 hover:text-white transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6">
            <p class="text-sm font-bold text-slate-700 mb-3">Current Status: <span id="modal-current-status" class="font-bold text-secondary"></span></p>
            <p class="text-sm text-slate-500 mb-5">Update the status of this bed:</p>
            <div class="grid grid-cols-2 gap-3">
                <button onclick="updateBedStatus('available')" class="flex items-center gap-2 p-3 rounded-xl border-2 border-emerald-200 bg-emerald-50 text-emerald-700 font-bold text-sm hover:border-emerald-400 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span> Available
                </button>
                <button onclick="updateBedStatus('occupied')" class="flex items-center gap-2 p-3 rounded-xl border-2 border-red-200 bg-red-50 text-red-700 font-bold text-sm hover:border-red-400 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">person</span> Occupied
                </button>
                <button onclick="updateBedStatus('cleaning')" class="flex items-center gap-2 p-3 rounded-xl border-2 border-amber-200 bg-amber-50 text-amber-700 font-bold text-sm hover:border-amber-400 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">cleaning</span> Cleaning
                </button>
                <button onclick="updateBedStatus('maintenance')" class="flex items-center gap-2 p-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-slate-600 font-bold text-sm hover:border-slate-400 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">build</span> Maintenance
                </button>
            </div>
            <div id="modal-success" class="hidden mt-4 bg-secondary/10 border border-secondary text-secondary px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                <span id="modal-success-text"></span>
            </div>
        </div>
    </div>
</div>

<script>
let currentBedId = null;
let currentBedButton = null;

function openBedModal(bedId, status) {
    currentBedId = bedId;
    document.getElementById('modal-bed-id').textContent = bedId;
    document.getElementById('modal-current-status').textContent = status.charAt(0).toUpperCase() + status.slice(1);
    document.getElementById('modal-success').classList.add('hidden');
    document.getElementById('bed-modal').classList.remove('hidden');
    // Store reference to clicked button
    currentBedButton = event.currentTarget;
}

function closeBedModal() {
    document.getElementById('bed-modal').classList.add('hidden');
    currentBedId = null;
    currentBedButton = null;
}

function updateBedStatus(newStatus) {
    if (!currentBedId || !currentBedButton) return;

    const oldStatus = currentBedButton.getAttribute('data-status');
    const ward = currentBedButton.getAttribute('data-ward');

    // Color & icon maps
    const config = {
        available:   { cls: 'bg-emerald-50 border-emerald-300 text-emerald-700', icon: 'check_circle' },
        occupied:    { cls: 'bg-red-50 border-red-300 text-red-700',             icon: 'person' },
        cleaning:    { cls: 'bg-amber-50 border-amber-300 text-amber-700',       icon: 'cleaning' },
        maintenance: { cls: 'bg-slate-100 border-slate-300 text-slate-500',      icon: 'build' },
    };

    // Remove old status classes
    ['bg-emerald-50','border-emerald-300','text-emerald-700',
     'bg-red-50','border-red-300','text-red-700',
     'bg-amber-50','border-amber-300','text-amber-700',
     'bg-slate-100','border-slate-300','text-slate-500']
        .forEach(c => currentBedButton.classList.remove(c));

    // Apply new classes
    config[newStatus].cls.split(' ').forEach(c => currentBedButton.classList.add(c));

    // Update data attribute & onclick
    currentBedButton.setAttribute('data-status', newStatus);
    currentBedButton.setAttribute('onclick', `openBedModal('${currentBedId}', '${newStatus}')`);

    // Update icon
    const icon = currentBedButton.querySelector('.material-symbols-outlined');
    if (icon) icon.textContent = config[newStatus].icon;

    // --- Sync with Database ---
    if (oldStatus !== newStatus) {
        let action = null;
        if (oldStatus === 'available' && newStatus !== 'available') {
            action = 'decrement';
        } else if (oldStatus !== 'available' && newStatus === 'available') {
            action = 'increment';
        }

        if (action) {
            fetch('{{ route('hospital.update-status') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ward, action })
            })
            .then(response => response.json())
            .then(data => {
                console.log('DB Synced:', data);
            })
            .catch(error => console.error('Error syncing bed status:', error));
        }
    }

    // Recalculate summary counts (UI Only)
    updateSummaryCounts();

    // Update modal current status label
    document.getElementById('modal-current-status').textContent =
        newStatus.charAt(0).toUpperCase() + newStatus.slice(1);

    // Show success message
    const successEl = document.getElementById('modal-success');
    document.getElementById('modal-success-text').textContent =
        `${currentBedId} marked as ${newStatus}!`;
    successEl.classList.remove('hidden');

    // Auto close after 1.2s
    setTimeout(closeBedModal, 1200);
}

function updateSummaryCounts() {
    const allBeds = document.querySelectorAll('.bed-cell');
    let icuAvail = 0;
    let emgAvail = 0;
    let genAvail = 0;

    allBeds.forEach(bed => {
        if (bed.getAttribute('data-status') === 'available') {
            const ward = bed.getAttribute('data-ward');
            if (ward === 'ICU') icuAvail++;
            else if (ward === 'EMG') emgAvail++;
            else if (ward === 'GEN') genAvail++;
        }
    });

    document.getElementById('summary-icu-avail').textContent = icuAvail;
    document.getElementById('summary-emg-avail').textContent = emgAvail;
    document.getElementById('summary-gen-avail').textContent = genAvail;
    document.getElementById('summary-all-avail').textContent = icuAvail + emgAvail + genAvail;
}

// Close on backdrop click
document.getElementById('bed-modal').addEventListener('click', function(e) {
    if (e.target === this) closeBedModal();
});
</script>
@endsection
