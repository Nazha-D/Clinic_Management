<?php

namespace App\Enums;

enum Specialities: string
{
    case GP='General Practice';
    case Pediatrics='Pediatrics';
    case Cardiology ='Cardiology';
    case Dermatology ='Dermatology';
    case Orthopedics ='Orthopedics';
    case Dentistry ='Dentistry';
    case Neurology ='Neurology';
    case Ophthalmology ='Ophthalmology';
    case Otolaryngology ='Otolaryngology';
    case Obstetrics='Obstetrics and Gynecology';
    case Psychiatry ='Psychiatry';

}
