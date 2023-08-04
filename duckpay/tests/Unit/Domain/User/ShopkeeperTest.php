<?php

namespace Domain\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;
use App\Domain\User\Account;
use App\Domain\User\Shopkeeper;
use App\Domain\User\User;
use App\Domain\User\UserType;
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
        $idEmail1 = new IdentifierCode('4');
        $email1 = 'john@teste.com';
        $idEmail2 = new IdentifierCode('4');
        $email2 = 'john_test@teste.com';
        $emails = [
            0 => new Email($idEmail1,true,$email1),
            1 => new Email($idEmail2,false,$email2),
        ];
        $account = new Account(0);
        $shopkeeper = new Shopkeeper($id,$name,$emails,$cnpj,$account);

        $this->assertEquals($name,$shopkeeper->getName());
        $this->assertEquals($cnpj,$shopkeeper->getCnpj());
        $this->assertEquals($account,$shopkeeper->getAccount());
        $this->assertEquals($emails,$shopkeeper->getEmails());

    }
}
