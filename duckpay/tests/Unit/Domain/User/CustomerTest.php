<?php

namespace Tests\Unit\Domain\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;
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
        $balance = '0';
        $id = new IdentifierCode('2');
        $idLogin = new IdentifierCode('2');
        $idEmail1 = new IdentifierCode('4');
        $email1 = 'john@teste.com';
        $idEmail2 = new IdentifierCode('4');
        $email2 = 'john_test@teste.com';
        $userType = new UserType(UserType::TYPE['CUSTOMER']);
        $emails = [
            0 => new Email($idEmail1,true,$email1),
            0 => new Email($idEmail2,false,$email2),
        ];

        $login = new User($idLogin,$userType, $name,$emails,'tiruetoyy');
        $customer = new Customer($id,$login,$name,$emails,$cpf,'0');

        $this->assertEquals($name,$customer->getName());
        $this->assertEquals($cpf,$customer->getCpf());
        $this->assertEquals($balance,$customer->getBalance());
        $this->assertEquals($emails,$customer->getEmails());

    }
}
