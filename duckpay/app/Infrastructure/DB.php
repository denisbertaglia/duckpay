<?php

namespace App\Infrastructure;

use PDO;

class DB extends PDO
{
    public static function createConnection($path=''):PDO {
        $connection = new self('sqlite:'.$path);

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $connection->exec('PRAGMA foreign_keys = ON;');

        return $connection;
    }
}
