<?php

declare(strict_types=1);

require_once 'autoload.php';
require_once './functions.php';

$director = new Director('Иванов', 'Иван', 'директор');
$manager_1 = new Manager('Петров', 'Петр', 'менеджер по продажам');
$manager_2 = new Manager('Федоров', 'федор', 'менеджер проектов');
$programmer_1 = new Programmer('Андреев', 'Андрей', 'программист');
$programmer_2 = new Programmer('Сергеев', 'Сергей', 'программист');
$tester_1 = new Tester('Максимов', 'Максим', 'тестировщик');

try {
    $director->setSalary(10000);
    $director->setExperience(10.5);
    $director->setСharacter('wicked');
    // $director->setСharacter(5);    //  !string
    echo ($director->getExperience());

    $manager_1->setSalary(5000);
    $manager_1->setExperience(8.0);
    // $manager_1->setExperience(8);     // !float
    $manager_1->setWebinar('"продажи / работа с возражениями"');
    echo ($manager_1->getExperience());

    $manager_2->setSalary(4000);
    // $manager_2->setSalary('4000');    //  !int
    $manager_2->setExperience(10.0);
    $manager_2->setWebinar('"разработка и внедрение продукта"');
    echo ($manager_2->getExperience());

    $programmer_1->setSalary(4000);
    $programmer_1->setExperience(8.0);
    $programmer_1->setSkills(['php', 'js', 'TypeScript', 'Python', 'SQL']);
    // $programmer_1->setSkills('php, js, TypeScript, Python, SQL');     //  !array
    echo ($programmer_1->getSkills());

    $programmer_2->setSalary(3500);
    $programmer_2->setExperience(5.0);
    $programmer_2->setSkills(['php', 'js', 'SQL']);
    // $programmer_2->setSkills([]);
    echo ($programmer_2->getSkills());

    $tester_1->setSalary(3000);
    $tester_1->setExperience(5.0);
    $tester_1->setBonus(true);
    // $tester_1->setBonus(10);  //  !bool

    echo ($tester_1->getBonus());

    employeesData($director, $manager_1, $manager_2, $programmer_1);   //  null || !object 

} catch (Exception $e) {
    echo  PHP_EOL . "\e[31mОшибка: " . $e->getMessage() . "\e[0m\n" . PHP_EOL;
    exit;
}
