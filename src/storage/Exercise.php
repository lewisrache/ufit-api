<?php declare(strict_types=1);
namespace App\Storage;

final class Exercise
{
    private static function createDB(): \PDO
    {
        $database = new \PDO('sqlite:/tmp/testdb.db');
        $database->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        return $database;
    }

    public static function insert(\App\Business\Exercise $exercise): int
    {
        $database = self::createDB();

        $sql = "INSERT INTO exercises (name) VALUES (:name)";
        $data = [':name' => $exercise->getName()];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $database->lastInsertId();
        return (int) $result;
    }

    public static function fetchById(int $id): ?\App\Business\Exercise
    {
        $database = self::createDB();

        $sql = "SELECT name FROM exercises WHERE id = :id";
        $data = [':id' => $id];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        if (!isset($result[0])) {
            return null;
        }

        return \App\Business\Exercise::fromString($result[0]['name']);
    }
}
