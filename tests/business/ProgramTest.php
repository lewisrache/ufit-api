<?php declare(strict_types=1);
namespace App\Tests\Business;

use PHPUnit\Framework\TestCase;
use App\Business\Exercise;
use App\Business\Program;
use App\Business\Workout;
final class ProgramTest extends TestCase
{
    public function testCreateProgramFromExerciseList(): void
    {
        $exercises = [
            Exercise::fromString("exercise1"),
            Exercise::fromString("exercise2")
        ];
        $this->assertInstanceOf(
            Program::class,
            Program::create("programname", ...$exercises)
        );
    }

    public function testGetExercisesFromProgram(): void
    {
        $expectedExercises = [
            Exercise::fromString("exercise1"),
            Exercise::fromString("exercise2")
        ];
        $program = Program::create("programname", ...$expectedExercises);
        $actualExercises = $program->getExercises();
        $this->assertEquals($expectedExercises, $actualExercises);
    }

    public function testGetSameNameBack(): void
    {
        $expectedName = "programname";
        $exercises = [
            Exercise::fromString("exercise1"),
            Exercise::fromString("exercise2")
        ];
        $program = Program::create($expectedName, ...$exercises);
        $this->assertEquals($expectedName, $program->getName());
    }
/* THESE SHOULD BE REMOVED BECAUSE THEY SHOULD BE WITH WORKOUTS
    public function testProgramSpawnWorkout(): void
    {
        $exercises = [
            Exercise::fromString("exercise1"),
            Exercise::fromString("exercise2")
        ];
        $program = Program::create("programname", ...$exercises);
        $this->assertInstanceOf(
            Workout::class,
            $program->spawnWorkout()
        );
    }
    public function testGetWorkoutListNewProgram(): void
    {
        $exercises = [
            Exercise::fromString("exercise1"),
            Exercise::fromString("exercise2")
        ];
        $program = Program::create("programname", ...$exercises);
        $this->assertEmpty($program->getWorkoutList());
    }

    public function testGetWorkoutListWithHistory(): void
    {
        $exercises = [
            Exercise::fromString("exercise1"),
            Exercise::fromString("exercise2")
        ];
        $program = Program::create("programname", ...$exercises);
        $expectedWorkouts = [
            $program->spawnWorkout(),
            $program->spawnWorkout()
        ];
        $this->assertEquals($expectedWorkouts, $program->getWorkoutList());
    }
*/
    public function testAddExerciseToExistingProgram(): void
    {
        $exercises = [
            Exercise::fromString("exercise1"),
            Exercise::fromString("exercise2")
        ];
        $program = Program::create("programname", ...$exercises);
        $newExercise = Exercise::fromString("newexercise");
        $program->addExercise($newExercise);
        // because WE are passing this in, and WE are determining how the code is written
        // we can just do "2" because it is the third array element.
        $this->assertEquals($newExercise, $program->getExercises()[2]);
    }

    public function testRemoveExerciseFromProgram(): void
    {
        $removedExercise = Exercise::fromString("removed");
        $beforeExercise = Exercise::fromString("exercise1");
        $afterExercise = Exercise::fromString("exercise3");
        $exercises = [
            $beforeExercise,
            $removedExercise,
            $afterExercise
        ];
        $program = Program::create("programname", ...$exercises);
        $program->removeExercise($removedExercise);
        $remainingExercises = $program->getExercises();
        $this->assertEquals([$beforeExercise,$afterExercise], $program->getExercises());
    }

    // TODO - add test for user_id

    // TODO - empty exercise list when creating a program?
}
