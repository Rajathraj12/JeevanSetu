@extends('layouts.app')
@section('title', 'OPD Queue Management - JeevanSetu')

@section('content')
@php
    $user = auth()->user();
    $patientName = session('name', 'Patient'); // for mock data
@endphp

<div class="flex flex-col gap-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">OPD Queue Management</h2>
            <p class="text-body-md text-on-surface-variant">Live token status and queue control.</p>
        </div>
    </div>

    <!-- ADMIN VIEW: Manage Queue -->
    <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="p-6 border-b border-outline-variant/30 flex flex-col md:flex-row gap-4 justify-between md:items-center bg-slate-50/50">
            <div>
                <h3 class="text-headline-sm font-bold text-on-surface">Live Queue Control</h3>
                <p class="text-sm text-slate-500 mt-1">Cardiology Department • Room 104</p>
            </div>
            <button class="bg-secondary hover:bg-secondary/90 text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5 flex items-center gap-2">
                <span class="material-symbols-outlined">campaign</span> Call Next Patient
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 text-sm border-b border-outline-variant/30">
                        <th class="p-5 font-medium tracking-wide">Token</th>
                        <th class="p-5 font-medium tracking-wide">Patient Name</th>
                        <th class="p-5 font-medium tracking-wide">Status</th>
                        <th class="p-5 font-medium tracking-wide">Wait Time</th>
                        <th class="p-5 font-medium tracking-wide text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-5 font-bold text-primary-container text-lg">T-38</td>
                        <td class="p-5 text-slate-700 font-medium">Ramesh Kumar</td>
                        <td class="p-5">
                            <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold border border-amber-200">Calling</span>
                        </td>
                        <td class="p-5 text-slate-500 font-medium">0 mins</td>
                        <td class="p-5 text-right">
                            <button class="text-secondary hover:text-secondary-fixed font-bold text-sm bg-secondary/10 px-4 py-2 rounded-lg transition-colors border border-secondary/20">Complete</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-5 font-bold text-slate-700 text-lg">T-39</td>
                        <td class="p-5 text-slate-700 font-medium">Priya Singh</td>
                        <td class="p-5">
                            <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-bold border border-slate-200">Waiting</span>
                        </td>
                        <td class="p-5 text-slate-500 font-medium">5 mins</td>
                        <td class="p-5 text-right">
                            <button class="text-secondary hover:text-secondary-fixed font-bold text-sm px-4 py-2 hover:bg-slate-100 rounded-lg transition-colors">Call</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-5 font-bold text-slate-700 text-lg">T-40</td>
                        <td class="p-5 text-slate-700 font-medium">Amit Patel</td>
                        <td class="p-5">
                            <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-bold border border-slate-200">Waiting</span>
                        </td>
                        <td class="p-5 text-slate-500 font-medium">8 mins</td>
                        <td class="p-5 text-right">
                            <button class="text-secondary hover:text-secondary-fixed font-bold text-sm px-4 py-2 hover:bg-slate-100 rounded-lg transition-colors">Call</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors bg-secondary/5">
                        <td class="p-5 font-bold text-primary-container text-lg flex items-center gap-2">T-42 <span class="w-2 h-2 bg-secondary rounded-full"></span></td>
                        <td class="p-5 text-primary-container font-bold">{{ ucfirst($patientName) }}</td>
                        <td class="p-5">
                            <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-bold border border-slate-200">Waiting</span>
                        </td>
                        <td class="p-5 text-slate-500 font-medium">15 mins</td>
                        <td class="p-5 text-right">
                            <button class="text-secondary hover:text-secondary-fixed font-bold text-sm px-4 py-2 hover:bg-slate-100 rounded-lg transition-colors">Call</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
