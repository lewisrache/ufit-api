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


    public static function fetchById(int $id): ?\App\Business\Program
    {
        $database = self::createDB();

        $sql = "SELECT id, name, user_id FROM programs WHERE id = :id";
        $data = [':id' => $id];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        if (!isset($result[0])) {
            return null;
        }

        $user = User::fetchById((int)$result[0]['user_id']);
        $program = \App\Business\Program::create($result[0]['name'], $user, ...[]);
        $program->setId($id);
        return $program;
    }
}
