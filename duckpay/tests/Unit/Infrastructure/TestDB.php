<?php

namespace Tests\Unit\Infrastructure;

use App\Infrastructure\Service\DB;

trait TestDB
{
    private string $sqliteFilePath = __DIR__.DIRECTORY_SEPARATOR.'teste.sqlite';
    private function createSqliteFile(): void
    {
        $this->cleanSqlite();
    }
    private function cleanSqlite(): void {
        file_put_contents($this->sqliteFilePath ,'');
    }

    public function getConnection(): \PDO
    {
        return DB::createConnection($this->sqliteFilePath);
    }

}
