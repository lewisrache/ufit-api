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
}
