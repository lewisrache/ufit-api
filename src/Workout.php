<?php declare(strict_types=1);

final class Workout
{
    private $program;
    private $components;
    public const DEFAULT_NAME = "quick workout";
    private function __construct($program)
    {
        $this->program = $program;
        $this->components = $this->cloneExercises(...$program->getExercises());
    }
    public static function fromProgram(Program $program): Workout
    {
        return new self($program);
    }
    public static function fromExercises(Exercise ...$exercises): Workout
    {
        return new self(Program::create(Workout::DEFAULT_NAME, ...$exercises));
    }
    public function getName(): string
    {
        return $this->program->getName();
    }
    public function getComponents(): array
    {
        return $this->components;
    }
    public function addExercise(Exercise $exercise): void
    {
        $this->components[] = $this->cloneExercise($exercise);
    }
    public function removeComponent(Component $removedComponent): void
    {
        foreach ($this->components as $key => $component) {
            if ($component === $removedComponent) {
                unset($this->components[$key]);
            }
        }
        // we want keys to always be sequential starting at 0
        $this->components = array_values($this->components);
    }

    private function cloneExercises(Exercise ...$exercises): array
    {
        $components = [];
        foreach ($exercises as $exercise) {
            $components[] = $this->cloneExercise($exercise);
        }
        return $components;
    }
    private function cloneExercise(Exercise $exercise): Component
    {
        return Component::fromExercise($exercise);
    }
}
