<?php

namespace App\Application\Financial;


use App\Application\Pagination;
use App\Domain\Financial\Financialtransfer;
use App\Domain\IdentifierCode;
use App\Domain\User\UserRepository;
use App\Infrastructure\Financial\PdoFinancialMovementQuery;

class FinancialService
{
    private UserRepository $userRepository;
    private PdoFinancialMovementQuery $financialMovementQuery;
    public function __construct(UserRepository $userRepository, PdoFinancialMovementQuery $financialMovementQuery)
    {
        $this->financialMovementQuery = $financialMovementQuery;
        $this->userRepository = $userRepository;
    }
    public function listUserAccountTrasactionHistory(int $userId, int $page=1, int $pageSize=10): array{
        $user = $this->userRepository->findByIdCode(new IdentifierCode($userId));
        $pagination = new Pagination($page, $pageSize);
        $financialMovement = $this->financialMovementQuery->consultTransferBetweenAccounts($user, $pagination->getOffset(), $pagination->getLimit());

        return array_map(function (Financialtransfer $financial){
            return new FinancialtransferDTO(
                $financial->getId(),
                $financial->getAmount()->value(),
                $financial->getPayeer()->getTaxpayer(),
                $financial->getPayee()->getTaxpayer(),
                $financial->getDateTime()->format('Y-m-d H:i:s'),
            );
        }, $financialMovement);
    }
}
