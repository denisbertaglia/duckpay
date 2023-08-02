<?php

namespace Tests\Unit\Domain;

use App\Domain\Email;
use App\Domain\IdentifierCode;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $id = new IdentifierCode('2');
        $email = new Email($id ,true,'john@teste.com');

        $this->assertTrue($email->isLogin(), 'Login e-mail');
        $this->assertEquals('2', $email->id(), 'Set id');
        $this->assertEquals('john@teste.com', $email->email(),'Set e-mail');
    }
}
