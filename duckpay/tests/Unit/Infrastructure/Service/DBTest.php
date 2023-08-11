<?php

namespace Tests\Unit\Infrastructure\Service;

use App\Infrastructure\Service\DB;
use PHPUnit\Framework\TestCase;
use PDO;
use Tests\Unit\Infrastructure\TestDB;

class DBTest extends TestCase
{
    use TestDB;
    /**
     * A basic unit test example.
     */
    public function test_create_connection(): void
    {
        $conn = DB::createConnection($this->sqliteFilePath);
        $sth = $conn->prepare("SELECT 'true' as info");
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals('true',$data['info']);
    }
}
