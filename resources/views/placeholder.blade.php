@extends('layouts.app')
@section('title', $title . ' - JeevanSetu')

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">{{ $title }}</h2>
            <p class="text-body-md text-on-surface-variant">Manage {{ strtolower($title) }} and related activities.</p>
        </div>
    </div>

    @php
        $user = auth()->user();
        $role = $user ? $user->role : session('role', 'patient');
        
        $rolePermissions = [
            'OPD Queue' => [
                'patient' => 'See own token & wait time only.',
                'admin' => 'See all patients, call next, manage queue.'
            ],
            'Bed Map' => [
                'patient' => 'See if beds are available (read only).',
                'admin' => 'Full control — mark free/occupied/cleaning.'
            ],
            'Admissions' => [
                'patient' => 'Fill and submit own admission.',
                'admin' => 'View all admissions, approve, assign bed.'
            ],
            'Inventory' => [
                'patient' => '❌ No access.',
                'admin' => 'Full access — reorder, edit stock.'
            ],
            'Doctor Schedule' => [
                'patient' => 'View only (which doctor is available).',
                'admin' => 'Full control — add/edit/remove shifts.'
            ],
            'Wait Board' => [
                'patient' => '✅ Full view.',
                'admin' => '✅ Full view.'
            ],
            'City Beds' => [
                'patient' => '✅ Can view & request transfer.',
                'admin' => '✅ Full control give acces like this for patient and doctors.'
            ]
        ];
        
        $permissionText = $rolePermissions[$title][$role] ?? 'Custom access for this module.';
    @endphp

    <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-12 text-center flex flex-col items-center justify-center min-h-[400px]">
        <div class="w-20 h-20 bg-secondary/10 rounded-full flex items-center justify-center mb-6 text-secondary">
            <span class="material-symbols-outlined text-4xl">vpn_key</span>
        </div>
        <h3 class="text-headline-sm font-bold text-on-surface mb-2">Role: {{ ucfirst($role) }}</h3>
        <p class="text-body-lg font-bold text-secondary max-w-md mx-auto mb-2">
            Access Level: {{ $permissionText }}
        </p>
        <p class="text-body-md text-on-surface-variant max-w-md mx-auto mb-8">
            The {{ $title }} module is currently being built exactly as per these permissions.
        </p>
        <a href="{{ route('dashboard') }}" class="bg-secondary hover:bg-secondary/90 text-white font-bold py-3 px-6 rounded-lg transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined">arrow_back</span>
            Return to Dashboard
        </a>
    </div>
</div>
@endsection
