<?php declare(strict_types=1);

namespace App\Business;

final class Workout
{
    private $program;
    private $components;
    private $id = null;
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
    // TODO - rename???
    public static function fromExercises(User $user, Exercise ...$exercises): Workout
    {
        return new self(Program::create(Workout::DEFAULT_NAME, $user, ...$exercises));
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
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): ?int
    {
        return $this->id;
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
