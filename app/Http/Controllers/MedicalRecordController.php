<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $records = \App\Models\MedicalRecord::where('user_id', $user->id)
            ->orderBy('record_date', 'desc')
            ->get();

        return view('patient.medical-records', compact('records'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'record_date' => 'required|date',
            'doctor_name' => 'nullable|string|max:255',
            'hospital_name' => 'nullable|string|max:255',
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Max 5MB
        ]);

        // Mock upload processing
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            // Normally you would store this: $path = $file->store('medical_records', 'public');
            // But since this is a mock frontend demonstration, we'll just save the record to DB.
        }

        \App\Models\MedicalRecord::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'type' => $request->type,
            'record_date' => $request->record_date,
            'doctor_name' => $request->doctor_name ?? 'Self Uploaded',
            'hospital_name' => $request->hospital_name ?? 'Unknown',
            'status' => 'Normal', // Default mock status
        ]);

        return back()->with('success', 'Medical record uploaded successfully!');
    }
}
