<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testCreateUserFromName(): void
    {
        $this->assertInstanceOf(
            User::class,
            User::fromName('newuser')
        );
    }

    public function testAddProgramToUserAndGetItBack(): void
    {
        $exercises = [
            Exercise::fromString("exercise1"),
            Exercise::fromString("exercise2")
        ];
        $program = Program::create("programname", ...$exercises);
        $user = User::fromName('newuser');
        $user->addProgram($program);
        $userPrograms = $user->getPrograms();
        $this->assertEquals($program, $userPrograms[0]);
    }
}
