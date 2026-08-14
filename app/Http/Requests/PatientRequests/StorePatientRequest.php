<?php

namespace App\Http\Requests\PatientRequests;

use App\Enums\BloodGroups;
use App\Enums\Gender;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StorePatientRequest extends FormRequest
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
        'first_name'=>['required','string','max:255'],
        'last_name'=>['required','string','max:255'],
        'date_of_birth'=>['required','date'],
        'gender'=>['required',Rule::enum(Gender::class)],
        'email'=>['sometimes','nullable','email',Rule::unique('patients','email')],
        'phone'=>['required','string'],
        'address'=>['required','string'],
        'blood_group'=>['required',Rule::Enum(BloodGroups::class)],
        'allergies'=>['sometimes','nullable','string'],
        'emergency_contact'=>['sometimes','nullable','string'],
        'active'=>['required','boolean']
        ];
    }
}
