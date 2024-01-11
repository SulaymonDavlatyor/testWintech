<?php

namespace App\Entity;

use App\Enum\Currency;
use App\Repository\WalletRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: WalletRepository::class)]
class Wallet implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(type: 'string', enumType: Currency::class)]
    public Currency $currency;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $balance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency->value;
    }

    public function setCurrency(String $currency): void
    {
        $this->currency = Currency::from($currency);
    }

    public function getBalance(): ?string
    {
        return $this->balance;
    }

    public function setBalance(string $balance): static
    {
        $this->balance = $balance;
        return $this;
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'balance'=> $this->balance,
            'currency'=> $this->currency
        );
    }
}
