<?php declare(strict_types=1);

namespace App\Business;

final class Component
{
    private $exercise;
    private $sets;
    private $workout;
    private $id = null;
    private function __construct(Exercise $exercise, Workout $workout)
    {
        $this->exercise = $exercise;
        $this->workout = $workout;
        $this->sets = [];
    }
    public static function create(Exercise $exercise, Workout $workout): Component
    {
        return new self($exercise, $workout);
    }
    public function getName(): string
    {
        return $this->exercise->getName();
    }
    public function getSetList(): array
    {
        return $this->sets;
    }
    public function addSet(ComponentSet $set): void
    {
        $this->sets[] = $set;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getExercise(): Exercise
    {
        return $this->exercise;
    }
    public function getWorkout(): Workout
    {
        return $this->workout;
    }
}
