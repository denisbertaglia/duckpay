<?php

namespace Tests\Unit\Infrastructure;

use App\Infrastructure\Service\DB;

trait TestDB
{
    private string $sqliteFilePath = __DIR__.DIRECTORY_SEPARATOR.'teste.sqlite';
    private string $schemaFilePath = "./database/database.sql";
    private string $datasetFilePath = __DIR__.DIRECTORY_SEPARATOR.'_files'.DIRECTORY_SEPARATOR;

    private \Pdo $db;

    private function createSqliteFile(): void
    {
        $this->cleanSqlite();
    }
    private function cleanSqlite(): void {
        file_put_contents($this->sqliteFilePath ,'');
    }
    private function getFileSchema(): string {
        return file_get_contents($this->schemaFilePath);
    }
    public function setDataSet(string $dataSetName = ''): void
    {
        if(in_array($dataSetName,$this->dataSetList)){
            $dataSet = file_get_contents($this->datasetFilePath."$dataSetName.sql");
            $this->db->exec($dataSet);
        }
    }
    public function getConnection(): \PDO
    {
        $this->createSqliteFile();
        $this->db =  DB::createConnection($this->sqliteFilePath);
        $this->db->exec($this->getFileSchema());
        return $this->db;
    }

}
