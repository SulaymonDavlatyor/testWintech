<?php

namespace App\Strategy;

use App\Interface\PayStrategyInterface;

class CreditPayStrategy implements PayStrategyInterface
{
    //исходил из того, что кредитовые оплаты позволяют уходить в минус
    public function countBalance(int $amount, int $currentBalance): int
    {
        return $currentBalance + $amount;
    }
}