<?php

namespace App\Service;

use App\Entity\Transaction;
use App\Enum\TransactionReason;
use App\Repository\TransactionRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class TransactionService
{

    public function __construct(
        private EntityManagerInterface $entityManager
    ){
    }

    public function createTransaction(
        $walletId,
        $transactionType,
        $amount,
        $currency,
        $reason
    ): Transaction {
        $transaction = new Transaction();

        $transaction->setWalletId($walletId);
        $transaction->setTransactionType($transactionType);
        $transaction->setAmount($amount);
        $transaction->setCurrency($currency);
        $transaction->setReason($reason);
        $transaction->setCreatedAt(new DateTime());

        // Сохранение транзакции в базе данных
        $this->entityManager->persist($transaction);
        $this->entityManager->flush();

        return $transaction;
    }
}