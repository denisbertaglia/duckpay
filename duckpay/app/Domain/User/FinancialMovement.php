<?php

namespace App\Domain\User;

interface FinancialMovement
{
    public function  accountTransfer(Customer $customer, Shopkeeper $shopkeeper, string $amount):void;
}
