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

class PdoFinancialMovementQuery
{
    private Pdo $pdo;

    public function __construct(Pdo $pdo)
    {
        $this->pdo = $pdo;
    }
    public function consultTransferBetweenAccounts(User $user, int $offset = 0, int $limit = 10): array{
        if(is_null($user->getFinancialEntity()))
            throw new UserNoFinancialEntity("Financial Entity not found");

        $id = $user->getFinancialEntity()->getId();
        $sql = "SELECT ft.id,
                       ft.customer_id,
                       ft.shopkeeper_id,
                       ft.amount,
                       ft.created_at,
                       c.cpf,
                       s.cnpj,
                       c.balance as customer_balance,
                       s.balance as shopkeeper_balance
                FROM finacialtransfers as ft
                LEFT JOIN customers c on c.id = ft.customer_id
                LEFT JOIN shopkeepers s on s.id = ft.shopkeeper_id
                ";
        $type = $user->getType()->getName();
        if($type == "CUSTOMER"){
            $sql.= "WHERE ft.customer_id = :id ";
        }
        if($type == "SHOPKEEPER"){
            $sql.= "WHERE ft.shopkeeper_id = :id ";
        }
        $sql.= "LIMIT :limit OFFSET :offset ";
        $pdo = $this->pdo;
        $statement = $pdo->prepare($sql);
        $statement->bindValue( ':id' , $id,PDO::PARAM_INT);
        $statement->bindValue( ':limit' , $limit,PDO::PARAM_INT);
        $statement->bindValue( ':offset' , $offset,PDO::PARAM_INT);
        $statement->execute();
        return $this->hydrateFinancialMovement($statement);
    }
    private function hydrateFinancialMovement(PDOStatement $statement): array {
        $financialTransfersData = $statement->fetchAll();
        $financialTransfers = [];
        foreach ($financialTransfersData as $index => $finTransfer){
            $financialTransfers[] = Financialtransfer::make(
                $finTransfer['id'],
                Customer::make($finTransfer['customer_id'],$finTransfer['cpf'],$finTransfer['customer_balance']),
                Shopkeeper::make($finTransfer['shopkeeper_id'],$finTransfer['cnpj'],$finTransfer['shopkeeper_balance']),
                $finTransfer['amount'],
                $finTransfer['created_at']
            );
        }
        return $financialTransfers;
    }
}
