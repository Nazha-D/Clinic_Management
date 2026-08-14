<?php

namespace App\Http\Requests\DoctorRequests;

use App\Enums\WeekDays;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreDoctorDaysRequest extends FormRequest
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
        'doctor_id'=>['required', Rule::exists('doctors','id')],
        'day'=>['required',Rule::enum(WeekDays::class), Rule::unique('doctor_available_days')
        ->where(fn($query) =>
            $query->where('doctor_id', $this->input('doctor_id'))
        )]
        ];
    }
}
