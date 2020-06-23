<?php declare(strict_types=1);
namespace App\Storage;

final class Exercise
{
    public static function insert(\App\Business\Exercise $exercise): int
    {
        $database = new \PDO('sqlite:/tmp/testdb.db');
        $database->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

        $sql = "INSERT INTO exercises (name) VALUES (:name)";
        $data = [':name' => $exercise->getName()];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $database->lastInsertId();
        return (int) $result;
    }
}
