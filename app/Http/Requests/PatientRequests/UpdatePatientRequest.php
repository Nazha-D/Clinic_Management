<?php

namespace App\Http\Requests\PatientRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BloodGroups;
use App\Enums\Gender;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
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
        $routePatient=$this->route('patient');
        $id=$routePatient instanceof \App\Models\Patient ? $routePatient->id:$routePatient;
        return [
        'first_name'=>['sometimes','string','max:255'],
        'last_name'=>['sometimes','string','max:255'],
        'date_of_birth'=>['sometimes','date'],
        'gender'=>['sometimes',Rule::enum(Gender::class)],
        'email'=>['sometimes','email',Rule::unique('patients','email')->ignore($id)],
        'phone'=>['sometimes','string'],
        'address'=>['sometimes','string'],
        'blood_group'=>['sometimes',Rule::Enum(BloodGroups::class)],
        'allergies'=>['sometimes'],
        'emergency_contact'=>['sometimes'],
        'active'=>['sometimes','boolean']
        ];
    }
}
