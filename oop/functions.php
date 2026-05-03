<?php

declare(strict_types=1);

function employeesData(...$employees)
{
    $totalSalary = 0;
    $persons = 0;

    foreach ($employees as $employee) {

        if (is_null($employee) || !is_object($employee)) {
            throw new Exception('В аргументах функции "employeesData([obj1, obj2,...])" неправильный тип данных');
        }

        if ($employee instanceof AbstractEmployee) {

            $totalSalary += $employee->getSalary();
            $persons++;

            echo ($employee->getFullName()) . ", позиция: " . ($employee->getPosition()) . ", зарплата: " . ($employee->getSalary()) . " $";

            if ($employee instanceof LeadInterface) {
                echo ($employee->manage());
            }
            if ($employee instanceof Director) {
                echo ($employee->getСharacter());
            }
            if ($employee instanceof WebinarSpeakerInterface) {
                echo ($employee->getWebinar());
            }
            if ($employee instanceof ApplicationCreatorInterface) {
                echo ($employee->codeCreator());
            }

            if ($employee instanceof ApplicationCreatorInterface) {
                echo ($employee->codeCreator());
            }
        }

        echo PHP_EOL . "------------------------" . PHP_EOL;
    }
    echo "Общее количество сотрудников: $persons" . PHP_EOL;
    echo "Общая сумма зарплат: $totalSalary" . PHP_EOL;
}