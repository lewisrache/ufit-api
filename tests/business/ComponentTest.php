<?php declare(strict_types=1);
namespace App\Tests\Business;

use PHPUnit\Framework\TestCase;
use App\Business\Component;
use App\Business\ComponentSet;
final class ComponentTest extends BaseTestCase
{
    /**TODO
     * WHAT WE NEED TO DO
     * components, while clones of exercises, CANNOT EXIST WITHOUT A WORKOUT
     * therefore we need a workout when we create them
     * therefore we need to change things.
     *
     * OH GOD you need a workout to create a component but creating a workout creates components
     * is this a terrible circular loop? i think my architecture is sketchy
     *
     * QUESTION: when is it good to move things out for code deduplication and when is it better, for clarity and to avoid traps, to not do that?
     */
    // testing the actual creation of the component
    // so we're not using $this->component(), very intentionally.
    public function testCreate(): void
    {
        $this->assertInstanceOf(
            Component::class,
            Component::create($this->exercise(), $this->workout())
        );
    }

    // assumes components are created sanely; testing only the name maintenance
    public function testGetComponentNameSameAsExerciseName(): void
    {
        $exercise = $this->exercise("goesthrough");
        $component = $this->component($exercise);
        $this->assertEquals($exercise->getName(), $component->getName());
    }

    // assumes components are created correctly; testing the set list initialization, nothing else.
    public function testSetListInitializesEmpty(): void
    {
        $component = $this->component();
        $this->assertEmpty($component->getSetList());
    }

    // assumes components created correctly; testing component set functionality only.
    public function testAddComponentSetAddsToSetList(): void
    {
        $component = $this->component();
        $componentSet = ComponentSet::create(150, 5, $component);
        $component->addSet($componentSet);
        $setList = $component->getSetList();
        $this->assertNotEmpty($setList);
        $this->assertEquals($componentSet, $setList[0]);
    }

    // assumes creation is good, only dealing with IDs.
    public function testSetAndGetComponentId(): void
    {
        $component = $this->component();
        $id = 1;
        $component->setId($id);
        $this->assertEquals($id, $component->getId());
    }

    public function testGetIdBeforeSet(): void
    {
        $component = $this->component();
        $this->assertNull($component->getId());
    }

    public function testGetExercise(): void
    {
        $exercise = $this->exercise();
        $component = $this->component($exercise);
        $this->assertEquals($exercise, $component->getExercise());
    }
    public function testGetWorkout(): void
    {
        $workout = $this->workout();
        $component = $this->component($this->exercise(), $workout);
        $this->assertEquals($workout, $component->getWorkout());
    }
}
