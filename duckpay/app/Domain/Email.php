<?php

namespace App\Domain;

class Email
{
    private IdentifierCode $id;
    private bool $login;
    private string $email;

    public function __construct(IdentifierCode $id,  string $email,bool $toLogin)
    {
        $this->id= $id;
        $this->login= $toLogin;
        $this->email= $email;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id->code();
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }
    /**
     * @return bool
     */
    public function isLogin(): bool
    {
        return $this->login;
    }
}
