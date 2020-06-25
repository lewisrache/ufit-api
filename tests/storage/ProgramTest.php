<?php declare(strict_types=1);
namespace App\Tests\Storage;

use PHPUnit\Framework\TestCase;
use App\Storage\Program;
use App\Storage\User;
final class ProgramTest extends WorkoutAppBaseTestCase
{
    public function testCreateNewProgramAndInsert(): void
    {
        $expectedExercises = [
            \App\Business\Exercise::fromString("exercise1"),
            \App\Business\Exercise::fromString("exercise2")
        ];
        $user = \App\Business\User::fromName("newuser");
        $program = \App\Business\Program::create("programname", $user, ...$expectedExercises);
        $id = Program::insert($program);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);
    }

    // NOTE: not verifying exercises in this test
    // public function testGetProgramFromStorage(): void
    // {
    //     $name = "dbtest";
    //     $user = \App\Business\User::fromName('newuser');
    //     $userId = User::insert($user);
    //     $user->setId($userId);
    //     $exercise = Exercise::fromName('newexercise');
    //     $expectedProgram = \App\Business\Program::create($name, $user, ...[$exercise]);
    //     $id = Program::insert($expectedProgram);
    //     $actualProgram = Program::fetchById($id);
    //     $this->assertInstanceOf(
    //         \App\Business\Program::class,
    //         $actualProgram
    //     );
    //     $this->assertEquals($name, $actualProgram->getName());
    //     $this->assertEquals($user->getName(), $actualProgram->getUser()->getName());
    //     $this->assertEquals($user->getId(), $actualProgram->getUser()->getId());
    // }

    // public function testFetchNonExistantUser(): void
    // {
    //     $nonexistantId = 99999;
    //     $user = User::fetchById($nonexistantId);
    //     $this->assertNull($user);
    // }
}
