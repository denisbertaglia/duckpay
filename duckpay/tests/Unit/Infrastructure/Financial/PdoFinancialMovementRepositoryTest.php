<?php

namespace Tests\Unit\Infrastructure\Financial;

use App\Domain\Financial\FinancialMovementRepository;
use App\Domain\IdentifierCode;
use App\Domain\User\UserRepository;
use App\Infrastructure\User\PdoUserRepository;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Infrastructure\TestDB;
use App\Infrastructure\Financial\PdoFinancialMovementRepository;

class PdoFinancialMovementRepositoryTest extends TestCase
{
    use TestDB;
    private FinancialMovementRepository $financialMovementRepository;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $connection = $this->getConnection();
        $this->userRepository = new PdoUserRepository($connection);
        $this->financialMovementRepository = new PdoFinancialMovementRepository($connection,$this->userRepository);
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
        $this->assertEquals($amount, $financialTransfer->getAmount());
        $this->assertNotEmpty($financialTransfer->getId());
    }
    public function dataProviderCreateFinancialMovement(){
        return [
            ['1','2','9000'],
        ];
    }
}
