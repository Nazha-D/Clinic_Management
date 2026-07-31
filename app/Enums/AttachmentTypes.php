<?php

namespace App\Enums;

enum AttachmentTypes:string
{
    case Image='image';
    case Report='report';
    case BloodTest='bloodTest';
}
