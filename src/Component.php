<?php declare(strict_types=1);

final class Component
{
    private $exercise;
    private $sets;
    private function __construct($exercise)
    {
        $this->exercise = $exercise;
        $this->sets = [];
    }
    public static function fromExercise(Exercise $exercise): Component
    {
        return new self($exercise);
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
}
