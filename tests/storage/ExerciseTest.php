<?php declare(strict_types=1);
namespace App\Tests\Storage;

use PHPUnit\Framework\TestCase;
use App\Storage\Exercise;
final class ExerciseTest extends WorkoutAppBaseTestCase
{
    public function testCreateNewExerciseAndInsert(): void
    {
        $exercise = \App\Business\Exercise::fromString("dbtest");
        $id = Exercise::insert($exercise);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);
    }

    public function testGetExerciseFromStorage(): void
    {
        $name = "dbtest";
        $expectedExercise = \App\Business\Exercise::fromString($name);
        $id = Exercise::insert($expectedExercise);
        $actualExercise = Exercise::fetchById($id);
        $this->assertInstanceOf(
            \App\Business\Exercise::class,
            $actualExercise
        );
        $this->assertEquals($name, $actualExercise->getName());
        $this->assertEquals($id, $actualExercise->getId());
    }

    public function testFetchNonExistantExercise(): void
    {
        $nonexistantId = 99999;
        $exercise = Exercise::fetchById($nonexistantId);
        $this->assertNull($exercise);
    }
}
