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
    private FinancialEntity | null $financialEntity = null;
    public function __construct(IdentifierCode $id, string $name, array $emails = [])
    {
        $this->id = $id;
        $this->userType = new UserType(UserType::TYPE['LOGIN']);
        $this->name = $name;
        $this->emails = $emails;
    }
    public static function make(string $id, string $name, array $emails = [],int $userType = 0): User {
        $user = new User( new IdentifierCode($id), $name ,$emails );
        $user->userType = new UserType($userType);
        return $user;
    }
    public function asCustomer(string $id, string $taxpayer, string $account): self {
        $this->userType = new UserType( (int) UserType::TYPE['CUSTOMER']);
        $this->financialEntity = Customer::make($id, $taxpayer, $account);
        return $this;
    }
    public function asShopkeeper(string $id, string $taxpayer, string $account): self {
        $this->userType = new UserType( (int) UserType::TYPE['SHOPKEEPER']);
        $this->financialEntity = Shopkeeper::make($id, $taxpayer, $account);
        return $this;
    }

    /**
     * @return FinancialEntity|null
     */
    public function getFinancialEntity(): ?FinancialEntity
    {
        return $this->financialEntity;
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
     * @return UserType
     */
    public function getType(): UserType
    {
        return $this->userType;
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
