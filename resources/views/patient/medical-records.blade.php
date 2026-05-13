@extends('layouts.app')
@section('title', 'Medical Records - JeevanSetu')

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Medical Records</h2>
            <p class="text-body-md text-on-surface-variant">View and manage your health documents and test results.</p>
        </div>
        <button onclick="document.getElementById('upload-modal').classList.remove('hidden')" class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm flex items-center gap-2 transition-colors">
            <span class="material-symbols-outlined text-[18px]">upload</span>
            Upload Record
        </button>
    </div>

    @if(session('success'))
    <div class="bg-secondary/10 border border-secondary text-secondary px-4 py-3 rounded-lg flex items-center gap-2">
        <span class="material-symbols-outlined">check_circle</span>
        <p class="font-bold">{{ session('success') }}</p>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-500 text-red-600 px-4 py-3 rounded-lg flex flex-col gap-1">
        @foreach($errors->all() as $error)
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">error</span>
            <p class="font-bold text-sm">{{ $error }}</p>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-4 flex flex-col sm:flex-row gap-4 items-center border-l-4 border-l-secondary">
        <div class="relative flex-1 w-full">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
            <input type="text" placeholder="Search records, doctors, or hospitals..." class="w-full pl-10 pr-4 py-2 bg-surface-container-low border border-outline-variant/30 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-secondary transition-all">
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <select class="w-full sm:w-auto bg-surface-container-low border border-outline-variant/30 rounded-lg px-4 py-2 text-sm text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-secondary">
                <option>All Document Types</option>
                <option>Lab Report</option>
                <option>Prescription</option>
                <option>Discharge Summary</option>
                <option>Imaging</option>
            </select>
            <select class="w-full sm:w-auto bg-surface-container-low border border-outline-variant/30 rounded-lg px-4 py-2 text-sm text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-secondary">
                <option>Last 6 Months</option>
                <option>Last Year</option>
                <option>All Time</option>
            </select>
            <button class="w-full sm:w-auto px-4 py-2 border border-outline-variant/30 rounded-lg text-sm text-on-surface-variant flex items-center justify-center gap-1.5 hover:bg-slate-50 transition-colors">
                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                Filters
            </button>
        </div>
    </div>

    <!-- Records Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @php
            $iconMap = [
                'Lab Report' => ['icon' => 'science', 'bg' => 'bg-green-100', 'text' => 'text-green-700'],
                'Prescription' => ['icon' => 'medication', 'bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
                'Discharge Summary' => ['icon' => 'description', 'bg' => 'bg-orange-100', 'text' => 'text-orange-700'],
                'Imaging' => ['icon' => 'image', 'bg' => 'bg-purple-100', 'text' => 'text-purple-700'],
            ];

            $statusBadge = [
                'Normal' => ['bg' => 'bg-[#e5f6f2]', 'text' => 'text-[#006b55]'],
                'Requires Follow-up' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
            ];
        @endphp

        @forelse($records as $record)
        @php
            $iconTheme = $iconMap[$record->type] ?? ['icon' => 'article', 'bg' => 'bg-slate-100', 'text' => 'text-slate-700'];
            $badgeTheme = $statusBadge[$record->status] ?? null;
        @endphp
        <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-6 flex flex-col relative border-l-4 border-l-secondary h-full">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-10 h-10 rounded-lg {{ $iconTheme['bg'] }} flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined {{ $iconTheme['text'] }}">{{ $iconTheme['icon'] }}</span>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start gap-2">
                        <h4 class="text-body-lg font-bold text-on-surface leading-snug">{{ $record->title }}</h4>
                        @if($record->status && $badgeTheme)
                        <span class="px-2.5 py-0.5 {{ $badgeTheme['bg'] }} {{ $badgeTheme['text'] }} text-[10px] font-bold rounded shrink-0 whitespace-nowrap">{{ $record->status }}</span>
                        @endif
                    </div>
                    <p class="text-xs text-on-surface-variant mt-1">{{ $record->type }}</p>
                </div>
            </div>
            
            <hr class="border-outline-variant/20 mb-4">
            
            <div class="flex flex-col gap-2 mb-6">
                <div class="flex items-center gap-2 text-on-surface-variant">
                    <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                    <span class="text-xs">{{ \Carbon\Carbon::parse($record->record_date)->format('M d, Y') }}</span>
                </div>
                <div class="flex items-center gap-2 text-on-surface-variant">
                    <span class="material-symbols-outlined text-[16px]">person</span>
                    <span class="text-xs">{{ $record->doctor_name }}</span>
                </div>
                <div class="flex items-center gap-2 text-on-surface-variant">
                    <span class="material-symbols-outlined text-[16px]">local_hospital</span>
                    <span class="text-xs">{{ $record->hospital_name }}</span>
                </div>
            </div>
            
            <div class="mt-auto flex items-center gap-3">
                <button class="flex-1 py-2 bg-surface-container-low hover:bg-slate-200 text-on-surface font-bold text-sm rounded-lg transition-colors flex items-center justify-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                    View
                </button>
                <button class="flex-1 py-2 bg-surface-container-low hover:bg-slate-200 text-on-surface font-bold text-sm rounded-lg transition-colors flex items-center justify-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">download</span>
                    Download
                </button>
            </div>
        </div>
        @empty
        <div class="col-span-1 md:col-span-2 text-center py-12 bg-slate-50 rounded-xl border border-outline-variant/30">
            <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-2">description</span>
            <h3 class="text-body-lg font-bold text-on-surface">No records found</h3>
            <p class="text-on-surface-variant text-sm mt-1">Upload your first medical record to get started.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Upload Modal -->
<div id="upload-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h3 class="font-bold text-lg text-slate-800">Upload Medical Record</h3>
            <button onclick="document.getElementById('upload-modal').classList.add('hidden')" class="text-slate-400 hover:text-red-500 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form action="{{ route('medical-records.store') }}" method="POST" enctype="multipart/form-data" class="p-6 flex flex-col gap-4">
            @csrf
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Document Title</label>
                <input type="text" name="title" required placeholder="e.g. Blood Test Results" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Type</label>
                    <select name="type" required class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all">
                        <option value="Lab Report">Lab Report</option>
                        <option value="Prescription">Prescription</option>
                        <option value="Imaging">Imaging</option>
                        <option value="Discharge Summary">Discharge Summary</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Date</label>
                    <input type="date" name="record_date" required class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Doctor (Optional)</label>
                    <input type="text" name="doctor_name" placeholder="Dr. Name" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Hospital (Optional)</label>
                    <input type="text" name="hospital_name" placeholder="Hospital Name" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">File Attachment</label>
                <input type="file" name="document" required accept=".pdf,.jpg,.jpeg,.png" class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-secondary/10 file:text-secondary hover:file:bg-secondary/20 transition-all cursor-pointer">
                <p class="text-xs text-slate-500 mt-1">PDF, JPG, or PNG (Max 5MB)</p>
            </div>

            <button type="submit" class="w-full bg-secondary text-white font-bold py-3 rounded-xl mt-2 hover:bg-secondary/90 transition-colors shadow-md">
                Upload Document
            </button>
        </form>
    </div>
</div>
@endsection
