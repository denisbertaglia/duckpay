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
        $cnpj = '95.454.908/0001-81';
        $balance = '345.00';

        $shopkeeper = Shopkeeper::make('3', $cnpj,$balance);

        $this->assertEquals($cnpj,$shopkeeper->getTaxpayer());
        $this->assertEquals($balance,$shopkeeper->getAccount()->getBalance());
        $this->assertEquals('CNPJ',$shopkeeper->getTaxpayerType());

    }
}
