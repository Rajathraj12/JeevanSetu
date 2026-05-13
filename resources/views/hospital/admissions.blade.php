@extends('layouts.app')
@section('title', 'Admissions - JeevanSetu')

@section('content')
@php
$admissions = [
    ['id' => 'ADM-1042', 'patient' => 'Ramesh Kumar', 'age' => 58, 'ward' => 'ICU', 'doctor' => 'Dr. Rajiv Sharma', 'date' => '2026-05-14', 'reason' => 'Acute Myocardial Infarction', 'status' => 'Admitted',  'bed' => 'ICU-03'],
    ['id' => 'ADM-1041', 'patient' => 'Sunita Devi',  'age' => 44, 'ward' => 'General', 'doctor' => 'Dr. Sneha Mehta', 'date' => '2026-05-13', 'reason' => 'Post-Op Recovery (Appendectomy)', 'status' => 'Admitted', 'bed' => 'GEN-12'],
    ['id' => 'ADM-1040', 'patient' => 'Arjun Singh',  'age' => 32, 'ward' => 'Emergency', 'doctor' => 'Dr. Amit Verma', 'date' => '2026-05-14', 'reason' => 'Road Traffic Accident — Fracture', 'status' => 'Pending',  'bed' => '—'],
    ['id' => 'ADM-1039', 'patient' => 'Priya Nair',   'age' => 27, 'ward' => 'General', 'doctor' => 'Dr. Kavita Rao',  'date' => '2026-05-12', 'reason' => 'Dengue Fever', 'status' => 'Discharged', 'bed' => 'GEN-07'],
    ['id' => 'ADM-1038', 'patient' => 'Mohd. Akhtar', 'age' => 65, 'ward' => 'ICU',     'doctor' => 'Dr. Rajiv Sharma','date' => '2026-05-11', 'reason' => 'Respiratory Failure', 'status' => 'Pending',  'bed' => '—'],
    ['id' => 'ADM-1037', 'patient' => 'Kavya Reddy',  'age' => 19, 'ward' => 'General', 'doctor' => 'Dr. Sneha Mehta', 'date' => '2026-05-10', 'reason' => 'Typhoid', 'status' => 'Discharged', 'bed' => 'GEN-22'],
];
$statusColors = [
    'Admitted'   => 'bg-emerald-100 text-emerald-700',
    'Pending'    => 'bg-amber-100 text-amber-700',
    'Discharged' => 'bg-slate-100 text-slate-600',
];
$wardColors = [
    'ICU'       => 'bg-red-100 text-red-700',
    'Emergency' => 'bg-teal-100 text-teal-700',
    'General'   => 'bg-blue-100 text-blue-700',
];
@endphp

