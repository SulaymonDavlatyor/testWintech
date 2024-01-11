<?php

namespace App\Service;

class DecimalService
{
    public function decimalStringToInt(string $stringDecimal): int
    {
        $intValue = (int)($stringDecimal * 100);
        return $intValue;
    }

    public function intToStringDecimal(int $intValue): string
    {
        return number_format($intValue / 100, 2, '.', '');
    }
}