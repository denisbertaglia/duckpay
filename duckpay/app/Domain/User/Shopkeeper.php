<?php

namespace App\Domain\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;
use App\Domain\Login\Login;

class Shopkeeper
{
    private IdentifierCode $id;
    private Login $login;
    private string $name;
    private array $emails;
    private string $cnpj;
    private string $balance;
    public function __construct(IdentifierCode $id,Login $login, string $name, array $emails, string $cnpj, string $balance ='0')
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
    public function cnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * @return string
     */
    public function balance(): string
    {
        return $this->balance;
    }
}
