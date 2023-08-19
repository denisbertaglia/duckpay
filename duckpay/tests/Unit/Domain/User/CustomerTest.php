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
        $name = 'John Martins';
        $cpf = '999.999.999-00';
        $balance = '1122';
        $emails = [
            0 => Email::make('1','john@teste.com',true),
            1 => Email::make('2','john_test@teste.com',false),
        ];
        $customer = Customer::makeCustomer(2,$name,$cpf,$emails,$balance);

        $this->assertEquals($name,$customer->getName());
        $this->assertEquals($cpf,$customer->getCpf());
        $this->assertEquals($balance,$customer->getAccount()->getBalance());
        $this->assertEquals($emails,$customer->getEmails());

    }
}
