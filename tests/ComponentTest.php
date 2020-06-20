<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class ComponentTest extends TestCase
{
    public function testCanCreateFromExercise(): void
    {
        $this->assertInstanceOf(
            Component::class,
            Component::fromExercise(Exercise::fromString("componentize"))
        );
    }
    public function testGetComponentNameSameAsExerciseName(): void
    {
        $expectedName = "goesthrough";
        $exercise = Exercise::fromString($expectedName);
        $component = Component::fromExercise($exercise);
        $this->assertEquals($exercise->getName(), $component->getName());
    }

    public function testSetListInitializesEmpty(): void
    {
        $component = Component::fromExercise(Exercise::fromString("bogus"));
        $this->assertEmpty($component->getSetList());
    }

    public function testAddComponentSetAddsToSetList(): void
    {
        $componentSet = ComponentSet::create(150, 5);
        $component = Component::fromExercise(Exercise::fromString("bogus"));
        $component->addSet($componentSet);
        $setList = $component->getSetList();
        $this->assertNotEmpty($setList);
        $this->assertEquals($componentSet, $setList[0]);
    }
}
