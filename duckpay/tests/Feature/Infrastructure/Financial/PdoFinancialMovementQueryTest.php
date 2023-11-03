<?php

namespace Infrastructure\Financial;

use App\Domain\IdentifierCode;
use App\Domain\User\UserRepository;
use App\Infrastructure\Financial\PdoFinancialMovementQuery;
use App\Infrastructure\User\PdoUserRepository;
use PHPUnit\Framework\TestCase;
use Tests\Feature\Infrastructure\TestDB;

class PdoFinancialMovementQueryTest extends TestCase
{
    use TestDB;
    private PdoFinancialMovementQuery $financialMovementQuery;
    private UserRepository $userRepository;
    protected function setUp(): void
    {
        parent::setUp();
        $connection = $this->getPdoConnection();
        $this->userRepository = new PdoUserRepository($connection);
        $this->financialMovementQuery = new PdoFinancialMovementQuery($connection);
    }

    public function test_find_financial_movement(){
        $this->setDataSet('test_find_financial_movement');
        $user = $this->userRepository->findByIdCode(new IdentifierCode('1'));
        $financialMovement = $this->financialMovementQuery->consultTransferBetweenAccounts($user);
        $this->assertCount(6, $financialMovement) ;

    }
}
