<?php

namespace App\Http\Requests\PrescriptionRequests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePrescriptionRequest extends FormRequest
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
                  'medical_record_id'=>['sometimes',Rule::exists('medical_records','id')],
        'items'=>['sometimes','array','min:1'],
       'items.*.medicine_name'   => ['required_with:items', 'string', 'distinct'],
            'items.*.dosage'          => ['required_with:items', 'string'],
            'items.*.frequency'       => ['required_with:items', 'string'],
            'items.*.duration'        => ['required_with:items', 'string'],
            'items.*.notes'           => ['sometimes', 'nullable', 'string'],
        ];
    }
}
