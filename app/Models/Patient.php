<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\BloodGroups;
use App\Enums\Gender;

class Patient extends Model
{
    protected $fillable = [
        'first_name','last_name','date_of_birth','gender',
        'email','phone','address','blood_group','allergies','emergency_contact','active'
    ];
    protected $casts = ['active'=>'boolean',
                        'blood_group'=>BloodGroups::class,
                         'gender'=>Gender::class,
                         'date_of_birth'=>'date'
                             
    ];

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
    
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function prescriptions()
{
    return $this->hasManyThrough(
       Prescription::class,
       MedicalRecord::class,
        'patient_id',       // foreign key on medical_records table...
        'medical_record_id',// foreign key on prescriptions table...
        'id',               // local key on patients
        'id'                // local key on medical_records
    );
}
    
}

