<?php

namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\IdentifierCode as IdentifierCodeDomain;

class IdentifierCodeTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_identifier_code(): void
    {
        $identifierCode = new IdentifierCodeDomain('1');

        $this->assertEquals(1,$identifierCode->code(),1);
    }

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
