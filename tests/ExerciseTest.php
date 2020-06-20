<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

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
