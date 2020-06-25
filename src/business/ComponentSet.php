<?php declare(strict_types=1);

namespace App\Business;

final class ComponentSet
{
    private $weight;
    private $reps;
    private $id = null;
    private function __construct(float $weight, int $reps)
    {
        $this->weight = $weight;
        $this->reps = $reps;
    }

    public static function create(float $weight, int $reps): ComponentSet
    {
        return new self($weight, $reps);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
}
