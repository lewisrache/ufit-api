<?php declare(strict_types=1);
namespace App\Tests\Business;

use PHPUnit\Framework\TestCase;
use App\Business\Exercise;
use App\Business\Program;
use App\Business\User;
final class UserTest extends TestCase
{
    public function testCreateUserFromName(): void
    {
        $this->assertInstanceOf(
            User::class,
            User::fromName('newuser')
        );
    }

// TODO - lists of programs should be PROGRAM's responsibility
    // public function testAddProgramToUserAndGetItBack(): void
    // {
    //     $exercises = [
    //         Exercise::fromString("exercise1"),
    //         Exercise::fromString("exercise2")
    //     ];
    //     $program = Program::create("programname", ...$exercises);
    //     $user = User::fromName('newuser');
    //     $user->addProgram($program);
    //     $userPrograms = $user->getPrograms();
    //     $this->assertEquals($program, $userPrograms[0]);
    // }

    public function testGetName(): void
    {
        $name = 'newuser';
        $user = User::fromName($name);
        $this->assertEquals($name, $user->getName());
    }
}
