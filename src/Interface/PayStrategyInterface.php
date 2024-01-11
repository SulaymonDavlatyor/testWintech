<?php

namespace App\Interface;

interface PayStrategyInterface
{
    public function countBalance(int $amount, int $currentBalance): int;
}