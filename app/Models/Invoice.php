<?php

namespace App\Models;

use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  protected $fillable = [
    'appointment_id','patient_id','doctor_id','consultation_fee','medicines_cost'
    ,'discount','tax','total','payment_status'
  ];

  protected $casts = [
    'payment_status'=>PaymentStatus::class
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

  public function payments()
  {
    return $this->hasMany(Payment::class);
  }
}
