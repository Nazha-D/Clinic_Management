    <?php

    namespace App\Http\Requests\PaymentRequests;

    use App\Enums\PaymentMethods;
    use App\Models\Invoice;
    use Illuminate\Contracts\Validation\ValidationRule;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;
    use Illuminate\Validation\Validator;

    class UpdatePaymentRequest extends FormRequest
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
                'invoice_id'=>['sometimes',Rule::exists('invoices','id')],
            'amount'=>['sometimes','numeric','min:1'],
            'payment_method'=>['sometimes',Rule::enum(PaymentMethods::class)],
            'paid_at'=>['sometimes','date']
            ];
        }
        public function withValidator(Validator $validator): void
        {
        $validator->after(function ($v) {
        
            if (! $this->hasAny(['invoice_id','amount'])) {
                return;
            }

    
            $payment = $this->route('payment');
            if (! $payment) {
                return;
            }

            
            $targetInvoiceId = $this->has('invoice_id') ? $this->input('invoice_id') : $payment->invoice_id;
            $invoice =Invoice::find($targetInvoiceId);
            if (! $invoice) {
            
                return;
            }


            $totalPaidOnTarget = (float) $invoice->payments()->sum('amount');

        
            $paidExceptThis = $totalPaidOnTarget;
            if ($payment->invoice_id == $invoice->id) {
                $paidExceptThis = max(0, $totalPaidOnTarget - (float) ($payment->amount ?? 0));
            }

            $outstanding = round((float) $invoice->total - $paidExceptThis, 2);

        
            if ($this->has('amount')) {
                $amount = (float) $this->input('amount', 0);
                if ($amount - $outstanding > 0.01) {
                    $v->errors()->add('amount', "Payment amount exceeds invoice outstanding ({$outstanding}).");
                }
            }
        });
        }
    }
