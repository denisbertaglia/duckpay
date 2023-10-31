<?php

namespace Tests\Feature\Infrastructure\Service;

use App\Infrastructure\DB;
use PDO;
use PHPUnit\Framework\TestCase;
use Tests\Feature\Infrastructure\TestDB;

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
