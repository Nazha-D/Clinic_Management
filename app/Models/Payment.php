<?php

namespace App\Models;

use App\Enums\PaymentMethods;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'invoice_id','amount','payment_method','paid_at'
    ];
    protected $casts = [
        'payment_method'=>PaymentMethods::class
    ];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
