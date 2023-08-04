<?php

namespace Tests\Unit\Domain\User;

use App\Domain\User\Account;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_account(): void
    {
        $account = new Account('0');
        $this->assertEquals($account->getBalance(),'0');
    }
}
