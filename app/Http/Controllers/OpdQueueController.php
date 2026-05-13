<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpdQueueController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = $user ? $user->role : session('role', 'patient');
        
        if ($role === 'admin') {
            return view('hospital.opd-queue', ['role' => $role]);
        }
        return view('patient.opd-queue', ['role' => $role]);
    }
}
