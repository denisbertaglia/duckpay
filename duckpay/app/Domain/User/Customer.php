<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

class Customer extends User
{
    private string $cpf;
    private Account $account;
    public function __construct(IdentifierCode $id,  string $name, array $emails, string $cpf, Account $account)
    {
        parent::__construct( $id,  new UserType( UserType::TYPE['CUSTOMER']),  $name,  $emails);
        $this->cpf =$cpf;
        $this->account =$account;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }
}
