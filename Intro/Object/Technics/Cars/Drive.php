<?php

class Drive
{

    public float $currentSpeed;

    public function __construct(int $currentSpeed)
    {
        $this->currentSpeed = $currentSpeed;
    }

    public function speedMessage($criticalSpeed): void
    {
        echo "Максимально допустимое значение скорости = $criticalSpeed км/ч" . PHP_EOL;
    }
}
