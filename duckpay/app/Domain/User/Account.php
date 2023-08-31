<?php

namespace App\Domain\User;

use App\Domain\Financial\Money;
use App\Domain\IdentifierCode;

class Account
{
    private Money $balance;
    public function __construct(string $balance = '0')
    {
        $this->balance = new Money($balance);
    }
    public function getBalance(): string
    {
        return $this->balance->value();
    }
}
