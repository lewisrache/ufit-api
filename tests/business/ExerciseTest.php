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
}
