<?php declare(strict_types=1);
namespace App\Storage;

final class ComponentSet extends Base
{
    public static function insert(\App\Business\ComponentSet $componentSet): int
    {
        $database = self::createDB();

        $sql = "INSERT INTO component_sets (component_id, weight, reps) VALUES (:component_id, :weight, :reps)";
        $data = [
            ':component_id' => $componentSet->getComponent()->getId(),
            ':weight'  => $componentSet->getWeight(),
            ':reps' => $componentSet->getReps()
        ];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $database->lastInsertId();
        return (int) $result;
    }

    // public static function fetchById(int $id): ?\App\Business\Component
    // {
    //     $database = self::createDB();
    //
    //     $sql = "SELECT exercise_id, workout_id FROM components WHERE id = :id";
    //     $data = [':id' => $id];
    //
    //     $stmt = $database->prepare($sql);
    //     $stmt->execute($data);
    //     $result = $stmt->fetchAll();
    //     if (!isset($result[0])) {
    //         return null;
    //     }
    //
    //     $exercise = Exercise::fetchById((int) $result[0]['exercise_id']);
    //     $workout = Workout::fetchById((int) $result[0]['workout_id']);
    //     $component = \App\Business\Component::create($exercise, $workout);
    //     $component->setId($id);
    //     return $component;
    // }
}
