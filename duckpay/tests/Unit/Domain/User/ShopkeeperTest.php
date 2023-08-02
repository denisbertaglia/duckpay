<?php

namespace Domain\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;
use App\Domain\Login\Login;
use App\Domain\Login\UserType;
use App\Domain\User\Customer;
use App\Domain\User\Shopkeeper;
use PHPUnit\Framework\TestCase;

class ShopkeeperTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_shopkeeper(): void
    {
        $name = 'Magazine Acre do Sul';
        $cnpj = '95.454.908/0001-81';
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

        $login = new Login($idLogin,$userType, $name,$email1,'tiruetoyy');
        $shopkeeper = new Shopkeeper($id,$login,$name,$emails,$cnpj,'0');

        $this->assertEquals($name,$shopkeeper->name());
        $this->assertEquals($cnpj,$shopkeeper->cnpj());
        $this->assertEquals($balance,$shopkeeper->balance());
        $this->assertEquals($emails,$shopkeeper->emails());

    }
}
