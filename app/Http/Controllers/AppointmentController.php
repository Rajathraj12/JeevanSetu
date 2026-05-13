<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $upcoming = \App\Models\Appointment::where('user_id', $user->id)
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        $past = \App\Models\Appointment::where('user_id', $user->id)
            ->whereIn('status', ['Completed', 'Cancelled'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();

        return view('patient.appointments', compact('upcoming', 'past'));
    }

    public function cancel($id)
    {
        $appointment = \App\Models\Appointment::findOrFail($id);
        if ($appointment->user_id == auth()->id()) {
            $appointment->status = 'Cancelled';
            $appointment->save();
        }
        return back()->with('success', 'Appointment cancelled successfully.');
    }

    public function reschedule(Request $request, $id)
    {
        // Placeholder for reschedule logic
        return back()->with('info', 'Reschedule feature coming soon.');
    }

    public function create()
    {
        return view('patient.book-appointment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_name' => 'required|string',
            'specialty' => 'required|string',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'location' => 'required|string',
        ]);

        \App\Models\Appointment::create([
            'user_id' => auth()->id(),
            'doctor_name' => $request->doctor_name,
            'specialty' => $request->specialty,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'location' => $request->location,
            'status' => 'Pending',
        ]);

        return redirect()->route('my-appointments')->with('success', 'Appointment booked successfully!');
    }
}
