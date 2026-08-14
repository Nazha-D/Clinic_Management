<?php

namespace App\Http\Requests\AppointmentRequests;

use App\Enums\AppointmentStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreAppointmentRequest extends FormRequest
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
         'doctor_id'=>['required',Rule::exists('doctors','id')],
         'patient_id'=>['required',Rule::exists('patients','id')],
         'appointment_date'=>['required','date'],
         'appointment_time'=>['required','date_format:H:i'],
        'status'=>['required',Rule::enum(AppointmentStatus::class)],
        'notes'=>['sometimes','nullable','string']
        ];
    }
}
