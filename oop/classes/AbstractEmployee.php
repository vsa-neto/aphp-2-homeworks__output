<?php

declare(strict_types=1);

abstract class AbstractEmployee
{
    protected string $name;
    protected string $surname;
    protected string $position;
    protected float $experience = 0.0;

    private int $salary;
    private array $skills = [];

    private bool $bonus = false;

    // public function __construct(string $surname, string $name, string $position, array $skills = [])
    public function __construct(string $surname, string $name, string $position)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->position = $position;
    }

    abstract public function getFullName(): string;

    public function getPosition(): string
    {
        return  $this->position;
    }

    public function setSalary($salary): void
    {
        if (!is_int($salary)) {
            throw new Exception('В объявлении метода "setSalary(int)" указан неправильный тип данных');
        }
        $this->salary = $salary;
    }
    public function getSalary(): int
    {
        return  $this->salary;
    }

    public function setSkills($skills): void
    {
        if (!is_array($skills)) {
            throw new Exception('В объявлении метода "setSkills(array)" указан неправильный тип данных');
        }
        $this->skills = $skills;
    }
    public function getSkills(): string
    {
        if (empty($this->skills)) {
            return "Навыки сотрудника $this->surname $this->name не указаны" . PHP_EOL;
        }
        $skillsList = implode(', ', $this->skills);
        return "$this->surname $this->name // Навыки: { $skillsList }" . PHP_EOL;
    }

    public function setExperience($experience): void
    {
        if (!is_float($experience)) {
            throw new Exception('В объявлении метода "setSkills(float[0.0])" указан неправильный тип данных');
        }
        $this->experience = $experience;
    }
    public function getExperience(): string
    {
        return $this->getFullName() . " // cтаж: " . $this->experience . " года/лет" . PHP_EOL;
    }

    public function setBonus($bonus): void
    {
        if (!is_bool($bonus)) {
            throw new Exception('В объявлении метода "setBonus(bool)" указан неправильный тип данных');
        }
        $this->bonus = $bonus;
    }
    public function getBonus(): string
    {
        if ($this->bonus) {
            return PHP_EOL . "Выписать премию сотруднику [ $this->surname $this->name ]" . PHP_EOL;
        }
        return "для сотрудника [ $this->surname $this->name ] премии нет" . PHP_EOL;
    }
}
