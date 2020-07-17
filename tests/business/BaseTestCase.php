<?php declare(strict_types=1);
namespace App\Tests\Business;

use PHPUnit\Framework\TestCase;
use App\Business\Component;
use App\Business\ComponentSet;
use App\Business\Exercise;
use App\Business\Program;
use App\Business\User;
use App\Business\Workout;
class BaseTestCase extends TestCase
{
    /* Functions that return commonly used creation methods, for tests where the creation is not the thing being tested */

    protected function workout(): Workout
    {
        $program = Program::create(
            'programname',
            User::fromName("newuser"),
            ...[$this->exercise('exercisename')]
        );
        return Workout::fromProgram($program);
    }

    protected function exercise(string $name = "bogus"): Exercise
    {
        return Exercise::fromString($name);
    }

    protected function component(Exercise $exercise = null, Workout $workout = null): Component
    {
        if (is_null($exercise)) {
            $exercise = $this->exercise();
        }
        if (is_null($workout)) {
            $workout = $this->workout();
        }
        return Component::create($exercise, $workout);
    }

    protected function componentSet(): ComponentSet
    {
        return ComponentSet::create(150, 15, $this->component());
    }
}
