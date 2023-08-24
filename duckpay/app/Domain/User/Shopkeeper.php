<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

/**
 * @property string $name
 */
class Shopkeeper  implements  FinancialEntity
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
    public static function make(string $id, string $cnpj, string $accountBalance ='0'): Shopkeeper {
        return new Shopkeeper( new IdentifierCode($id), $cnpj,  new Account($accountBalance));
    }
    /**
     * @return string
     */
    public function getCnpj(): string
    {
        return $this->taxpayer;
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
        return "CNPJ";
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
