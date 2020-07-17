<?php declare(strict_types=1);
namespace App\Tests\Storage;

use PHPUnit\Framework\TestCase;
use App\Storage\Component;
use App\Storage\Exercise;
use App\Storage\Program;
use App\Storage\User;
use App\Storage\Workout;
final class ComponentTest extends WorkoutAppBaseTestCase
{
    protected $component;
    protected $exercise;
    protected $program;
    protected $user;
    protected $workout;
    public function setUp(): void
    {
        $this->exercise = \App\Business\Exercise::fromString("dbtest");
        $this->exercise->setId(Exercise::insert($this->exercise));
        $this->user = \App\Business\User::fromName("newuser");
        $this->user->setId(User::insert($this->user));
        $this->program = \App\Business\Program::create("programname", $this->user, ...[$this->exercise]);
        $this->program->setId(Program::insert($this->program));
        $this->workout = \App\Business\Workout::fromProgram($this->program);
        $this->workout->setId(Workout::insert($this->workout));
        $this->component = \App\Business\Component::create($this->exercise, $this->workout);
    }

    // we are not testing how the components come to be, only how they get into the database
    public function testCreateNewComponentAndInsert(): void
    {
        $id = Component::insert($this->component);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);
    }

    public function testGetComponentFromStorage(): void
    {
        $expectedComponent = $this->component;
        $id = Component::insert($expectedComponent);
        $actualComponent = Component::fetchById($id);
        $this->assertInstanceOf(
            \App\Business\Component::class,
            $actualComponent
        );
        $this->assertEquals($this->exercise->getId(), $actualComponent->getExercise()->getId());
        $this->assertEquals($this->workout->getId(), $actualComponent->getWorkout()->getId());
    }

    public function testFetchNonExistantComponent(): void
    {
        $nonexistantId = 99999;
        $component = Component::fetchById($nonexistantId);
        $this->assertNull($component);
    }
}
