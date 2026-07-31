<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
abstract class Controller
{
  public function getAvailableDoctors(String $day, String $specialty)
 {
    return Doctor::query()->join('doctor_available_days as dad','doctors.id','=','dad.doctor_id')
    ->when($specialty,function($query) use ($specialty){
      $query->where('doctors.speciality','Like','%'.$specialty.'%');
    })
    ->Where('dad.day','LIKE','%'.$day.'%')
    ->groupBy('doctors.id','doctors.name','doctors.speciality','doctors.consultation_fee')
    ->select('doctors.id','doctors.name','doctors.speciality','doctors.consultation_fee','dad.day')
 ;
    }
}
