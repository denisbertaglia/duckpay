<?php

namespace App\Domain\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;

class User
{
    private IdentifierCode $id;
    private UserType $userType;
    private string $name;
    private array $emails;
    private string $password;
    public function __construct(IdentifierCode $id, UserType $userType, string $name, array $emails)
    {
        $this->id = $id;
        $this->userType = $userType;
        $this->name = $name;
        $this->emails = $emails;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id->code();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->userType->type();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Email[]
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}
