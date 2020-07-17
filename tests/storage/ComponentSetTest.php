<?php declare(strict_types=1);
namespace App\Tests\Storage;

use PHPUnit\Framework\TestCase;
use App\Storage\Component;
use App\Storage\ComponentSet;
use App\Storage\Exercise;
use App\Storage\Program;
use App\Storage\User;
use App\Storage\Workout;
final class ComponentSetTest extends WorkoutAppBaseTestCase
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
        $this->component->setId(Component::insert($this->component));
    }

    // we are not testing how the components come to be, only how they get into the database
    public function testCreateNewComponentSetAndInsert(): void
    {
        $set = \App\Business\ComponentSet::create(150, 15, $this->component);
        $id = ComponentSet::insert($set);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);
    }

    public function testGetComponentSetFromStorage(): void
    {
        $weight = 150;
        $reps = 15;
        $expectedSet = \App\Business\ComponentSet::create($weight, $reps, $this->component);
        $id = ComponentSet::insert($expectedSet);
        $actualSet = ComponentSet::fetchById($id);
        $this->assertInstanceOf(
            \App\Business\ComponentSet::class,
            $actualSet
        );
        $this->assertEquals($this->component->getId(), $actualSet->getComponent()->getId());
        $this->assertEquals($weight, $actualSet->getWeight());
        $this->assertEquals($reps, $actualSet->getReps());
    }

    public function testFetchNonExistantComponentSet(): void
    {
        $nonexistantId = 99999;
        $component = ComponentSet::fetchById($nonexistantId);
        $this->assertNull($component);
    }
}
