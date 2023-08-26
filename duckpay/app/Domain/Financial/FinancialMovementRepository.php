<?php

namespace App\Domain\Financial;


use App\Domain\IdentifierCode;
use App\Domain\User\Customer;
use App\Domain\User\Shopkeeper;

interface FinancialMovementRepository
{
    public function  registerTransferAccountsCustomersShopkeeper(Customer $customer, Shopkeeper $shopkeeper, string $amount): Financialtransfer;
}
