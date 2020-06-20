<?php declare(strict_types=1);

final class User
{
    private $name;
    private $programs;
    private function __construct($name)
    {
        $this->name = $name;
        $this->programs = [];
    }
    public static function fromName(string $name): User
    {
        return new self($name);
    }

    public function addProgram(Program $program): void
    {
        $this->programs[] = $program;
    }

    public function getPrograms(): array
    {
        return $this->programs;
    }
}
