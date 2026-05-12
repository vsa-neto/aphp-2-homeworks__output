<?php

declare(strict_types=1);

class Person
{
    private string $name;
    private string $surname;
    private string $status = 'user';
    private string $age = '';
    private $properties = [];
    private $isValid = false;

    public function __construct(string $name, string $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getFullName()
    {
        return "$this->surname $this->name \n";
    }

    public function __set(string $name, mixed $value)
    {
        echo "Добавляем свойство '$name' со значением '$value'\n";
        $this->properties[$name] = $value;
    }

    public function __get(string $name)
    {
        return ($this->properties[$name] ?? null) . "\n";
    }

    public function getAllProps()
    {
        foreach ($this->properties as $key => $prop) {
            echo "$key: $prop\n";
        }
    }

    public function __sleep()
    {
        $props = ['name', 'surname', 'status'];
        if (isset($this->properties['age'])) {
            $this->age = $this->properties['age'];
            $props[] = 'age';
        } else {
            echo "No" . PHP_EOL;
        }
        return $props;
    }

    private function validate()
    {
        if ($this->status !== 'admin') {
            echo "пользователь $this->name не имеет статус [admin]";
            throw new Exception("Недопусимая роль пользователя!");
        }
        $this->isValid = true;
    }

    public function __wakeup()
    {
        $this->validate();
    }


    public function __toString()
    {
        return "Пользователь: $this->surname $this->name " . $this->age . "\n";
    }
}
