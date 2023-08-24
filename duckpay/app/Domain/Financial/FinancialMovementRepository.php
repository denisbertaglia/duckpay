<?php

namespace App\Domain\Financial;


use App\Domain\IdentifierCode;

interface FinancialMovementRepository
{
    public function  accountTransfer(IdentifierCode $idCustomer, IdentifierCode $idShopkeeper, string $amount): Financialtransfer;
}
