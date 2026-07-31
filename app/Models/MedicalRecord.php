<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
   protected $fillable = [
    'doctor_id','patient_id','appointment_id','symptoms','diagnosis','notes'
   ];

   
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

     public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

      public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
 public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    
}
