<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

class Customer
{
    private IdentifierCode $id;
    private User $login;
    private string $name;
    private array $emails;
    private string $cpf;
    private string $balance;
    public function __construct(IdentifierCode $id, User $login, string $name, array $emails, string $cpf, string $balance ='0')
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @return string
     */
    public function getBalance(): string
    {
        return $this->balance;
    }
}
