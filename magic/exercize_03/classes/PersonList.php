<?php

declare(strict_types=1);

class PersonList implements Iterator
{
    private $people = [];
    private $position = 0;

    public function addPerson(Person $people)
    {
        $this->people[] = $people;
    }

// методы встроенного в PHP интерфейса: Iterator

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): mixed
    {
        return $this->people[$this->position];
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset($this->people[$this->position]);
    }
}
