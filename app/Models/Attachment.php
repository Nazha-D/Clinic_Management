<?php

namespace App\Models;

use App\Enums\AttachmentTypes;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
 protected $fillable = [
    'medical_record_id','file_path','file_type'
 ];
 protected $casts = [
   'file_type'=>AttachmentTypes::class
 ];

 public function medicalRecord()
 {
    return $this->belongsTo(MedicalRecord::class);
 }
}
