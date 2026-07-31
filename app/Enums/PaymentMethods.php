<?php

namespace App\Enums;

enum PaymentMethods:string
{
    case Cash='Cash';
    case Transfer='Transfer';
    case Card='Card';
}
