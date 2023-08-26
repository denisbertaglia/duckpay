<?php

namespace App\Infrastructure\Financial;

use App\Domain\Financial\FinancialEntityRepository;
use App\Domain\User\Customer;
use App\Domain\User\Shopkeeper;
use PDO;

class PdoFinancialEntityRepository implements FinancialEntityRepository
{
    private PDO $pdo;
    public function __construct(Pdo $pdo)
    {
        $this->pdo = $pdo;
    }

    public function accountTransferCustomertoShopkeeper(Customer $customer, Shopkeeper $shopkeeper, string $amount): void
    {
        $customerBalance = $customer->getAccount()->getBalance();
        $shopkeeperBalance = $shopkeeper->getAccount()->getBalance();

        $customerBalance = bcsub($customerBalance ,$amount);
        $shopkeeperBalance = bcadd($shopkeeperBalance,$amount);

        $statemant = $this->pdo->prepare("UPDATE customers SET balance =:balance WHERE id= :id");
        $statemant->bindValue("balance",$customerBalance);
        $statemant->bindValue("id", $customer->getId());
        $statemant->execute();

        $statemant = $this->pdo->prepare("UPDATE shopkeepers SET balance =:balance WHERE id= :id");
        $statemant->bindValue("balance",$shopkeeperBalance);
        $statemant->bindValue("id", $shopkeeper->getId());
        $statemant->execute();
    }
}
