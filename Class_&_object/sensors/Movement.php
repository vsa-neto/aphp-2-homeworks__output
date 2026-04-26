<?php

class Movement
{
    public string $name;
    public int $id;
    private array $movement_data = [];

    public function __construct(string $name, int $id)
    {
        $this->name = $name;
        $this->id = $id;
    }
    public function addMovementDate(string $movementDate): void
    {
        $this->movement_data[] = $movementDate;
    }

    public function getMovementDate(): array
    {
        return $this->movement_data;
    }
}
