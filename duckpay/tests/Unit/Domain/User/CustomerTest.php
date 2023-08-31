<?php

namespace Tests\Unit\Domain\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;
use App\Domain\User\Account;
use App\Domain\User\Customer;
use App\Domain\User\User;
use App\Domain\User\UserType;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_customer(): void
    {
        $cpf = '999.999.999-00';
        $balance = '1122.00';
        $customer = Customer::make(2,$cpf,$balance);

        $this->assertEquals($cpf,$customer->getTaxpayer());
        $this->assertEquals($balance,$customer->getAccount()->getBalance());
        $this->assertEquals('CPF',$customer->getTaxpayerType());

    }
}
