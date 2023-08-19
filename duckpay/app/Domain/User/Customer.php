<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

class Customer extends User
{
    private string $cpf;
    private Account $account;
    public function __construct(IdentifierCode $id,  string $name,  string $cpf, Account $account, array $emails = [])
    {
        parent::__construct( $id,  new UserType( UserType::TYPE['CUSTOMER']),  $name,  $emails);
        $this->cpf =$cpf;
        $this->account =$account;
    }
    public static function makeCustomer(string $id, string $name, string $cpf, array $emails = [], string  $accountBalance ='0'): Customer {
        return new Customer( new IdentifierCode($id), $name ,  $cpf, new Account($accountBalance), $emails);
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
