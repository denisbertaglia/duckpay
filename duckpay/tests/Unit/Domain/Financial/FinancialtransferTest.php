<?php

namespace Tests\Unit\Domain\Financial;

use App\Domain\Financial\Financialtransfer;
use App\Domain\User\Customer;
use App\Domain\User\Shopkeeper;
use App\Domain\User\User;
use PHPUnit\Framework\TestCase;

class FinancialtransferTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_financial_transfer(): void
    {
        $idUserCustomer = '344';
        $idCustomer = '344';
        $nameCustomer = "";
        $cpf = '644.344.217-03';
        $balanceCustomer = '89560';
        $userCustomer = User::make($idUserCustomer,$nameCustomer, [])
            ->asCustomer($idCustomer, $cpf, $balanceCustomer);

        $idUserShopkeeper = '82';
        $idShopkeeper = '82';
        $nameShopkeeper = "";
        $cnpj = '11.093.662/0001-70';
        $balanceShopkeeper = '89560';
        $userShopkeeper = User::make($idUserShopkeeper, $nameShopkeeper, [])
                                ->asShopkeeper($idShopkeeper, $cnpj, $balanceShopkeeper);

        $idFinancialtransfer = '234';
        $amount = '10000';
        $customer = $userCustomer->getFinancialEntity();
        $shopkeeper = $userShopkeeper->getFinancialEntity();


        $financialtransfer = Financialtransfer::make($idFinancialtransfer, $customer, $shopkeeper, $amount);
        $this->assertEquals($idFinancialtransfer, $financialtransfer->getId());
        $this->assertEquals($idShopkeeper, $financialtransfer->getPayee()->getId());
        $this->assertEquals($idCustomer, $financialtransfer->getPayeer()->getId());
    }
}
