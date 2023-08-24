<?php

namespace App\Infrastructure\Financial;

use App\Domain\Financial\FinancialMovementRepository;
use App\Domain\Financial\Financialtransfer;
use App\Domain\IdentifierCode;
use App\Domain\User\UserRepository;
use Pdo,PDOStatement;

class PdoFinancialMovementRepository implements FinancialMovementRepository
{
    private Pdo $pdo;
    private UserRepository $userRepository;

    public function __construct(Pdo $pdo, UserRepository $userRepository)
    {
        $this->pdo = $pdo;
        $this->userRepository = $userRepository;
    }
    public function accountTransfer(IdentifierCode $idCustomer, IdentifierCode $idShopkeeper, string $amount): Financialtransfer
    {
        $datetime = date_create()->format('Y-m-d H:i:s');
        $pdo = $this->pdo;

        $customer = $this->userRepository->findByIdCode($idCustomer)->getFinancialEntity();
        $shopkeeper = $this->userRepository->findByIdCode($idShopkeeper)->getFinancialEntity();

        $statement = $pdo->prepare(
            "INSERT INTO finacialtransfers (customer_id, shopkeeper_id, amount, created_at, updated_at) VALUES (:customerId, :shopkeeperId, :amount, :datetime, :datetime)"
        );
        $statement->bindValue('amount', $amount);
        $statement->bindValue('customerId', $customer->getId());
        $statement->bindValue('shopkeeperId', $shopkeeper->getId());
        $statement->bindValue('datetime', $datetime);

        $statement->execute();
        $id = $pdo->lastInsertId();

        return Financialtransfer::make($id, $customer, $shopkeeper, $amount);
    }
}
