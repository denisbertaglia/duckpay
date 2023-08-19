<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

/**
 * @property string $name
 */
class Shopkeeper extends User
{
    private string $cnpj;
    private Account $account;
    public function __construct(IdentifierCode $id, string $name, string $cnpj, Account $account, array $emails = [])
    {
        parent::__construct( $id,  new UserType( UserType::TYPE['SHOPKEEPER']),  $name,  $emails);
        $this->cnpj =$cnpj;
        $this->account =$account;
    }
    public static function makeShopkeeper(string $id, string $name,  string $cnpj, array $emails = [], string $accountBalance ='0'): Shopkeeper {
        return new Shopkeeper( new IdentifierCode($id), $name , $cnpj,  new Account($accountBalance), $emails);
    }
    /**
     * @return string
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }


    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }
}
