<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

class Shopkeeper
{
    private IdentifierCode $id;
    private User $login;
    private string $name;
    private array $emails;
    private string $cnpj;
    private string $balance;
    public function __construct(IdentifierCode $id, User $login, string $name, array $emails, string $cnpj, string $balance ='0')
    {
        $this->id =$id;
        $this->login =$login;
        $this->name =$name;
        $this->emails =$emails;
        $this->cnpj =$cnpj;
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
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * @return string
     */
    public function getBalance(): string
    {
        return $this->balance;
    }
}
