<?php

namespace App\Service;

use App\Dto\ChangeBalanceDto;
use App\Dto\GetBalanceDto;
use App\Enum\Currency;
use App\Exception\WalletException;
use App\Repository\TransactionRepository;
use App\Repository\WalletRepository;
use App\Strategy\CreditPayStrategy;
use App\Strategy\DebitPayStrategy;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class WalletService
{

    public function __construct(
        private WalletRepository $walletRepository,
        private TransactionService $transactionService,
        private CurrencyService $currencyService,
        private DecimalService $decimalService,
        private EntityManagerInterface $entityManager
    ){
    }

    public function getBalance(GetBalanceDto $dto){
        $wallet = $this->walletRepository->findOneBy(['id' => $dto->getWalletId()]);
        return $wallet->getBalance();
    }

    public function changeBalance(ChangeBalanceDto $dto){
        $amount = $dto->getAmount();
        $requestCurrency = $dto->getCurrency();
        $transactionType = $dto->getTransactionType();

        $wallet = $this->walletRepository->findOneBy(['id' => $dto->getWalletId()]);
        if($wallet->getCurrency() != $requestCurrency){
           $amount = $this->currencyService->convertCurrency($amount, $requestCurrency, $wallet->getCurrency());
        }

        //решил вынести в стратегии, так как типов потенциально
        //может стать больше
        $payStrategy = match($transactionType){
            'credit' =>  new CreditPayStrategy(),
            'debit' => new DebitPayStrategy(),
            default => throw WalletException::payStrategyNotFound($transactionType)
        };
        $currentBalance = $this->decimalService->decimalStringToInt($wallet->getBalance());

        $balance = $payStrategy->countBalance($amount, $currentBalance);
        $decimalBalance = $this->decimalService->intToStringDecimal($balance);
        $wallet->setBalance($decimalBalance);
        
        $this->entityManager->beginTransaction();
        $this->entityManager->persist($wallet);
        //я хотел здесь передавать дто, но не успеваю по срокам, поэтому оставил так
        $this->transactionService->createTransaction(
            $dto->getWalletId(),
            $dto->getTransactionType(),
            $amount,
            $requestCurrency,
            $dto->getReason()
        );

        $this->entityManager->flush();
        $this->entityManager->commit();
        return $wallet;
    }
}
