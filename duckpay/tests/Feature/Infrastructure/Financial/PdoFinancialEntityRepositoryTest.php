<?php

namespace Tests\Feature\Infrastructure\Financial;

use App\Domain\Financial\FinancialEntityRepository;
use App\Domain\IdentifierCode;
use App\Domain\User\UserRepository;
use App\Infrastructure\Financial\PdoFinancialEntityRepository;
use App\Infrastructure\User\PdoUserRepository;
use PHPUnit\Framework\TestCase;
use Tests\Feature\Infrastructure\TestDB;

class PdoFinancialEntityRepositoryTest extends TestCase
{
    use TestDB;
    private FinancialEntityRepository $financialEntityRepository;
    private UserRepository $userRepository;
    protected function setUp(): void
    {
        parent::setUp();
        $connection = $this->getPdoConnection();
        $this->financialEntityRepository = new PdoFinancialEntityRepository($connection);
        $this->userRepository = new PdoUserRepository($connection);

    }

    /**
     * A basic unit test example.
     * @dataProvider dataProviderAccountTranfer
     */
    public function test_create_account_transfer_customer_to_shopkeeper($idUserCustomer, $idUserShopkeeper, $amount, $customerExpectedBalance, $shopkeeperExpectedBalance): void
    {
        $this->setDataSet('test_create_account_transfer_customer_to_shopkeeper');

        $userCustomer = $this->userRepository->findByIdCode(new IdentifierCode($idUserCustomer));
        $customer = $userCustomer->getFinancialEntity();
        $userShopkeeper = $this->userRepository->findByIdCode(new IdentifierCode($idUserShopkeeper));
        $shopkeeper = $userShopkeeper->getFinancialEntity();

        $this->financialEntityRepository->accountTransferCustomertoShopkeeper($customer,$shopkeeper,$amount);

        $customer = $this->userRepository->findFinancialEntityByIdCode(new IdentifierCode($idUserCustomer));
        $shopkeeper = $this->userRepository->findFinancialEntityByIdCode(new IdentifierCode($idUserShopkeeper));


        $this->assertEquals($customerExpectedBalance,$customer->getAccount()->getBalance());
        $this->assertEquals($shopkeeperExpectedBalance,$shopkeeper->getAccount()->getBalance());
    }
    public static function dataProviderAccountTranfer(){

        return [
            [1,2,'500.00','4500.00','5500.00'],
        ];
    }

}
