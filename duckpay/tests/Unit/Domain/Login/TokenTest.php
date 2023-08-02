<?php

namespace Tests\Unit\Domain\Login;

use App\Domain\IdentifierCode;
use PHPUnit\Framework\TestCase;
use App\Domain\Login\Token;

class TokenTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $id = new IdentifierCode('1');
        $tokenString = "f3e21fbc73dde9dacaa69c8c7696507f5c647ef7";
        $token = new Token($id, $tokenString);
        $this->assertEquals($tokenString,$token->token());
    }
}
