<?php

namespace App\Http\Requests\DoctorRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Specialities;
use Illuminate\Http\Request;

class UpdateDoctorRequest extends FormRequest
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
       $routeDoctor = $this->route('doctor');
        $id = $routeDoctor instanceof \App\Models\Doctor ? $routeDoctor->id : $routeDoctor;

        return [
          'user_id'=>['sometimes',Rule::exists('users','id'),Rule::unique('doctors','user_id')->ignore($id)],
            'name'=>['sometimes','string','max:255'],
            'specialty'=>['sometimes','string',new Enum(Specialities::class)],
            'consultation_fee'=>['sometimes','numeric','min:0']
        ];
    }
}
