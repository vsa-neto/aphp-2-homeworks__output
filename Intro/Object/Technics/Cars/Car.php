<?php

class Car
{
    public string $brand;
    public string $model;
    public int $fuelLevel;
    private bool $isStarted = false;
    const int CRITICAL_SPEED = 200;

    public function __construct(
        string $brand,
        string $model,
        int $fuelLevel,

    ) {
        $this->brand = $brand;
        $this->model = $model;
        $this->fuelLevel = $fuelLevel;
    }

    public function start(): void
    {

        echo "объем топлива = $this->fuelLevel л.". PHP_EOL;
        switch (true) {
            case $this->fuelLevel === 0:
                echo "Топливо осутствует!" . PHP_EOL;
                break;
            case $this->fuelLevel > 0 && $this->fuelLevel <= 5:
                echo "Низкий уровень топлива!" . PHP_EOL;
                $this->isStarted = true;
                break;
            default:
                $this->isStarted = true;
                break;
        }
    if($this->isStarted) {
            echo "Двигатель заведен" . PHP_EOL;
        }
    }
    public function drive(Drive $drive): void
    {

    if($drive->currentSpeed === 0) {$this->isStarted = false; }
        if ($this->isStarted) {
            if ($drive->currentSpeed > self::CRITICAL_SPEED) {
                $drive->speedMessage(self::CRITICAL_SPEED);
            }
            echo "скорость в данный момент = $drive->currentSpeed км/ч" . PHP_EOL;
        }
    }
}


