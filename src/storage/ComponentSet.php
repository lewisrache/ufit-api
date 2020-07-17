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

    public static function fetchById(int $id): ?\App\Business\ComponentSet
    {
        $database = self::createDB();

        $sql = "SELECT component_id, weight, reps FROM component_sets WHERE id = :id";
        $data = [':id' => $id];

        $stmt = $database->prepare($sql);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        if (!isset($result[0])) {
            return null;
        }

        $component = Component::fetchById((int) $result[0]['component_id']);
        $set = \App\Business\ComponentSet::create((float) $result[0]['weight'], (int) $result[0]['reps'], $component);
        $set->setId($id);
        return $set;
    }
}
