<?php

namespace App\Enums;

enum InvoiceStatus: string
{
    case PAID = 'paid';
    case PARTIALLY_PAID = 'partially_paid';
    case UNPAID = 'unpaid';
}
