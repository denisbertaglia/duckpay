<?php

namespace App\Domain;

use App\Domain\User\Customer;

class Email
{
    private IdentifierCode $id;
    private bool $login;
    private string $email;

    public function __construct(IdentifierCode $id,  string $email, bool $toLogin)
    {
        $this->id= $id;
        $this->login= $toLogin;
        $this->email= $email;
    }
    public static function make(string $id,  string $email, bool $toLogin): Email{
        return new Email(new IdentifierCode($id),$email,$toLogin);
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = new IdentifierCode($id);
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
