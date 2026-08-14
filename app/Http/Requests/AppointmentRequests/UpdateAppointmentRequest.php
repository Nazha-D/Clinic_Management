<?php

namespace App\Http\Requests\AppointmentRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\AppointmentStatus;
use Illuminate\Validation\Rule;
class UpdateAppointmentRequest extends FormRequest
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
         'appointment_date'=>['sometimes','date'],
         'appointment_time'=>['sometimes','date_format:H:i'],
        'status'=>['sometimes',Rule::enum(AppointmentStatus::class)],
        'notes'=>['sometimes','nullable','string']
        ];
    }
}
