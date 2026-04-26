<?php

class Student
{
    public $education = [
        "course_1" => [
            "mathematics",
            "drawing",
            "mechanics",
            "materials",
        ],
        "course_2" => [
            "tribology",
            "mechanism repair",
            "welding technologies",
        ]
    ];

    public string $name;
    public int $id;
    private int $course = 1;
    private array $grades = [];

    public function __construct(string $name, int $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    public function addGrade(string $subject, int $grade): void
    {
        if ($this->course == 1 && count($this->grades) == 4) {
            $this->course = 2;
        }
   
        if ($this->course == 1) {
            $subjects = $this->education['course_1'];
        } elseif ($this->course == 2) {
            $subjects = $this->education['course_2'];
        }

        if (!in_array($subject, $subjects)) {
            echo "Предмет $subject отсутствует в курсе [ $this->course ]" . PHP_EOL;
        } else {

            foreach ($this->grades as $item) {
                if (is_array($item) && array_key_exists($subject, $item)) {
                    echo "Предмет $subject уже зачтен" . PHP_EOL;
                    return;
                }
            }
            if ($grade < 3) {
                echo "Предмет [ $subject ] необходимо пересдать" . PHP_EOL;
            } else {
                $this->grades[] = [$subject => $grade];
                echo "$this->name [$this->id] -> предмет [$subject] / оценка [$grade]" . PHP_EOL;
            }
        }
    }

    public function getStatus(): void
    {
        echo '------------------------' . PHP_EOL;

        if ($this->course == 2 && count($this->grades) == 7) {
            echo "$this->name [$this->id] дипломированный специалист";
        } else {
            echo "Студент $this->course-ого курса" . PHP_EOL;
        }

        echo PHP_EOL."Всего сдано предметов: " . PHP_EOL;

        foreach ($this->grades as $grade) {
            foreach ($grade as $key => $value) {
                echo "$key: $value" . PHP_EOL;
            }
        }
        echo '------------------------' . PHP_EOL;
    }
}
