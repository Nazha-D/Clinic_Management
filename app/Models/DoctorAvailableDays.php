<?php

namespace App\Models;

use App\Enums\WeekDays;
use Illuminate\Database\Eloquent\Model;

class DoctorAvailableDays extends Model
{
  protected $fillable=['doctor_id','day'];
  protected $casts = ['day'=>WeekDays::class];

  public function doctor()
  {
    return $this->belongsTo(Doctor::class);
  }
}
