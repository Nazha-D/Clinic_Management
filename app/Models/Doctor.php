<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Specialities;
class Doctor extends Model
{
   protected $fillable=[
        'user_id','name','specialty','consultation_fee'
    ];

 protected $casts = [
        'specialty' => Specialities::class, 
        'consultation_fee' => 'decimal:2',
    ]; 
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function availableDays()
  {
    return $this->hasMany(DoctorAvailableDays::class);
  }
  public function appointments()
  {
    return $this->hasMany(Appointment::class);
  }
 
  
   public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
     public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
