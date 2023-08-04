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
    public function __construct(IdentifierCode $id, string $name, array $emails, string $cnpj, Account $account)
    {
        parent::__construct( $id,  new UserType( UserType::TYPE['SHOPKEEPER']),  $name,  $emails);
        $this->cnpj =$cnpj;
        $this->account =$account;
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
