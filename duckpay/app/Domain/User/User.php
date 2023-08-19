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
    public function __construct(IdentifierCode $id, UserType $userType, string $name, array $emails = [])
    {
        $this->id = $id;
        $this->userType = $userType;
        $this->name = $name;
        $this->emails = $emails;
    }
    public static function makeUser(string $id, string $userType, string $name, array $emails = []): User {
        return new User( new IdentifierCode($id), new UserType( (int) $userType),$name ,$emails );
    }

    /**
     * @param IdentifierCode $id
     */
    public function setId(string $id): void
    {
        $this->id = new IdentifierCode($id);
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
        return $this->userType->getFullType();
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
     * @param Email $email
     */
    public function setEmail(Email $email): void
    {
        $this->emails[]  = $email;
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

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getCnpj(): string
    {
        return '';
    }


    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return new Account(0);
    }
}
