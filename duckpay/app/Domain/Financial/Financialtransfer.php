<?php

namespace App\Domain\Financial;

use App\Domain\IdentifierCode;
use App\Domain\User\Customer;
use App\Domain\User\Shopkeeper;

class Financialtransfer
{
    private IdentifierCode $id;
    private Money $amount;
    private Customer $payeer;

    private Shopkeeper $payee;

    public function __construct(IdentifierCode $id, Customer $payeer, Shopkeeper $payee, Money $amount)
    {
        $this->id = $id;
        $this->payeer = $payeer;
        $this->payee = $payee;
        $this->amount = $amount;
    }
    public static function make(string $id, Customer $payeer, Shopkeeper $payee, string $amount='0'): self{
        return new self(new IdentifierCode($id),   $payeer,  $payee,  new Money($amount));
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id->code();
    }

    /**
     * @return Shopkeeper
     */
    public function getPayee(): Shopkeeper
    {
        return $this->payee;
    }

    /**
     * @return Customer
     */
    public function getPayeer(): Customer
    {
        return $this->payeer;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

}
