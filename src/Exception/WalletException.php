<?php

namespace App\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class WalletException extends RuntimeException
{
    const TYPE_NOT_MATCHED = "Pay strategy %s not found";
    const NOT_ENOUGH_MONEY = "Not enough money";

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function payStrategyNotFound(string $type): WalletException
    {
        $message = sprintf(self::TYPE_NOT_MATCHED, $type);
        return new WalletException($message, Response::HTTP_BAD_REQUEST);
    }

    public static function notEnoughMoney(): WalletException
    {
        return new WalletException(self::NOT_ENOUGH_MONEY, Response::HTTP_BAD_REQUEST);
    }

}