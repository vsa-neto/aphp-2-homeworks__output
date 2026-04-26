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

    public function __construct(string $name, int $id) {
        $this->name = $name;
        $this->id = $id;
    }

    public function addGrade(string $subject, int $grade): void {
        $subjects = [];
        foreach ($this->education as $course) {
            foreach ($course as $key) {
                $subjects[] = $key;
            }
        }

        if ($this->course == 1) {
            $subjectsList = array_slice($subjects, 0, 4);
        } else {
            $subjectsList = array_slice($subjects, 4);
        }

        if (!in_array($subject, $subjectsList)) {
            echo "Предмет $subject отсутствует в данном курсе [ $this->course ]" . PHP_EOL;
        } else {

            if ($grade < 3) {
                echo "Предмет [ $subject ] необходимо пересдать" . PHP_EOL;
            } else {
                $this->grades[] = [$subject => $grade];
                echo "$this->name [$this->id] -> сдал предмет $subject / получил оценку $grade" . PHP_EOL;
            }
        }
    }

    public function getStatus(): void
    {
        if ($this->course == 1 && count($this->grades) == 4) {
            $this->course = 2;
            echo "Студент  $this->course-ого курса" . PHP_EOL;
        } elseif ($this->course == 2 && count($this->grades) == 7) {
        }

        echo "Студент $this->course-ого курса" . PHP_EOL;
        echo "Всего сдано предметов: " . PHP_EOL;

        foreach ($this->grades as $grade) {
            foreach ($grade as $key => $value) {
                echo "$key: $value" . PHP_EOL;
            }
        }
    }
}
