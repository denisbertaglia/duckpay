<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

class Customer implements  FinancialEntity
{
    private IdentifierCode $id;
    private string $taxpayer;
    private Account $account;
    public function __construct(IdentifierCode $id, string $taxpayer, Account $account)
    {
        $this->id = $id;
        $this->taxpayer = $taxpayer;
        $this->account = $account;
    }
    public static function make(string $id,  string $taxpayer, string  $accountBalance ='0'): Customer {
        return new Customer( new IdentifierCode($id), $taxpayer, new Account($accountBalance));
    }
    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    public function getTaxpayer(): string
    {
        return $this->taxpayer;
    }

    public function getTaxpayerType(): string
    {
        return 'CPF';
    }

    public function getId(): string
    {
        return $this->id->code();
    }

    public function setId(string $id): void
    {
        $this->id = new IdentifierCode($id);
    }
}
