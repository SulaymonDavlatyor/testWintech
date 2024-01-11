<?php

namespace App\Enum;

enum TransactionReason: string
{
    case REFUND = "refund";
    case STOCK = "stock";
}