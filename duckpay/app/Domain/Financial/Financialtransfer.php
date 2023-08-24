<?php

namespace App\Domain\Financial;

use App\Domain\IdentifierCode;
use App\Domain\User\Customer;
use App\Domain\User\Shopkeeper;

class Financialtransfer
{
    private IdentifierCode $id;
    private string $amount = '0';
    private Customer $payeer;

    private Shopkeeper $payee;

    public function __construct(IdentifierCode $id, Customer $payeer, Shopkeeper $payee, string $amount='0')
    {
        $this->id = $id;
        $this->payeer = $payeer;
        $this->payee = $payee;
        $this->amount = $amount;
    }
    public static function make(string $id, Customer $payeer, Shopkeeper $payee, string $amount='0'): self{
        return new self(new IdentifierCode($id),   $payeer,  $payee,  $amount);
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
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

}
