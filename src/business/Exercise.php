<?php declare(strict_types=1);

namespace App\Business;

final class Exercise
{
    private $name;
    private $id = null;
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fromString(string $name): Exercise
    {
        return new self($name);
    }

    public function getName(): string
    {
        return $this->name;
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
