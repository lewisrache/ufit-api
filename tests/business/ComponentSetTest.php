<?php declare(strict_types=1);
namespace App\Tests\Business;

use PHPUnit\Framework\TestCase;
use App\Business\ComponentSet;
final class ComponentSetTest extends TestCase
{
    public function testCreateSetWithWeightAndReps(): void
    {
        $weight = 150.5;
        $reps = 5;
        $this->assertInstanceOf(
            ComponentSet::class,
            ComponentSet::create($weight, $reps)
        );
    }

    public function testSetAndGetComponentId(): void
    {
        $set = ComponentSet::create(150, 15);
        $id = 1;
        $set->setId($id);
        $this->assertEquals($id, $set->getId());
    }

    public function testGetIdBeforeSet(): void
    {
        $set = ComponentSet::create(150, 15);
        $this->assertNull($set->getId());
    }
}
