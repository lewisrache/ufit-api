<?php declare(strict_types=1);
namespace App\Tests\Storage;

use PHPUnit\Framework\TestCase;
use App\Storage\Exercise;
use App\Storage\Program;
use App\Storage\Workout;
use App\Storage\User;
final class WorkoutTest extends WorkoutAppBaseTestCase
{
    public function testCreateNewWorkoutAndInsert(): void
    {
        $expectedExercises = [
            \App\Business\Exercise::fromString("exercise1"),
            \App\Business\Exercise::fromString("exercise2")
        ];
        $user = \App\Business\User::fromName("newuser");
        $program = \App\Business\Program::create("programname", $user, ...$expectedExercises);
        $workout = \App\Business\Workout::fromProgram($program);
        $id = Workout::insert($workout);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);
    }

    // NOTE: not verifying exercises in this test
    public function testGetProgramFromStorage(): void
    {
        $name = "dbtest";
        $user = \App\Business\User::fromName('newuser');
        $userId = User::insert($user);
        $user->setId($userId);
        $exercise = \App\Business\Exercise::fromString('newexercise');
        $program = \App\Business\Program::create($name, $user, ...[$exercise]);
        $programId = Program::insert($program);
        $program->setId($programId);
        $expectedWorkout = \App\Business\Workout::fromProgram($program);
        $id = Workout::insert($expectedWorkout);
        $actualWorkout = Workout::fetchById($id);
        $this->assertInstanceOf(
            \App\Business\Workout::class,
            $actualWorkout
        );
        $this->assertEquals($name, $actualWorkout->getProgram()->getName()); // TODO - Workout->getName() should be a thing and should return program->getName()
        $this->assertEquals($id, $actualWorkout->getId());
        $actualDate = $actualWorkout->getDate();
        $this->assertInstanceOf(\DateTime::class, $actualDate);
        $this->assertEquals(date('Y-m-d'), $actualDate->format('Y-m-d'));
        $this->assertEquals($userId, $actualWorkout->getProgram()->getUser()->getId());
    }
    //
    // public function testFetchNonExistantProgram(): void
    // {
    //     $nonexistantId = 99999;
    //     $program = Program::fetchById($nonexistantId);
    //     $this->assertNull($program);
    // }
}
