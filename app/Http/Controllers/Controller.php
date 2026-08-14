<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\PrescriptionItem;
use Carbon\Carbon;
use DB;
abstract class Controller
{
  public function getAvailableDoctors(String $day, String $specialty)
 {
 

    }
}
