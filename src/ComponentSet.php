<?php declare(strict_types=1);

final class ComponentSet
{
    private $weight;
    private $reps;
    private function __construct(float $weight, int $reps)
    {
        $this->weight = $weight;
        $this->reps = $reps;
    }

    public static function create(float $weight, int $reps): ComponentSet
    {
        return new self($weight, $reps);
    }
}
