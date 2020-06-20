<?php declare(strict_types=1);

final class Exercise
{
    private $name;
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
}
