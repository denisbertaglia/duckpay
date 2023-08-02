<?php

namespace App\Domain\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;
use App\Domain\Login\Login;

class Customer
{
    private IdentifierCode $id;
    private Login $login;
    private string $name;
    private array $emails;
    private string $cpf;
    private string $balance;
    public function __construct(IdentifierCode $id,Login $login, string $name, array $emails, string $cpf, string $balance ='0')
    {
        $this->id =$id;
        $this->login =$login;
        $this->name =$name;
        $this->emails =$emails;
        $this->cpf =$cpf;
        $this->balance =$balance;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function emails(): array
    {
        return $this->emails;
    }

    /**
     * @return string
     */
    public function cpf(): string
    {
        return $this->cpf;
    }

    /**
     * @return string
     */
    public function balance(): string
    {
        return $this->balance;
    }
}
