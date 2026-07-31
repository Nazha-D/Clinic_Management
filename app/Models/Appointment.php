<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'doctor_id','patient_id','appointment_date','appointment_time',
        'status','notes'
    ];

    protected $casts = [
        'appointment_date'=>'date',
        'status'=>AppointmentStatus::class
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

     public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

     public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }
     public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
