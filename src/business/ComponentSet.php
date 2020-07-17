<?php declare(strict_types=1);

namespace App\Business;

final class ComponentSet
{
    private $weight;
    private $reps;
    private $component;
    private $id = null;
    private function __construct(float $weight, int $reps, Component $component)
    {
        $this->weight = $weight;
        $this->reps = $reps;
        $this->component = $component;
    }

    public static function create(float $weight, int $reps, Component $component): ComponentSet
    {
        return new self($weight, $reps, $component);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getComponent(): Component
    {
        return $this->component;
    }
    public function getWeight(): float
    {
        return $this->weight;
    }
    public function getReps(): int
    {
        return $this->reps;
    }
}
