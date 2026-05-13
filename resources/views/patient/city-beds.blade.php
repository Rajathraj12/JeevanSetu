@extends('layouts.app')
@section('title', 'City Bed Availability - JeevanSetu')

@section('content')
<div class="flex flex-col gap-6 max-w-7xl mx-auto w-full">
    


    @if(session('success'))
    <div class="bg-secondary/10 border border-secondary text-secondary px-4 py-3 rounded-lg flex items-center gap-2 mb-4">
        <span class="material-symbols-outlined">check_circle</span>
        <p class="font-bold">{{ session('success') }}</p>
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-50 border border-red-500 text-red-600 px-4 py-3 rounded-lg flex items-center gap-2 mb-4">
        <span class="material-symbols-outlined">error</span>
        <p class="font-bold">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mt-2">
        <div>
            <h2 class="text-[32px] font-bold text-slate-900 leading-tight mb-1 font-serif tracking-tight">City Bed Availability</h2>
            <p class="text-[14px] text-slate-500">Real-time capacity across networked healthcare facilities.</p>
        </div>
        
        <div class="bg-slate-100 text-slate-600 px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-1.5 border border-slate-200">
            <span class="w-2 h-2 rounded-full bg-secondary"></span> Live Update
        </div>
    </div>

    <!-- Metrics Cards Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Card 1 -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 border-l-4 border-l-secondary p-5 flex flex-col justify-between h-[110px]">
            <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total Available ICU</span>
                <div class="p-1.5 bg-red-50 rounded text-red-500">
                    <span class="material-symbols-outlined text-[18px]">monitor_heart</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2 mt-auto">
                <span class="text-4xl font-bold text-slate-900 font-serif">14</span>
                <span class="text-xs font-bold text-red-500">Critical</span>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 border-l-4 border-l-secondary p-5 flex flex-col justify-between h-[110px]">
            <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Ventilators</span>
                <div class="p-1.5 bg-slate-100 rounded text-slate-500">
                    <span class="material-symbols-outlined text-[18px]">air</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2 mt-auto">
                <span class="text-4xl font-bold text-slate-900 font-serif">08</span>
                <span class="text-xs text-slate-500 font-medium">Available</span>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 border-l-4 border-l-secondary p-5 flex flex-col justify-between h-[110px]">
            <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Oxygen Beds</span>
                <div class="p-1.5 bg-teal-50 rounded text-teal-600">
                    <span class="material-symbols-outlined text-[18px]">water_drop</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2 mt-auto">
                <span class="text-4xl font-bold text-slate-900 font-serif">42</span>
                <span class="text-xs text-secondary font-medium">Adequate</span>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 border-l-4 border-l-secondary p-5 flex flex-col justify-between h-[110px]">
            <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">General Ward</span>
                <div class="p-1.5 bg-slate-100 rounded text-slate-500">
                    <span class="material-symbols-outlined text-[18px]">bed</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2 mt-auto">
                <span class="text-4xl font-bold text-slate-900 font-serif">156</span>
                <span class="text-xs text-slate-500 font-medium">Open</span>
            </div>
        </div>
    </div>

    <!-- Filters Row -->
    <div class="flex flex-wrap items-center gap-3 mt-2">
        <a href="{{ route('city-beds', ['filter' => 'near_me']) }}" 
           class="{{ ($activeFilter ?? '') == 'near_me' ? 'bg-secondary text-white hover:bg-secondary/90' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }} px-4 py-2 rounded-full text-sm font-bold flex items-center gap-1.5 shadow-sm transition-colors">
            <span class="material-symbols-outlined text-[18px]">my_location</span> Near Me
        </a>
        <a href="{{ route('city-beds', ['filter' => 'insurance']) }}" 
           class="{{ ($activeFilter ?? '') == 'insurance' ? 'bg-secondary text-white hover:bg-secondary/90' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }} px-4 py-2 rounded-full text-sm font-medium flex items-center gap-1.5 shadow-sm transition-colors">
            <span class="material-symbols-outlined text-[18px]">verified_user</span> Insurance Supported
        </a>
        <a href="{{ route('city-beds', ['filter' => 'rating']) }}" 
           class="{{ ($activeFilter ?? '') == 'rating' ? 'bg-secondary text-white hover:bg-secondary/90' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }} px-4 py-2 rounded-full text-sm font-medium flex items-center gap-1.5 shadow-sm transition-colors">
            <span class="material-symbols-outlined text-[18px]">star</span> Rating 4.0+
        </a>
        @if($activeFilter)
        <a href="{{ route('city-beds') }}" class="text-slate-500 hover:text-red-500 text-sm font-bold ml-2 underline transition-colors">
            Clear Filters
        </a>
        @endif
        <div class="ml-auto text-slate-500 hover:text-slate-800 cursor-pointer">
            <span class="material-symbols-outlined">tune</span>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="flex flex-col gap-4 mt-2">
        @foreach($hospitals as $hospital)
        <div class="bg-white rounded-2xl shadow-sm border-l-4 {{ $hospital->icu_beds_available == 0 ? 'border-l-red-500' : 'border-l-secondary' }} p-6">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">{{ $hospital->name }}</h3>
                    <p class="text-xs text-slate-500 flex items-center gap-1 mt-1">
                        <span class="material-symbols-outlined text-[14px]">location_on</span>
                        {{ $hospital->distance }} km away • <span class="text-secondary font-medium">{{ $hospital->type }}</span>
                    </p>
                </div>
                <div class="bg-amber-50 text-amber-600 px-2.5 py-1 rounded-md text-xs font-bold flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">star</span> 4.5
                </div>
            </div>

            <div class="flex flex-wrap gap-2 mt-4 mb-6">
                <span class="{{ $hospital->icu_beds_available == 0 ? 'bg-white text-red-600 border border-red-500' : 'bg-red-50 text-red-600 border border-red-100' }} text-[11px] font-bold px-3 py-1.5 rounded-md">
                    ICU: {{ $hospital->icu_beds_available == 0 ? 'Full' : $hospital->icu_beds_available }}
                </span>
                <span class="bg-teal-50 text-secondary text-[11px] font-bold px-3 py-1.5 rounded-md border border-teal-100">
                    Emergency: {{ $hospital->emergency_beds_available }}
                </span>
                <span class="bg-slate-100 text-slate-600 text-[11px] font-bold px-3 py-1.5 rounded-md border border-slate-200">
                    General: {{ $hospital->general_beds_available }}
                </span>
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <a href="{{ route('hospital.show', $hospital->id) }}" class="bg-white border border-slate-200 text-slate-700 px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-50 transition-colors flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">info</span> Details
                </a>
                @if($hospital->icu_beds_available > 0 || $hospital->general_beds_available > 0 || $hospital->emergency_beds_available > 0)
                <button type="button"
                    onclick="openTransferModal('{{ $hospital->id }}', '{{ addslashes($hospital->name) }}', '{{ $hospital->icu_beds_available }}', '{{ $hospital->emergency_beds_available }}', '{{ $hospital->general_beds_available }}')"
                    class="bg-secondary text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-secondary/20 hover:bg-secondary/90 transition-colors flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">swap_horiz</span> Request Transfer
                </button>
                @else
                <button disabled class="bg-slate-100 text-slate-500 px-5 py-2.5 rounded-xl text-sm font-bold cursor-not-allowed">
                    Waitlist Only
                </button>
                @endif
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- Request Transfer Modal -->
<div id="transfer-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-slate-800 px-6 py-4 flex justify-between items-center">
            <div>
                <p class="text-white/50 text-xs uppercase tracking-widest">Bed Transfer Request</p>
                <h3 id="modal-hospital-name" class="text-white font-bold text-lg mt-0.5">Hospital Name</h3>
            </div>
            <button onclick="closeTransferModal()" class="text-white/60 hover:text-white transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form action="{{ route('hospital.book-bed', '__ID__') }}" method="POST" id="transfer-form" class="p-6 flex flex-col gap-4">
            @csrf
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-3">
                <span class="material-symbols-outlined text-blue-500 shrink-0">info</span>
                <p class="text-sm text-blue-700">A transfer request reserves a bed for priority placement. Hospital staff will confirm upon arrival.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Bed Type Required</label>
                <select name="bed_type" id="modal-bed-type" class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-bold focus:ring-2 focus:ring-secondary outline-none">
                    <option value="General">General Ward</option>
                    <option value="Emergency">Emergency Room</option>
                    <option value="ICU">ICU (Critical)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nature of Emergency</label>
                <select name="emergency_type" class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-bold focus:ring-2 focus:ring-secondary outline-none">
                    <option>Accident / Trauma</option>
                    <option>Cardiac Emergency</option>
                    <option>Respiratory Distress</option>
                    <option>Neurological Emergency</option>
                    <option>Post-Surgery Recovery</option>
                    <option>Other</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Additional Notes (Optional)</label>
                <textarea name="notes" rows="2" placeholder="e.g. Patient is diabetic, requires wheelchair..." class="w-full px-4 py-2 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-secondary outline-none resize-none"></textarea>
            </div>

            <div class="grid grid-cols-3 gap-3 text-center" id="modal-availability">
                <div id="modal-icu" class="p-3 rounded-xl border">
                    <p class="text-xs font-bold text-slate-500 uppercase">ICU</p>
                    <p id="modal-icu-count" class="text-xl font-bold text-red-600">-</p>
                </div>
                <div id="modal-emg" class="p-3 rounded-xl border">
                    <p class="text-xs font-bold text-slate-500 uppercase">Emergency</p>
                    <p id="modal-emg-count" class="text-xl font-bold text-secondary">-</p>
                </div>
                <div id="modal-gen" class="p-3 rounded-xl border">
                    <p class="text-xs font-bold text-slate-500 uppercase">General</p>
                    <p id="modal-gen-count" class="text-xl font-bold text-slate-800">-</p>
                </div>
            </div>

            <button type="submit" class="w-full bg-secondary text-white font-bold py-3.5 rounded-xl hover:bg-secondary/90 transition-colors shadow-md shadow-secondary/30 mt-2 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">swap_horiz</span>
                Confirm Transfer Request
            </button>
        </form>
    </div>
</div>

<script>
function openTransferModal(id, name, icu, emg, gen) {
    document.getElementById('modal-hospital-name').textContent = name;
    document.getElementById('modal-icu-count').textContent = icu;
    document.getElementById('modal-emg-count').textContent = emg;
    document.getElementById('modal-gen-count').textContent = gen;

    // Update form action with correct hospital ID
    document.getElementById('transfer-form').action = '/hospital/' + id + '/book-bed';

    // Pre-select best available bed type
    const sel = document.getElementById('modal-bed-type');
    if (parseInt(icu) > 0) sel.value = 'ICU';
    else if (parseInt(emg) > 0) sel.value = 'Emergency';
    else sel.value = 'General';

    document.getElementById('transfer-modal').classList.remove('hidden');
}
function closeTransferModal() {
    document.getElementById('transfer-modal').classList.add('hidden');
}
document.getElementById('transfer-modal').addEventListener('click', function(e) {
    if (e.target === this) closeTransferModal();
});
</script>
@endsection
