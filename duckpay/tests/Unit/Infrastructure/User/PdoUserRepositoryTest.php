<?php
namespace Tests\Unit\Infrastructure\User;

use App\Domain\User\UserRepository;
use App\Infrastructure\User\PdoUserRepository;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Infrastructure\TestDB;

class PdoUserRepositoryTest extends TestCase
{
    use TestDB;
    private UserRepository $pdoUserRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pdoUserRepository= new PdoUserRepository($this->getConnection());
    }

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $users = $this->pdoUserRepository->findAll();
        $this->assertIsArray($users);
    }
}
