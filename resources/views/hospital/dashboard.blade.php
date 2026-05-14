@extends('layouts.app')
@section('title', 'Admin Dashboard - JeevanSetu')

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">
                {{ $hospital ? $hospital->name : 'JeevanSetu Partner Portal' }}
            </h2>
            <p class="text-body-md text-on-surface-variant">Real-time metrics and actionable insights for {{ $hospital ? $hospital->name : 'your facility' }}.</p>
        </div>
        <div class="text-label-sm text-on-surface-variant bg-white px-4 py-2 rounded-lg shadow-sm border border-outline-variant/30">
            Last updated: Just now
        </div>
    </div>

    <!-- Metrics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border-l-4 border-secondary p-6 flex flex-col relative group hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-body-md text-on-surface-variant font-medium">Total Patients Today</h3>
                <div class="p-2 bg-blue-100 rounded-full text-blue-700">
                    <span class="material-symbols-outlined">group</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-display-lg font-bold text-on-surface">142</span>
                <span class="text-label-sm text-secondary bg-secondary/10 px-2 py-0.5 rounded-full">+12%</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-secondary p-6 flex flex-col relative group hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-body-md text-on-surface-variant font-medium">Beds Available</h3>
                <div class="p-2 bg-green-100 rounded-full text-green-700">
                    <span class="material-symbols-outlined">bed</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-display-lg font-bold text-on-surface">{{ $hospital ? ($hospital->icu_beds_available + $hospital->emergency_beds_available + $hospital->general_beds_available) : 18 }}</span>
                <span class="text-label-sm text-on-surface-variant">/ {{ $hospital ? ($hospital->icu_beds_total + $hospital->emergency_beds_total + $hospital->general_beds_total) : 120 }}</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-secondary p-6 flex flex-col relative group hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-body-md text-on-surface-variant font-medium">Low Stock Items</h3>
                <div class="p-2 bg-red-100 rounded-full text-red-700">
                    <span class="material-symbols-outlined">warning</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-display-lg font-bold text-error">5</span>
                <span class="text-label-sm text-error bg-error/10 px-2 py-0.5 rounded-full">Requires Action</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-secondary p-6 flex flex-col relative group hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-body-md text-on-surface-variant font-medium">Pending Admissions</h3>
                <div class="p-2 bg-orange-100 rounded-full text-orange-700">
                    <span class="material-symbols-outlined">pending_actions</span>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-display-lg font-bold text-on-surface">12</span>
                <span class="text-label-sm text-on-surface-variant">Awaiting Approval</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 flex flex-col gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-6">
                <h3 class="text-headline-sm font-bold text-on-surface mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">flash_on</span>
                    Quick Actions
                </h3>
                <div class="flex flex-col gap-4">
                    <button onclick="callNextToken()" class="w-full bg-secondary hover:bg-secondary/90 text-white py-3 px-4 rounded-lg flex items-center justify-between transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined">record_voice_over</span>
                            <span class="text-label-md font-bold">Call Next Token</span>
                        </div>
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                    <button onclick="openMedicineModal()" class="w-full border-2 border-primary-container text-primary-container hover:bg-primary-container hover:text-white py-3 px-4 rounded-lg flex items-center justify-between transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined">medication</span>
                            <span class="text-label-md font-bold">Add Medicine</span>
                        </div>
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">add</span>
                    </button>
                    <button onclick="approveAdmission()" class="w-full bg-surface-container hover:bg-surface-variant text-on-surface py-3 px-4 rounded-lg flex items-center justify-between transition-colors border border-outline-variant/30">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary">how_to_reg</span>
                            <span class="text-label-md font-bold">Approve Admission</span>
                        </div>
                        <span id="pending-count-badge" class="bg-secondary text-white text-[10px] font-bold px-2 py-0.5 rounded-full">12 Pending</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-6 h-full">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-headline-sm font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-container">history</span>
                        Recent Activity
                    </h3>
                    <button class="text-label-sm text-secondary hover:underline cursor-pointer">View All</button>
                </div>
                
                <div class="flex flex-col divide-y divide-outline-variant/20">
                    <div class="py-4 flex items-start gap-4">
                        <div class="p-2 bg-green-100 rounded-full text-green-700 shrink-0">
                            <span class="material-symbols-outlined">check_circle</span>
                        </div>
                        <div>
                            <p class="text-body-md text-on-surface"><span class="font-bold">Admission Approved:</span> Patient Ramesh Kumar (ID: P-492) assigned to Ward B, Bed 12.</p>
                            <p class="text-label-sm text-on-surface-variant mt-1">2 mins ago • by Admin</p>
                        </div>
                    </div>
                    <div class="py-4 flex items-start gap-4">
                        <div class="p-2 bg-blue-100 rounded-full text-blue-700 shrink-0">
                            <span class="material-symbols-outlined">campaign</span>
                        </div>
                        <div>
                            <p class="text-body-md text-on-surface"><span class="font-bold">Token Called:</span> Token T-84 called to OPD Room 3.</p>
                            <p class="text-label-sm text-on-surface-variant mt-1">15 mins ago • Auto-System</p>
                        </div>
                    </div>
                    <div class="py-4 flex items-start gap-4">
                        <div class="p-2 bg-red-100 rounded-full text-red-700 shrink-0">
                            <span class="material-symbols-outlined">inventory_2</span>
                        </div>
                        <div>
                            <p class="text-body-md text-on-surface"><span class="font-bold">Inventory Alert:</span> Paracetamol 500mg stock dropped below critical threshold.</p>
                            <p class="text-label-sm text-on-surface-variant mt-1">42 mins ago • System Alert</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Medicine Modal -->