<div class="flex flex-col gap-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Admissions</h2>
            <p class="text-body-md text-on-surface-variant">{{ $hospital ? $hospital->name : 'Your Facility' }} — Manage patient admissions and discharges.</p>
        </div>
        <button onclick="document.getElementById('admit-modal').classList.remove('hidden')"
            class="bg-secondary hover:bg-secondary/90 text-white font-bold py-2.5 px-5 rounded-xl shadow-sm flex items-center gap-2 transition-colors">
            <span class="material-symbols-outlined text-[20px]">person_add</span> New Admission
        </button>
    </div>

    <!-- Summary -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Currently Admitted</p>
            <p class="text-3xl font-bold text-emerald-600">{{ count(array_filter($admissions, fn($a) => $a['status'] === 'Admitted')) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Pending Approval</p>
            <p class="text-3xl font-bold text-amber-500">{{ count(array_filter($admissions, fn($a) => $a['status'] === 'Pending')) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Discharged Today</p>
            <p class="text-3xl font-bold text-slate-600">{{ count(array_filter($admissions, fn($a) => $a['status'] === 'Discharged')) }}</p>
        </div>
    </div>

    <!-- Admissions Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary">patient_list</span> All Admissions
            </h3>
            <div class="flex gap-2">
                <button onclick="filterAdmissions('all')" id="filter-all" class="filter-btn active-filter text-xs font-bold px-3 py-1 rounded-full bg-secondary text-white">All</button>
                <button onclick="filterAdmissions('Pending')" id="filter-pending" class="filter-btn text-xs font-bold px-3 py-1 rounded-full bg-slate-100 text-slate-600 hover:bg-amber-100 hover:text-amber-700">Pending</button>
                <button onclick="filterAdmissions('Admitted')" id="filter-admitted" class="filter-btn text-xs font-bold px-3 py-1 rounded-full bg-slate-100 text-slate-600 hover:bg-emerald-100 hover:text-emerald-700">Admitted</button>
                <button onclick="filterAdmissions('Discharged')" id="filter-discharged" class="filter-btn text-xs font-bold px-3 py-1 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200">Discharged</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="admissions-table">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Patient</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Ward / Bed</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Doctor</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Reason</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($admissions as $adm)
                    <tr class="hover:bg-slate-50 transition-colors admission-row" data-status="{{ $adm['status'] }}">
                        <td class="px-6 py-4 text-xs font-bold text-slate-500">{{ $adm['id'] }}</td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900 text-sm">{{ $adm['patient'] }}</p>
                            <p class="text-xs text-slate-400">Age {{ $adm['age'] }} • {{ $adm['date'] }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold px-2 py-1 rounded-full {{ $wardColors[$adm['ward']] }}">{{ $adm['ward'] }}</span>
                            <p class="text-xs text-slate-500 mt-1">Bed: {{ $adm['bed'] }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $adm['doctor'] }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 max-w-[180px]">{{ $adm['reason'] }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $statusColors[$adm['status']] }}">{{ $adm['status'] }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                @if($adm['status'] === 'Pending')
                                <button onclick="approveAdmission(this, '{{ $adm['id'] }}')"
                                    class="text-xs font-bold px-3 py-1.5 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">check</span> Approve
                                </button>
                                @elseif($adm['status'] === 'Admitted')
                                <button onclick="dischargePatient(this, '{{ $adm['id'] }}')"
                                    class="text-xs font-bold px-3 py-1.5 bg-slate-200 text-slate-700 rounded-lg hover:bg-red-100 hover:text-red-700 transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">logout</span> Discharge
                                </button>
                                @else
                                <span class="text-xs text-slate-400 italic">Completed</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- New Admission Modal -->
<div id="admit-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
        <div class="bg-slate-800 px-6 py-4 flex justify-between items-center">
            <h3 class="text-white font-bold text-lg">New Patient Admission</h3>
            <button onclick="document.getElementById('admit-modal').classList.add('hidden')" class="text-white/60 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 flex flex-col gap-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Patient Name</label>
                    <input type="text" placeholder="Full name" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Age</label>
                    <input type="number" placeholder="Age" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Ward</label>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none">
                        <option>ICU</option><option>Emergency</option><option>General</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Assigned Doctor</label>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none">
                        <option>Dr. Rajiv Sharma</option><option>Dr. Sneha Mehta</option><option>Dr. Amit Verma</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Reason for Admission</label>
                <textarea rows="2" placeholder="Diagnosis / reason..." class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none resize-none"></textarea>
            </div>
            <button onclick="addAdmission()" class="w-full bg-secondary text-white font-bold py-3 rounded-xl hover:bg-secondary/90 transition-colors shadow-md mt-2">
                Submit Admission Request
            </button>
        </div>
    </div>
</div>

<script>
function filterAdmissions(status) {
    document.querySelectorAll('.filter-btn').forEach(b => {
        b.classList.remove('bg-secondary','text-white');
        b.classList.add('bg-slate-100','text-slate-600');
    });
    const activeBtn = document.getElementById('filter-' + status.toLowerCase()) || document.getElementById('filter-all');
    activeBtn.classList.add('bg-secondary','text-white');
    activeBtn.classList.remove('bg-slate-100','text-slate-600');
    document.querySelectorAll('.admission-row').forEach(row => {
        row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
    });
}
function approveAdmission(btn, id) {
    const row = btn.closest('tr');
    row.querySelector('[data-status]') || (row.dataset.status = 'Admitted');
    row.dataset.status = 'Admitted';
    const statusCell = row.querySelectorAll('td')[5];
    statusCell.innerHTML = '<span class="text-xs font-bold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700">Admitted</span>';
    btn.parentElement.innerHTML = '<button class="text-xs font-bold px-3 py-1.5 bg-slate-200 text-slate-700 rounded-lg hover:bg-red-100 hover:text-red-700 transition-colors flex items-center gap-1" onclick="dischargePatient(this,\''+id+'\')"><span class="material-symbols-outlined text-[14px]">logout</span> Discharge</button>';
    showToast(id + ' approved & admitted!');
}
function dischargePatient(btn, id) {
    if (!confirm('Discharge patient from ' + id + '?')) return;
    const row = btn.closest('tr');
    row.dataset.status = 'Discharged';
    const statusCell = row.querySelectorAll('td')[5];
    statusCell.innerHTML = '<span class="text-xs font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-600">Discharged</span>';
    btn.parentElement.innerHTML = '<span class="text-xs text-slate-400 italic">Completed</span>';
    showToast('Patient discharged from ' + id);
}
function addAdmission() {
    document.getElementById('admit-modal').classList.add('hidden');
    showToast('Admission request submitted successfully!');
}
function showToast(msg) {
    const t = document.createElement('div');
    t.className = 'fixed bottom-6 right-6 z-[999] bg-secondary text-white font-bold px-5 py-3 rounded-xl shadow-xl flex items-center gap-2 transition-all';
    t.innerHTML = '<span class="material-symbols-outlined">check_circle</span>' + msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 2800);
}
document.getElementById('admit-modal').addEventListener('click', e => { if(e.target===e.currentTarget) e.currentTarget.classList.add('hidden'); });
</script>
@endsection
