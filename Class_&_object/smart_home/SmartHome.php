<?php

class SmartHome
{
    public string $name;
    public $sensors = [];
    public $rooms = ['hall', 'bedroom', 'kitchen'];

   public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addSensor(Temperature | Movement $sensor, string $room): void
    {
        if (!in_array($room, $this->rooms)) {
            $this->rooms[] = $room;
        }
        $this->sensors[] = array(
           'room' => $room, 
           'sensor' => $sensor
        );
    }

    public function getSensorRoom(string $room): array | string
    {
        if (!in_array($room, $this->rooms)) {
            return 'Нет такой комнаты';
        } else {
            $result = [];
            foreach ($this->sensors as $sensor) {
                if ($sensor['room'] == $room) {
                    $result[] = $sensor;
                }
            }
            return $result;
        }
    }
}
