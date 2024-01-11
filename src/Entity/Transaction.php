<?php

namespace App\Entity;

use App\Enum\Currency;
use App\Enum\TransactionReason;
use App\Enum\TransactionType;
use App\Repository\TransactionRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $wallet_id = null;

    #[ORM\Column(type: 'string', enumType: TransactionType::class)]
    private TransactionType $transaction_type;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $amount = null;

    #[ORM\Column(type: 'string', enumType: Currency::class)]
    public Currency $currency;

    #[ORM\Column(type: 'string', enumType: TransactionReason::class)]
    public TransactionReason $reason;

    #[ORM\Column(type: 'datetime')]
    private DateTime $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWalletId(): ?int
    {
        return $this->wallet_id;
    }

    public function setWalletId(int $wallet_id): static
    {
        $this->wallet_id = $wallet_id;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTransactionType(): string
    {
        return $this->transaction_type->value;
    }

    public function setTransactionType(string $transaction_type): void
    {
        $this->transaction_type = TransactionType::from($transaction_type);
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
        return $this->reason->value;
    }

    public function setReason(string $reason): void
    {
        $this->reason = TransactionReason::from($reason);
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
