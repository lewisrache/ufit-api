<?php declare(strict_types=1);
namespace App\Storage;

final class User extends Base
{
    public static function insert(\App\Business\User $user): int
    {
        $database = self::createDB();

        $sql = "INSERT INTO users (name) VALUES (:name)";
        $data = [':name' => $user->getName()];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $database->lastInsertId();
        return (int) $result;
    }

    public static function fetchById(int $id): ?\App\Business\User
    {
        $database = self::createDB();

        $sql = "SELECT name FROM users WHERE id = :id";
        $data = [':id' => $id];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        if (!isset($result[0])) {
            return null;
        }

        return \App\Business\User::fromName($result[0]['name']);
    }
}
