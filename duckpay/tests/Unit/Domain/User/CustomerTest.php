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
        $id = new IdentifierCode('2');
        $idEmail1 = new IdentifierCode('4');
        $email1 = 'john@teste.com';
        $idEmail2 = new IdentifierCode('4');
        $email2 = 'john_test@teste.com';
        $emails = [
            0 => new Email($idEmail1,true,$email1),
            1 => new Email($idEmail2,false,$email2),
        ];
        $account = new Account(0);

        $customer = new Customer($id,$name,$emails,$cpf,$account);

        $this->assertEquals($name,$customer->getName());
        $this->assertEquals($cpf,$customer->getCpf());
        $this->assertEquals($account,$customer->getAccount());
        $this->assertEquals($emails,$customer->getEmails());

    }
}
