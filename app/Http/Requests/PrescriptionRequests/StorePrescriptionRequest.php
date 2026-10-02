<?php

namespace App\Http\Requests\PrescriptionRequests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePrescriptionRequest extends FormRequest
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
           'medical_record_id'=>['required',Rule::exists('medical_records','id')],
        'items'=>['required','array','min:1'],
        'items.*.medicine_name'=>['required','string','distinct'],
        'items.*.dosage'=>['required','string'],
        'items.*.frequency'=>['required','string'],
         'items.*.duration'=>['required','string'],
          'items.*.notes'=>['nullable','string'],
        ];
    }
}
