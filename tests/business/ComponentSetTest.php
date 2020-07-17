<?php declare(strict_types=1);
namespace App\Tests\Business;

use PHPUnit\Framework\TestCase;
use App\Business\ComponentSet;
final class ComponentSetTest extends BaseTestCase
{
    public function testCreateSetWithWeightAndReps(): void
    {
        $weight = 150.5;
        $reps = 5;
        $this->assertInstanceOf(
            ComponentSet::class,
            ComponentSet::create($weight, $reps, $this->component())
        );
    }

    public function testSetAndGetComponentSetId(): void
    {
        $set = ComponentSet::create(150, 15, $this->component());
        $id = 1;
        $set->setId($id);
        $this->assertEquals($id, $set->getId());
    }

    public function testGetIdBeforeSet(): void
    {
        $set = ComponentSet::create(150, 15, $this->component());
        $this->assertNull($set->getId());
    }

    public function testGetComponent(): void
    {
        $component = $this->component();
        $set = ComponentSet::create(150, 15, $component);
        $this->assertEquals($component, $set->getComponent());
    }

    public function testGetWeight(): void
    {
        $weight = 150;
        $set = ComponentSet::create($weight, 15, $this->component());
        $this->assertEquals($weight, $set->getWeight());
    }

    public function testGetReps(): void
    {
        $reps = 15;
        $set = ComponentSet::create(150, $reps, $this->component());
        $this->assertEquals($reps, $set->getReps());
    }
}
