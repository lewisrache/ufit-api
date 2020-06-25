<?php declare(strict_types=1);
namespace App\Storage;

final class Program extends Base
{
    public static function insert(\App\Business\Program $program): int
    {
        $database = self::createDB();

        $sql = "INSERT INTO programs (name, user_id) VALUES (:name, :user_id)";
        $data = [':name' => $program->getName(), ':user_id' => $program->getUser()->getId()];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $database->lastInsertId();
        return (int) $result;
    }


    // public static function fetchById(int $id): ?\App\Business\User
    // {
    //     $database = self::createDB();
    //
    //     $sql = "SELECT name FROM users WHERE id = :id";
    //     $data = [':id' => $id];
    //
    //     $stmt = $database->prepare($sql);
    //     $stmt->execute($data);
    //     $result = $stmt->fetchAll();
    //     if (!isset($result[0])) {
    //         return null;
    //     }
    //
    //     return \App\Business\User::fromName($result[0]['name']);
    // }
}
