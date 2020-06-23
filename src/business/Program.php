<?php declare(strict_types=1);

namespace App\Business;

final class Program
{
    private $name;
    private $user;
    private $exercises;
//    private $workouts;
    private function __construct(string $name, User $user, Exercise ...$exercises)
    {
        $this->name = $name;
        $this->user = $user;
        $this->exercises = $exercises;
//        $this->workouts = [];
    }
    public static function create(string $name, User $user, Exercise ...$exercises): Program
    {
        return new self($name, $user, ...$exercises);
    }
    public function getExercises(): array
    {
        return $this->exercises;
    }
    public function getName(): string
    {
        return $this->name;
    }
    /*REMOVE WORKOUTS FROM THE PROGRAM*/
    // public function spawnWorkout(): Workout
    // {
    //     $workout = Workout::fromProgram($this);
    //     $this->workouts[] = $workout;
    //     return $workout;
    // }
    // public function getWorkoutList(): array
    // {
    //     return $this->workouts;
    // }
    /*REMOVE WORKOUTS FROM THE PROGRAM*/
    public function addExercise(Exercise $exercise): void
    {
        $this->exercises[] = $exercise;
    }
    public function removeExercise(Exercise $removedExercise): void
    {
        foreach ($this->exercises as $key => $exercise) {
            if ($exercise === $removedExercise) {
                unset($this->exercises[$key]);
            }
        }
        // we want the keys to always be sequential
        $this->exercises = array_values($this->exercises);
    }
}
