<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

interface FinancialEntity
{
    public function getId(): string;
    public function setId(string $id): void;
    public function getAccount(): Account;
    public function getTaxpayer(): string;
    public function getTaxpayerType(): string;
}