<div id="medicine-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-on-surface/40 backdrop-blur-sm" onclick="closeMedicineModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl p-6 overflow-hidden">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-headline-sm font-bold text-on-surface">Add New Medicine</h3>
            <button onclick="closeMedicineModal()" class="p-2 hover:bg-surface-container-low rounded-full transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <form onsubmit="saveMedicine(event)" class="flex flex-col gap-4">
            <div>
                <label class="text-label-sm font-medium text-on-surface-variant block mb-1.5">Medicine Name</label>
                <input type="text" required placeholder="e.g. Paracetamol 500mg" class="w-full px-4 py-2 rounded-lg border border-outline-variant focus:outline-none focus:border-secondary transition-colors">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-label-sm font-medium text-on-surface-variant block mb-1.5">Quantity</label>
                    <input type="number" required placeholder="0" class="w-full px-4 py-2 rounded-lg border border-outline-variant focus:outline-none focus:border-secondary transition-colors">
                </div>
                <div>
                    <label class="text-label-sm font-medium text-on-surface-variant block mb-1.5">Unit</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-outline-variant focus:outline-none focus:border-secondary transition-colors bg-white">
                        <option>Strips</option>
                        <option>Bottles</option>
                        <option>Injectables</option>
                        <option>Boxes</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="text-label-sm font-medium text-on-surface-variant block mb-1.5">Expiry Date</label>
                <input type="date" required class="w-full px-4 py-2 rounded-lg border border-outline-variant focus:outline-none focus:border-secondary transition-colors">
            </div>
            
            <button type="submit" class="w-full bg-secondary text-white py-3 rounded-lg font-bold mt-2 hover:bg-secondary/90 transition-colors">
                Save to Inventory
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    let currentToken = 84;
    let pendingAdmissions = 12;

    function callNextToken() {
        currentToken++;
        showToast(`Calling Token T-${currentToken} to OPD Room 1`, 'info');
        
        // Add to recent activity (visual only)
        const activityList = document.querySelector('.divide-y');
        const newActivity = document.createElement('div');
        newActivity.className = 'py-4 flex items-start gap-4 animate-pulse';
        newActivity.innerHTML = `
            <div class="p-2 bg-blue-100 rounded-full text-blue-700 shrink-0">
                <span class="material-symbols-outlined">campaign</span>
            </div>
            <div>
                <p class="text-body-md text-on-surface"><span class="font-bold">Token Called:</span> Token T-${currentToken} called to OPD Room 1.</p>
                <p class="text-label-sm text-on-surface-variant mt-1">Just now • Auto-System</p>
            </div>
        `;
        activityList.prepend(newActivity);
        setTimeout(() => newActivity.classList.remove('animate-pulse'), 1000);
    }

    function approveAdmission() {
        if (pendingAdmissions > 0) {
            pendingAdmissions--;
            document.getElementById('pending-count-badge').innerText = `${pendingAdmissions} Pending`;
            showToast('Admission approved successfully!', 'success');
            
            // Add to recent activity
            const activityList = document.querySelector('.divide-y');
            const newActivity = document.createElement('div');
            newActivity.className = 'py-4 flex items-start gap-4 animate-pulse';
            newActivity.innerHTML = `
                <div class="p-2 bg-green-100 rounded-full text-green-700 shrink-0">
                    <span class="material-symbols-outlined">check_circle</span>
                </div>
                <div>
                    <p class="text-body-md text-on-surface"><span class="font-bold">Admission Approved:</span> New patient assigned to Ward A.</p>
                    <p class="text-label-sm text-on-surface-variant mt-1">Just now • by Admin</p>
                </div>
            `;
            activityList.prepend(newActivity);
            setTimeout(() => newActivity.classList.remove('animate-pulse'), 1000);
        } else {
            showToast('No pending admissions in queue.', 'info');
        }
    }

    function openMedicineModal() {
        document.getElementById('medicine-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeMedicineModal() {
        document.getElementById('medicine-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function saveMedicine(e) {
        e.preventDefault();
        const medicineName = e.target.querySelector('input[type="text"]').value;
        showToast(`${medicineName} added to inventory!`, 'success');
        closeMedicineModal();
        e.target.reset();
    }
</script>
@endpush
@endsection
