<?php

namespace Tests\Feature\Application\Financial;

use App\Application\Financial\FinancialService;
use App\Application\Financial\FinancialtransferDTO;
use App\Domain\User\UserRepository;
use App\Infrastructure\Financial\PdoFinancialMovementQuery;
use App\Infrastructure\User\PdoUserRepository;
use PDO;
use Tests\Feature\Infrastructure\TestDB;
use Tests\TestCase;

class FinancialServiceTest extends TestCase
{
    use TestDB;
    private UserRepository $userRepository;
    private PdoFinancialMovementQuery $financialMovementQuery;
    private FinancialService $financialService;
    private PDO $conn;

    protected function setUp(): void{
        parent::setUp();
        $this->conn = $this->getPdoConnection();
        $this->userRepository = new PdoUserRepository($this->conn);
        $this->financialMovementQuery = new PdoFinancialMovementQuery($this->conn);
        $this->financialService = new FinancialService($this->userRepository, $this->financialMovementQuery);
    }
    /**
     * A basic feature test example.
     */
    public function test_list_user_account_trasaction_history(): void
    {
        $this->setDataSet('test_find_financial_movement');
        $trasactionHistory = $this->financialService->listUserAccountTrasactionHistory(1);
        $this->assertCount(6, $trasactionHistory) ;
    }
}
