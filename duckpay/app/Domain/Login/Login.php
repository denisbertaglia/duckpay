<?php

namespace App\Domain\Login;

use App\Domain\IdentifierCode;

class Login
{
    private IdentifierCode $id;
    private UserType $userType;
    private string $name;
    private string $email;
    private string $password;
    public function __construct(IdentifierCode $id, UserType $userType, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->userType = $userType;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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
    public function userType(): string
    {
        return $this->userType->type();
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }
}
