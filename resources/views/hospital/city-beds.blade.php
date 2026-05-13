@extends('layouts.app')
@section('title', 'City Beds Dashboard - JeevanSetu')

@section('content')
<div class="flex flex-col gap-6 max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-2">
        <div>
            <h2 class="text-[40px] font-bold text-[#111827] leading-tight mb-2 tracking-tight">City Beds</h2>
            <p class="text-[16px] text-slate-600">Real-time availability across Delhi NCR hospitals.</p>
        </div>
        
        <div class="flex gap-3">
            <button class="bg-white border border-slate-200 text-slate-700 font-medium py-2.5 px-4 rounded-xl flex items-center gap-2 hover:bg-slate-50 transition-colors shadow-sm">
                All Bed Types <span class="material-symbols-outlined text-[18px]">keyboard_arrow_down</span>
            </button>
            <button class="bg-white border border-slate-200 text-slate-700 font-medium py-2.5 px-4 rounded-xl flex items-center gap-2 hover:bg-slate-50 transition-colors shadow-sm">
                Any Distance <span class="material-symbols-outlined text-[18px]">keyboard_arrow_down</span>
            </button>
            <button class="bg-[#111827] text-white font-medium py-2.5 px-5 rounded-xl flex items-center gap-2 hover:bg-slate-800 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">filter_list</span> More Filters
            </button>
        </div>
    </div>

    <!-- Stats row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl shadow-sm border-y border-r border-slate-100 border-l-4 border-l-[#10b981] p-6 relative overflow-hidden">
            <div class="flex items-center gap-2 mb-4">
                <span class="material-symbols-outlined text-[#10b981]">bed</span>
                <span class="text-sm font-medium text-slate-600">Total Available (Delhi)</span>
            </div>
            <div class="text-[42px] font-bold text-[#111827] leading-none mb-4">1,248</div>
            <div class="flex items-center gap-1.5 text-sm">
                <span class="text-[#10b981] flex items-center font-bold">
                    <span class="material-symbols-outlined text-[16px]">arrow_upward</span> 12%
                </span>
                <span class="text-slate-500">vs last hour</span>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl shadow-sm border-y border-r border-slate-100 border-l-4 border-l-[#ef4444] p-6 relative overflow-hidden">
            <div class="flex items-center gap-2 mb-4">
                <span class="material-symbols-outlined text-[#ef4444]">monitor_heart</span>
                <span class="text-sm font-medium text-slate-600">ICU Beds Critical</span>
            </div>
            <div class="text-[42px] font-bold text-[#111827] leading-none mb-4">84</div>
            <div class="flex items-center gap-1.5 text-sm">
                <span class="text-[#ef4444] flex items-center font-bold">
                    <span class="material-symbols-outlined text-[16px]">warning</span> High demand alert
                </span>
            </div>
        </div>

        <!-- Card 3 (Dark) -->
        <div class="bg-[#111827] rounded-2xl shadow-md p-6 relative overflow-hidden flex flex-col justify-between">
            <span class="material-symbols-outlined absolute -right-4 -top-4 text-[120px] text-white/[0.03] select-none">add_box</span>
            <div>
                <h3 class="text-white font-bold text-lg mb-2 relative z-10">Emergency Transfer Network</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-6 relative z-10">Coordinate rapid inter-hospital patient transfers securely and track ambulance ETAs in real-time.</p>
            </div>
            <button class="bg-[#0d9488] hover:bg-[#0f766e] text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition-colors w-max relative z-10">
                Initiate Transfer
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Regional Hospitals -->
        <div class="lg:col-span-2 flex flex-col gap-5">
            <div class="flex justify-between items-center mb-1">
                <h3 class="text-xl font-bold text-[#111827]">Regional Hospitals</h3>
                <a href="#" class="text-[#0d9488] font-semibold text-sm hover:underline">View Map</a>
            </div>

            @foreach($hospitals as $hospital)
            @php
                $isAccepting = strtolower($hospital->status) === 'accepting' || strtolower($hospital->status) === 'operational';
                $borderColor = $isAccepting ? 'border-l-[#10b981]' : 'border-l-[#ef4444]';
                $badgeBg = $isAccepting ? 'bg-[#dcfce7]' : 'bg-[#fee2e2]';
                $badgeText = $isAccepting ? 'text-[#166534]' : 'text-[#991b1b]';
                $badgeIcon = $isAccepting ? 'check_circle' : 'error';
            @endphp
            <div class="bg-white rounded-2xl shadow-sm border-y border-r border-slate-100 border-l-4 {{ $borderColor }} p-6">
                <div class="flex justify-between items-start mb-1">
                    <h4 class="text-xl font-bold text-[#111827]">{{ $hospital->name }}</h4>
                    <span class="inline-flex items-center gap-1 {{ $badgeBg }} {{ $badgeText }} px-3 py-1 rounded-full text-xs font-bold">
                        <span class="material-symbols-outlined text-[14px]">{{ $badgeIcon }}</span> {{ $hospital->status }}
                    </span>
                </div>
                <div class="text-sm text-slate-500 mb-6 flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">location_on</span>
                    {{ $hospital->location }} ({{ $hospital->distance }} km)
                </div>

                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="bg-slate-50 rounded-xl p-4 flex flex-col items-center justify-center">
                        <span class="text-slate-500 text-sm font-medium mb-1">General</span>
                        <span class="text-2xl font-bold text-[#111827]">{{ $hospital->general_beds_available }}</span>
                    </div>
                    <div class="bg-[#fff1f2] rounded-xl p-4 flex flex-col items-center justify-center">
                        <span class="text-[#e11d48] text-sm font-medium mb-1">ICU</span>
                        <span class="text-2xl font-bold text-[#e11d48]">{{ $hospital->icu_beds_available }}</span>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 flex flex-col items-center justify-center">
                        <span class="text-slate-500 text-sm font-medium mb-1">Emergency</span>
                        <span class="text-2xl font-bold text-[#111827]">{{ $hospital->emergency_beds_available }}</span>
                    </div>
                </div>

                <div class="flex gap-4">
                    @if($isAccepting)
                        <button
                            onclick="openTransferModal('{{ $hospital->id }}', '{{ addslashes($hospital->name) }}', '{{ $hospital->icu_beds_available }}', '{{ $hospital->emergency_beds_available }}', '{{ $hospital->general_beds_available }}')"
                            class="flex-1 bg-[#3b82f6] hover:bg-[#2563eb] text-white font-bold py-3 rounded-xl transition-colors shadow-sm text-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">swap_horiz</span> Request Transfer
                        </button>
                    @else
                        <button class="flex-1 bg-[#bfdbfe] text-[#60a5fa] cursor-not-allowed font-bold py-3 rounded-xl text-sm" disabled>
                            Transfer Restricted
                        </button>
                    @endif
                    <a href="{{ route('hospital.show', $hospital->id) }}"
                        class="bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-3 px-6 rounded-xl transition-colors text-sm flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">info</span> Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Right Column: Admin Actions / Sidebar widgets -->
        <div class="lg:col-span-1">
            @if($role === 'admin')
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden sticky top-24">
                <!-- Dark Header -->
                <div class="bg-[#111827] p-6">
                    <div class="flex items-center gap-2 text-white font-bold text-lg mb-2">
                        <span class="material-symbols-outlined">admin_panel_settings</span>
                        Admin Actions
                    </div>
                    <p class="text-slate-400 text-sm">Manage network capacity and requests.</p>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="font-bold text-[#111827]">Update Local Counts</h5>
                            <span class="material-symbols-outlined text-[#0d9488] text-[20px]">edit</span>
                        </div>
                        <p class="text-sm text-slate-500 mb-4">Last updated: 10 mins ago. Ensure your facility's bed data is current.</p>
                        <button onclick="refreshNumbers()" class="w-full bg-white border border-slate-800 text-[#111827] font-bold py-2 rounded-lg hover:bg-slate-50 transition-colors text-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">refresh</span> Refresh Numbers
                        </button>
                        <p id="refresh-msg" class="hidden text-xs text-center text-emerald-600 font-bold mt-2">✓ Numbers refreshed!</p>
                    </div>

                    <div class="h-px bg-slate-100 w-full mb-8"></div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="font-bold text-[#111827]">Pending Transfers</h5>
                            <span class="bg-[#b91c1c] text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">3 New</span>
                        </div>
                        <p class="text-sm text-slate-500 mb-4">Review incoming requests from lower-tier facilities.</p>
                        
                        <div class="bg-slate-50 border border-slate-200 rounded-lg p-3 mb-3 flex justify-between items-center">
                            <div>
                                <div class="font-bold text-sm text-[#111827]">Req #4902 - ICU</div>
                                <div class="text-[11px] text-slate-500">From: City Clinic • 8 mins ago</div>
                            </div>
                            <button onclick="reviewTransfer('Req #4902', 'City Clinic', 'ICU')" class="text-[#0d9488] font-bold text-sm hover:underline">Review</button>
                        </div>
                        <div class="bg-slate-50 border border-slate-200 rounded-lg p-3 mb-4 flex justify-between items-center">
                            <div>
                                <div class="font-bold text-sm text-[#111827]">Req #4901 - Emergency</div>
                                <div class="text-[11px] text-slate-500">From: Mediplus Hospital • 22 mins ago</div>
                            </div>
                            <button onclick="reviewTransfer('Req #4901', 'Mediplus Hospital', 'Emergency')" class="text-[#0d9488] font-bold text-sm hover:underline">Review</button>
                        </div>

                        <button onclick="alert('Full transfer request list coming soon.')" class="w-full text-[#111827] font-bold text-sm hover:underline py-2">
                            Manage All Requests (5)
                        </button>
                    </div>
                </div>
            </div>
            @else
            <!-- Patient View Sidebar -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden sticky top-24">
                <div class="bg-[#006b55] p-6">
                    <div class="flex items-center gap-2 text-white font-bold text-lg mb-2">
                        <span class="material-symbols-outlined">info</span>
                        Transfer Guide
                    </div>
                    <p class="text-white/80 text-sm">How to request a bed transfer.</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-4 text-sm text-slate-600">
                        <li class="flex gap-3 items-start">
                            <span class="bg-brand-50 text-brand-600 w-6 h-6 rounded-full flex items-center justify-center font-bold shrink-0">1</span>
                            <p>Find a hospital with <span class="font-bold text-[#166534]">Accepting</span> status near your location.</p>
                        </li>
                        <li class="flex gap-3 items-start">
                            <span class="bg-brand-50 text-brand-600 w-6 h-6 rounded-full flex items-center justify-center font-bold shrink-0">2</span>
                            <p>Click <span class="font-bold text-[#2563eb]">Request Transfer</span> to send your patient ID to the facility.</p>
                        </li>
                        <li class="flex gap-3 items-start">
                            <span class="bg-brand-50 text-brand-600 w-6 h-6 rounded-full flex items-center justify-center font-bold shrink-0">3</span>
                            <p>Wait for the hospital administrator to approve your request.</p>
                        </li>
                    </ul>
                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <p class="text-xs text-slate-400 mb-2">Need immediate emergency assistance?</p>
                        <button class="w-full bg-[#ef4444] text-white font-bold py-2 rounded-lg hover:bg-red-600 transition-colors text-sm flex justify-center items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">call</span> Call Ambulance
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Request Transfer Modal -->
<div id="transfer-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-[#111827] px-6 py-4 flex justify-between items-center">
            <div>
                <p class="text-white/50 text-xs uppercase tracking-widest">Bed Transfer Request</p>
                <h3 id="modal-hospital-name" class="text-white font-bold text-lg mt-0.5">Hospital Name</h3>
            </div>
            <button onclick="closeTransferModal()" class="text-white/60 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="transfer-form" action="/hospital/__ID__/book-bed" method="POST" class="p-6 flex flex-col gap-4">
            @csrf
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 flex gap-3 text-sm text-blue-700">
                <span class="material-symbols-outlined shrink-0 text-blue-400">info</span>
                Submitting this request will reserve a bed. Confirm only for genuine patient transfers.
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Bed Type Needed</label>
                <select name="bed_type" id="modal-bed-type" class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-bold focus:ring-2 focus:ring-[#0d9488] outline-none">
                    <option value="General">General Ward</option>
                    <option value="Emergency">Emergency Room</option>
                    <option value="ICU">ICU (Critical)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Emergency Type</label>
                <select name="emergency_type" class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-bold focus:ring-2 focus:ring-[#0d9488] outline-none">
                    <option>Cardiac Emergency</option>
                    <option>Accident / Trauma</option>
                    <option>Respiratory Distress</option>
                    <option>Neurological Emergency</option>
                    <option>Post-Surgery Recovery</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="grid grid-cols-3 gap-3 text-center text-xs">
                <div class="p-3 bg-red-50 border border-red-100 rounded-xl">
                    <p class="font-bold text-slate-500 uppercase mb-1">ICU</p>
                    <p id="modal-icu" class="text-xl font-bold text-red-600">-</p>
                </div>
                <div class="p-3 bg-teal-50 border border-teal-100 rounded-xl">
                    <p class="font-bold text-slate-500 uppercase mb-1">Emg</p>
                    <p id="modal-emg" class="text-xl font-bold text-teal-600">-</p>
                </div>
                <div class="p-3 bg-slate-50 border border-slate-100 rounded-xl">
                    <p class="font-bold text-slate-500 uppercase mb-1">General</p>
                    <p id="modal-gen" class="text-xl font-bold text-slate-800">-</p>
                </div>
            </div>
            <button type="submit" class="w-full bg-[#3b82f6] hover:bg-[#2563eb] text-white font-bold py-3.5 rounded-xl transition-colors shadow-md mt-2 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">swap_horiz</span> Confirm Transfer Request
            </button>
        </form>
    </div>
</div>

<!-- Review Transfer Modal (Admin) -->
<div id="review-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
        <div class="bg-[#111827] px-6 py-4 flex justify-between items-center">
            <h3 class="text-white font-bold">Review Transfer Request</h3>
            <button onclick="document.getElementById('review-modal').classList.add('hidden')" class="text-white/60 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 flex flex-col gap-4">
            <div class="bg-slate-50 rounded-xl p-4">
                <p id="review-req-id" class="font-black text-lg text-slate-900"></p>
                <p id="review-from" class="text-sm text-slate-500 mt-1"></p>
                <p id="review-type" class="text-xs font-bold text-blue-600 mt-2"></p>
            </div>
            <div class="flex gap-3">
                <button onclick="approveTransfer()" class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span> Approve
                </button>
                <button onclick="rejectTransfer()" class="flex-1 bg-red-50 hover:bg-red-100 text-red-600 font-bold py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">cancel</span> Reject
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openTransferModal(id, name, icu, emg, gen) {
    document.getElementById('modal-hospital-name').textContent = name;
    document.getElementById('modal-icu').textContent = icu;
    document.getElementById('modal-emg').textContent = emg;
    document.getElementById('modal-gen').textContent = gen;
    document.getElementById('transfer-form').action = '/hospital/' + id + '/book-bed';
    const sel = document.getElementById('modal-bed-type');
    if (parseInt(icu) > 0) sel.value = 'ICU';
    else if (parseInt(emg) > 0) sel.value = 'Emergency';
    else sel.value = 'General';
    document.getElementById('transfer-modal').classList.remove('hidden');
}
function closeTransferModal() {
    document.getElementById('transfer-modal').classList.add('hidden');
}
function reviewTransfer(reqId, from, type) {
    document.getElementById('review-req-id').textContent = reqId;
    document.getElementById('review-from').textContent = 'From: ' + from;
    document.getElementById('review-type').textContent = 'Bed Type: ' + type;
    document.getElementById('review-modal').classList.remove('hidden');
}
function approveTransfer() {
    document.getElementById('review-modal').classList.add('hidden');
    showToast('Transfer approved! Bed reserved.');
}
function rejectTransfer() {
    document.getElementById('review-modal').classList.add('hidden');
    showToast('Transfer request rejected.');
}
function refreshNumbers() {
    const btn = event.currentTarget;
    btn.disabled = true;
    btn.innerHTML = '<span class="material-symbols-outlined text-[18px] animate-spin">refresh</span> Refreshing...';
    setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">refresh</span> Refresh Numbers';
        document.getElementById('refresh-msg').classList.remove('hidden');
        setTimeout(() => document.getElementById('refresh-msg').classList.add('hidden'), 2000);
    }, 1500);
}
function showToast(msg) {
    const t = document.createElement('div');
    t.className = 'fixed bottom-6 right-6 z-[999] bg-[#0d9488] text-white font-bold px-5 py-3 rounded-xl shadow-xl flex items-center gap-2';
    t.innerHTML = '<span class="material-symbols-outlined">check_circle</span>' + msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 2800);
}
document.getElementById('transfer-modal').addEventListener('click', e => { if(e.target===e.currentTarget) closeTransferModal(); });
document.getElementById('review-modal').addEventListener('click', e => { if(e.target===e.currentTarget) e.currentTarget.classList.add('hidden'); });
</script>
@endsection
