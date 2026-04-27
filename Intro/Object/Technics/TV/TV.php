<?php

class TV
{
    private bool $On = false;
    private int $volume = 6;
    private int $channel = 1;

    const CRITICAL_VOLUME = 10;

    public function turnOn(): void
    {
        $this->On = !$this->On;
        echo $this->On ? "Телевизор включен" . PHP_EOL : "Телевизор выключен" . PHP_EOL;
    }

    public function onChannel(int $channel): void
    {
        if ($this->On) {
            $this->channel = $channel;
            // echo "Включен канал:" . $this->channel. PHP_EOL;
        }
    }

    public function upVolume(): void
    {
        if ($this->On && $this->volume < 10) {
            $this->volume++;
            // echo "Уровень громкости =" . $this->volume. PHP_EOL;
        }
    }

    public function downVolume(): void
    {
        if ($this->On && $this->volume > 1) {
            $this->volume--;
            // echo "Уровень громкости = " . $this->volume;
        }
    }

    public function infoTV(): void
    {
        echo "работает канал: " . $this->channel . PHP_EOL;
        if ($this->volume === self::CRITICAL_VOLUME) {
            echo "максимальная громкость: $this->volume" . PHP_EOL;
        } else {
            echo "Уровень громкости: $this->volume" . PHP_EOL;
        }
    }
}
