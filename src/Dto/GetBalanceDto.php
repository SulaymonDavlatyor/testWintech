<?php

namespace App\Dto;

class GetBalanceDto
{
    private int $walletId;

    public function getWalletId(): int
    {
        return $this->walletId;
    }

    public function setWalletId(int $walletId): void
    {
        $this->walletId = $walletId;
    }

}