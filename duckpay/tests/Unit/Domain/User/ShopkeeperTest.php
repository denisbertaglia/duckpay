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
        $balance = '345';

        $emails = [
            0 => Email::make('3','maken@teste.com',true),
            1 => Email::make('4','maken_test@teste.com',false),
        ];

        $shopkeeper = Shopkeeper::makeShopkeeper('3',$name,$cnpj,$emails,$balance);

        $this->assertEquals($name,$shopkeeper->getName());
        $this->assertEquals($cnpj,$shopkeeper->getCnpj());
        $this->assertEquals($balance,$shopkeeper->getAccount()->getBalance());
        $this->assertEquals($emails,$shopkeeper->getEmails());

    }
}
