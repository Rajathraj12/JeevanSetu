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
        $user = auth()->user();
        $role = $user ? $user->role : session('role', 'patient');
        
        if ($role === 'admin') {
            return view('hospital.city-beds', [
                'hospitals' => $hospitals,
                'role' => $role,
                'activeFilter' => $filter
            ]);
        }
        return view('patient.city-beds', [
            'hospitals' => $hospitals,
            'role' => $role,
            'activeFilter' => $filter
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
}
