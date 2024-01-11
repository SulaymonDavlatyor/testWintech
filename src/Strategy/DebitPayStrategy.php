<?php

namespace App\Strategy;

use App\Exception\WalletException;
use App\Interface\PayStrategyInterface;

class DebitPayStrategy implements PayStrategyInterface
{

    //как я понял, дебитовые оплаты не позволяют уйти в минус
    //сделал соответсвенно
    public function countBalance(int $amount, int $currentBalance): int
    {
        $result = $currentBalance + $amount;
        //условие такое, чтобы позволить добавить денег на счет при негативном балансе
        //и не дать уйти в минус
        if($result < 0 && $result < $currentBalance){
            throw WalletException::notEnoughMoney();
        }
        return $result;
    }
}