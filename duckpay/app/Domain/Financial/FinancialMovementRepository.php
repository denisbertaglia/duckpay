<?php

namespace App\Domain\Financial;


use App\Domain\IdentifierCode;

interface FinancialMovementRepository
{
    public function  accountTransferRecord(IdentifierCode $idCustomer, IdentifierCode $idShopkeeper, string $amount): Financialtransfer;
}
