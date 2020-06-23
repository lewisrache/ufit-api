<?php declare(strict_types=1);
namespace App\Storage;

class Base
{
    protected static function createDB(): \PDO
    {
        $database = new \PDO('sqlite:/tmp/testdb.db');
        $database->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        return $database;
    }
}
