<?php

namespace App\Http\Requests\InvoiceRequests;

  use App\Enums\PaymentStatus;
    use Illuminate\Contracts\Validation\ValidationRule;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
class UpdateInvoiceRequest extends FormRequest
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
          'appointment_id'=>['sometimes',Rule::exists('appointments','id')->where(['doctor_id'=>$this->input('doctor_id'),'patient_id'=>$this->input('patient_id')])],
                'patient_id'=>['sometimes',Rule::exists('patients','id')],
                'doctor_id'=>['sometimes',Rule::exists('doctors','id')],
                'consultation_fee'=>['sometimes','numeric','min:0'],
                'medicines_cost'=>['sometimes','numeric','min:0'],
                'discount'=>['sometimes','numeric','min:0'],
                'tax'=>['sometimes','numeric','min:0'],
                'total'=>['sometimes','numeric','min:0'],
                'payment_status'=>['sometimes',Rule::enum(PaymentStatus::class)]
        ];
    }

public function withValidator(Validator $validator)
{
    $validator->after(function ($validator) {
         if (! $this->hasAny(['consultation_fee','medicines_cost','discount','tax','total'])) {
            return;
         }
       
       $invoice = $this->route('invoice');

          
            $consultation = $this->has('consultation_fee')
                ? (float) $this->input('consultation_fee')
                : (float) ($invoice->consultation_fee ?? 0);

            $medicines = $this->has('medicines_cost')
                ? (float) $this->input('medicines_cost')
                : (float) ($invoice->medicines_cost ?? 0);

            $discount = $this->has('discount')
                ? (float) $this->input('discount')
                : (float) ($invoice->discount ?? 0);

            $tax = $this->has('tax')
                ? (float) $this->input('tax')
                : (float) ($invoice->tax ?? 0);

            $givenTotal = $this->has('total')
                ? (float) $this->input('total')
                : null; 

            $expected = round($consultation + $medicines - $discount + $tax, 2);

          
            if (! is_null($givenTotal) && abs($expected - $givenTotal) > 0.01) {
                $validator->errors()->add('total', "Total Value is not same as expected: {$expected}");
            }
        });
  
}

}
