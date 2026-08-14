<?php

    namespace App\Http\Requests\InvoiceRequests;

    use App\Enums\PaymentStatus;
    use Illuminate\Contracts\Validation\ValidationRule;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

    class StoreInvoiceRequest extends FormRequest
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
                'appointment_id'=>['required',Rule::exists('appointments','id')->where(['doctor_id'=>$this->input('doctor_id'),'patient_id'=>$this->input('patient_id')])],
                'patient_id'=>['required',Rule::exists('patients','id')],
                'doctor_id'=>['required',Rule::exists('doctors','id')],
                'consultation_fee'=>['required','numeric','min:0'],
                'medicines_cost'=>['required','numeric','min:0'],
                'discount'=>['sometimes','numeric','min:0'],
                'tax'=>['sometimes','numeric','min:0'],
                'total'=>['required','numeric','min:0'],
                'payment_status'=>['required',Rule::enum(PaymentStatus::class)]

            ];
        }

public function withValidator(Validator $validator)
{
    $validator->after(function ($validator) {
       
        $consultation = (float) $this->input('consultation_fee', 0);
        $medicines    = (float) $this->input('medicines_cost', 0);
        $discount     = (float) $this->input('discount', 0);
        $tax          = (float) $this->input('tax', 0);
        $givenTotal   = (float) $this->input('total', 0);

        $expected = round($consultation + $medicines - $discount + $tax, 2);

       
        if (abs($expected - $givenTotal) > 0.01) {
            $validator->errors()->add('total', "Total Value is not same as expected:  {$expected}");
        }
    });
}
    }
