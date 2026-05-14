<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Hospital;

class CityBedsController extends Controller
{
    public function index(Request $request)
    {
        $query = Hospital::query();

        $filter = $request->query('filter');
        
        if ($filter === 'near_me') {
            $query->orderBy('distance', 'asc');
        } elseif ($filter === 'insurance') {
            $query->where('type', 'Private');
        } elseif ($filter === 'rating') {
            $query->orderBy('general_beds_available', 'desc'); // Mock logic for rating
        } else {
            $query->orderBy('name');
        }

        $hospitals = $query->get();
        
        // Calculate dynamic stats
        $totalAvailable = $hospitals->sum(function($h) {
            return $h->icu_beds_available + $h->emergency_beds_available + $h->general_beds_available;
        });
        
        $icuCritical = $hospitals->where('icu_beds_available', '<=', 2)->count();

        $user = auth()->user();
        $role = $user ? $user->role : session('role', 'patient');
        
        // Use the unified view for both roles
        return view('hospital.city-beds', [
            'hospitals' => $hospitals,
            'role' => $role,
            'activeFilter' => $filter,
            'stats' => [
                'total_available' => number_format($totalAvailable),
                'icu_critical' => $icuCritical
            ]
        ]);
    }

    public function show($id)
    {
        $hospital = Hospital::findOrFail($id);
        return view('patient.hospital-details', compact('hospital'));
    }

    public function bookBed(Request $request, $id)
    {
        $hospital = Hospital::findOrFail($id);
        
        $type = $request->input('bed_type', 'General');
        
        if ($type === 'ICU' && $hospital->icu_beds_available > 0) {
            $hospital->decrement('icu_beds_available');
        } elseif ($type === 'Emergency' && $hospital->emergency_beds_available > 0) {
            $hospital->decrement('emergency_beds_available');
        } elseif ($type === 'General' && $hospital->general_beds_available > 0) {
            $hospital->decrement('general_beds_available');
        } else {
            return back()->with('error', "No {$type} beds available at this hospital.");
        }

        return redirect()->route('city-beds')->with('success', "Successfully booked a {$type} bed at {$hospital->name}. Please proceed to the hospital immediately.");
    }

    public function updateStatus(Request $request)
    {
        $user = auth()->user();
        if (!$user || !$user->hospital_id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $hospital = $user->hospital;
        $ward = $request->input('ward'); // ICU, EMG, GEN
        $action = $request->input('action'); // increment, decrement

        $column = match($ward) {
            'ICU' => 'icu_beds_available',
            'EMG' => 'emergency_beds_available',
            'GEN' => 'general_beds_available',
            default => null
        };

        if (!$column) {
            return response()->json(['error' => 'Invalid ward'], 400);
        }

        if ($action === 'increment') {
            $hospital->increment($column);
        } else {
            // Prevent going below 0
            if ($hospital->$column > 0) {
                $hospital->decrement($column);
            }
        }

        return response()->json(['success' => true, 'new_count' => $hospital->$column]);
    }
}
