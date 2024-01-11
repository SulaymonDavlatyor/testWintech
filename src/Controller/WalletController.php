<?php

namespace App\Controller;

use App\Dto\ChangeBalanceDto;
use App\Dto\GetBalanceDto;
use App\Entity\Wallet;
use App\Enum\Currency;
use App\Repository\WalletRepository;
use App\Service\WalletService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class WalletController extends AbstractController
{
    public function __construct(
        private WalletService $walletService
    ){
    }
    #[Route('/wallet/{id}/balance', name: 'app_wallet_balance', methods: "GET")]
    public function getBalance(Request $request, int $id): Response {
        $getBalanceDto = new GetBalanceDto();
        $getBalanceDto->setWalletId($id);

        $balance = $this->walletService->getBalance($getBalanceDto);
        return new Response(json_encode([
            'balance' => $balance
        ]));
    }

    #[Route('/wallet/{id}', name: 'app_wallet', methods: "PATCH")]
    public function changeBalance(int $id,
        #[MapRequestPayload] ChangeBalanceDto $changeBalanceDto
    ): Response {
        $changeBalanceDto->setWalletId($id);
        $wallet = $this->walletService->changeBalance($changeBalanceDto);
        return new Response(json_encode($wallet));
    }
}
