<?php

class Temperature
{
    public string $name;
    public int $id;
    private array $measurements = [];
    const CRITICAL_VALUE = 28.0;

    public function __construct(string $name, int $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    public function addMeasurements(Measurements $measurements): void
    {
        $this->measurements[] = $measurements;
        if ($measurements->value > self::CRITICAL_VALUE) {
            $this->notifiction($measurements->value);
        }
    }

    public function getMeasurement(): array
    {
        return $this->measurements;
    }

    public function notifiction(float $value): void
    {
        echo 'На датчике ' . $this->name . ' высокая температура ' . $value . PHP_EOL;
    }
}
