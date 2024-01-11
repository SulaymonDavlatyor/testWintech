<?php

namespace App\Dto;

use App\Enum\Currency;
use App\Enum\TransactionType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ChangeBalanceDto
{
    #[Type('int')]
    private int $walletId;

    #[NotBlank(message: 'Transaction type is missing')]
    #[Type(TransactionType::class)]
    private TransactionType $transactionType;

    #[NotBlank(message: 'Amount is missing')]
    #[Type('string')]
    private string $amount;

    #[NotBlank(message: 'Currency is missing')]
    #[Type(Currency::class)]
    private Currency $currency;

    #[NotBlank(message: 'Reason is missing')]
    #[Type('string')]
    private string $reason;

    public function getWalletId(): int
    {
        return $this->walletId;
    }

    public function setWalletId(int $walletId): void
    {
        $this->walletId = $walletId;
    }

    public function getTransactionType(): string
    {
        return $this->transactionType->value;
    }

    public function setTransactionType(string $transactionType): void
    {
        $this->transactionType = TransactionType::from($transactionType);
    }

    public function getAmount(): string
    {
        //написал таким образом, так как в коде работаю с суммой оплаты
        //в виде инта, в строке только приходит и уходит
        return (int) $this->amount * 100;
    }

    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }

    public function getCurrency(): string
    {
        return $this->currency->value;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = Currency::from($currency);
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function setReason(string $reason): void
    {
        $this->reason = $reason;
    }
}