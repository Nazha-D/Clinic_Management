<?php

namespace App\Http\Requests\DoctorRequests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Specialities;
class StoreDoctorRequest extends FormRequest
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
            'user_id'=>['required',Rule::exists('users','id'),Rule::unique('doctors','user_id')],
            'name'=>['required','string','max:255'],
            'specialty'=>['required','string',new Enum(Specialities::class)],
            'consultation_fee'=>['required','numeric','min:0']
        ];
    
    }
}
