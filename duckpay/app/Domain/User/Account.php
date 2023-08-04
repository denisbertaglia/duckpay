<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

class Account
{
    private string $balance;
    public function __construct(string $balance = '0')
    {
        $this->balance = $balance;
    }
    public function getBalance(): string
    {
        return $this->balance;
    }
}
