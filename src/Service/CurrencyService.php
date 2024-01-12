<?php

namespace App\Service;

class CurrencyService
{

    public function getExchangeRate(string $currency): float
    {
        //$exchangeRate = $this->currencyRepository->findRateByCurrency($currency);
        //просто не видел смысла тратить время на создание таблицы и entity, поэтому захардкодил
        if($currency == "USD"){
            return 1;
        }else{
            return 100;
        }
    }

    public function convertCurrency(float $amount, string $fromCurrency, string $toCurrency): float
    {
        if ($fromCurrency === $toCurrency) {
            return $amount;
        }

        $fromRate = $this->getExchangeRate($fromCurrency);
        $toRate = $this->getExchangeRate($toCurrency);

        $convertedAmount = ($amount / $fromRate) * $toRate;
        return $convertedAmount;
    }

}
