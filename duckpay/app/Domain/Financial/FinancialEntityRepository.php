<?php

namespace App\Domain\Financial;

use App\Domain\User\Customer;
use App\Domain\User\Shopkeeper;

interface FinancialEntityRepository
{
    public function  accountTransferCustomertoShopkeeper(Customer $customer, Shopkeeper $shopkeeper, string $amount): void;

}
