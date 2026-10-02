<?php

namespace App\Http\Requests\MedicalRecordRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMedicalRecord extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'doctor_id'=>['sometimes',Rule::exists('doctors','id')],
             'patient_id'=>['sometimes',Rule::exists('patients','id')],
             'appointment_id'=>['sometimes',Rule::exists('appointments','id')],
             'symptoms'=>['sometimes','string'],
             'diagnosis'=>['sometimes','string'],
             'notes'=>['sometimes','string'],
        ];
    }
}
