<?php declare(strict_types=1);
namespace App\Tests\Storage;

use PHPUnit\Framework\TestCase;
use App\Storage\User;
final class UserTest extends WorkoutAppBaseTestCase
{
    public function testCreateNewUserAndInsert(): void
    {
        $user = \App\Business\User::fromName("dbtest");
        $id = User::insert($user);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);
    }

    public function testGetUserFromStorage(): void
    {
        $name = "dbtest";
        $expectedUser = \App\Business\User::fromName($name);
        $id = User::insert($expectedUser);
        $actualUser = User::fetchById($id);
        $this->assertInstanceOf(
            \App\Business\User::class,
            $actualUser
        );
        $this->assertEquals($name, $actualUser->getName());
    }

    public function testFetchNonExistantUser(): void
    {
        $nonexistantId = 99999;
        $user = User::fetchById($nonexistantId);
        $this->assertNull($user);
    }
}
