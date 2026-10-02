<?php

namespace App\Http\Requests\PaymentRequests;

use App\Enums\PaymentMethods;
use App\Models\Invoice;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StorePaymentRequest extends FormRequest
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
           'invoice_id'=>['required',Rule::exists('invoices','id')],
           'amount'=>['required','numeric','min:1'],
           'payment_method'=>['required',Rule::enum(PaymentMethods::class)],
           'paid_at'=>['required','date']
        ];
    }

      public function withValidator(Validator $validator): void
    {
        $validator->after(function ($v) {
            if (! $this->hasAny(['invoice_id','amount'])) {
                return;
            }

            $invoice = Invoice::find($this->input('invoice_id'));
            if (! $invoice) {
                // Rule::exists should normally catch this; safe-guard
                return;
            }

           
            $paidSoFar = (float) $invoice->payments()->sum('amount');
            $outstanding = round((float) $invoice->total - $paidSoFar, 2);

            $amount = (float) $this->input('amount', 0);

            if ($amount - $outstanding > 0.01) {
                $v->errors()->add('amount', "Payment amount exceeds invoice outstanding ({$outstanding}).");
            }
        });
    }
}
