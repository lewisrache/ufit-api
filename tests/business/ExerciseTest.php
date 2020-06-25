<?php declare(strict_types=1);
namespace App\Tests\Business;

use PHPUnit\Framework\TestCase;
use App\Business\Exercise;
final class ExerciseTest extends TestCase
{
    public function testCanCreateExerciseFromName(): void
    {
        $this->assertInstanceOf(
            Exercise::class,
            Exercise::fromString('dumbexercise')
        );
    }

    public function testCanGetSameNameBack(): void
    {
        $exerciseName = "dumbexercise";
        $exercise = Exercise::fromString($exerciseName);
        $this->assertEquals($exerciseName, $exercise->getName());
    }

    public function testSetIdAndGetIdBack(): void
    {
        $exerciseName = "dumbexercise";
        $exercise = Exercise::fromString($exerciseName);
        $id = 1;
        $exercise->setId($id);
        $this->assertEquals($id, $exercise->getId());
    }

    public function testGetIdBeforeSet(): void
    {
        $exercise = Exercise::fromString('new');
        $this->assertNull($exercise->getId());
    }
}
