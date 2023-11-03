<?php

namespace App\Infrastructure\Financial;

use App\Domain\Financial\FinancialMovementRepository;
use App\Domain\Financial\Financialtransfer;
use App\Domain\Financial\UserNoFinancialEntity;
use App\Domain\User\Customer;
use App\Domain\User\Shopkeeper;
use App\Domain\User\User;
use App\Domain\User\UserRepository;
use Pdo,PDOStatement;

class PdoFinancialMovementRepository implements FinancialMovementRepository
{
    private Pdo $pdo;

    public function __construct(Pdo $pdo)
    {
        $this->pdo = $pdo;
    }
    public function registerTransferAccountsCustomersShopkeeper(Customer $customer, Shopkeeper $shopkeeper, string $amount): Financialtransfer
    {
        $datetime = date_create()->format('Y-m-d H:i:s');
        $pdo = $this->pdo;

        $statement = $pdo->prepare(
            "INSERT INTO finacialtransfers (customer_id, shopkeeper_id, amount, created_at, updated_at) VALUES (:customerId, :shopkeeperId, :amount, :datetime, :datetime)"
        );
        $statement->bindValue('amount', $amount);
        $statement->bindValue('customerId', $customer->getId());
        $statement->bindValue('shopkeeperId', $shopkeeper->getId());
        $statement->bindValue('datetime', $datetime);

        $statement->execute();
        $id = $pdo->lastInsertId();

        return Financialtransfer::make($id, $customer, $shopkeeper, $amount, $datetime);
    }
}
