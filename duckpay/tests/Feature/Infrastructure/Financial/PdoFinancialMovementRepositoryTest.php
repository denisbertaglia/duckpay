<?php

namespace Tests\Feature\Infrastructure\Financial;

use App\Domain\Financial\FinancialMovementRepository;
use App\Domain\IdentifierCode;
use App\Domain\User\UserRepository;
use App\Infrastructure\Financial\PdoFinancialMovementQuery;
use App\Infrastructure\Financial\PdoFinancialMovementRepository;
use App\Infrastructure\User\PdoUserRepository;
use PHPUnit\Framework\TestCase;
use Tests\Feature\Infrastructure\TestDB;

class PdoFinancialMovementRepositoryTest extends TestCase
{
    use TestDB;
    private FinancialMovementRepository $financialMovementRepository;

    private UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $connection = $this->getPdoConnection();
        $this->userRepository = new PdoUserRepository($connection);
        $this->financialMovementRepository = new PdoFinancialMovementRepository($connection);
    }
    /**
     * A basic unit test example.
     * @dataProvider dataProviderCreateFinancialMovement
     */
    public function test_create_financial_movement(string $idCustomer, string $idShopkeeper, $amount): void
    {
        $this->setDataSet('test_create_financial_movement');
        $customer = $this->userRepository->findByIdCode(new IdentifierCode($idCustomer))->getFinancialEntity();
        $shopkeeper = $this->userRepository->findByIdCode(new IdentifierCode($idShopkeeper))->getFinancialEntity();
        $financialTransfer = $this->financialMovementRepository->registerTransferAccountsCustomersShopkeeper($customer, $shopkeeper, $amount);
        $this->assertEquals($amount, $financialTransfer->getAmount()->value());
        $this->assertNotEmpty($financialTransfer->getId());
    }
    public static function dataProviderCreateFinancialMovement(){
        return [
            ['1','2','9000.00'],
            ['1','2','8000.00'],
        ];
    }

}
