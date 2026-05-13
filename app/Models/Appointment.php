<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id', 'doctor_name', 'specialty', 'status', 
        'appointment_date', 'appointment_time', 'location'
    ];
}
