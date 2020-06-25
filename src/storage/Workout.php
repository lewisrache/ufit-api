<?php declare(strict_types=1);
namespace App\Storage;

final class Workout extends Base
{
    public static function insert(\App\Business\Workout $workout): int
    {
        $database = self::createDB();

        $sql = "INSERT INTO workouts (program_id) VALUES (:program_id)";
        $data = [':program_id' => $workout->getProgram()->getId()];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $database->lastInsertId();
        return (int) $result;
    }


    public static function fetchById(int $id): ?\App\Business\Workout
    {
        $database = self::createDB();

        $sql = "SELECT id, program_id, date FROM workouts WHERE id = :id";
        $data = [':id' => $id];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        if (!isset($result[0])) {
            return null;
        }

        $program = Program::fetchById((int)$result[0]['program_id']);
        $workout = \App\Business\Workout::fromProgram($program);
        $workout->setId($id);
        $workout->setDate(\DateTime::createFromFormat('Y-m-d H:i:s', $result[0]['date']));
        return $workout;
    }
}
