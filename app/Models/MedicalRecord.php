<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'user_id', 'title', 'type', 'status', 
        'record_date', 'doctor_name', 'hospital_name', 'file_path'
    ];
}
