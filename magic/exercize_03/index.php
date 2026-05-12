<?php

declare(strict_types=1);

require_once 'autoload.php';

$person_1 = new Person('Ivan', 'Ivanov');
$person_PP_1 = new Person('Andrey', 'Andreev');

$person_1->age = '50';
$person_1->job = "инженер";
$person_1->hobby = "рыбалка";
$person_1->setStatus('admin');
echo PHP_EOL . "-------------------------------------" . PHP_EOL;

echo $person_1->getFullName();
echo $person_1->job;
echo $person_1->age;

$person_1->getAllProps();

echo PHP_EOL . "-------------------------------------" . PHP_EOL;
$strPerson_1 = serialize($person_1);
echo $strPerson_1 . PHP_EOL;

$nameChanged = "Petr";

// $str_1 = str_replace("Ivan", "Petr", $strPerson_1); 
$str_1 = preg_replace('/' . $person_1->getName() . '/', $nameChanged, $strPerson_1, 1);

echo $str_1 . PHP_EOL;
echo $strPerson_1 . PHP_EOL;
echo PHP_EOL . "-------------------------------------" . PHP_EOL;

function unserializeObj($str)
{
    try {
        $newObj = unserialize($str);
        echo "Сессия восстановлена для: " . $newObj->getFullName();
        return $newObj;
    } catch (Exception $e) {
        echo "Ошибка безопасности: " . $e->getMessage() . PHP_EOL;
    }
}

$userChecked_1 = unserializeObj($strPerson_1);
$userChecked_2 = unserializeObj($str_1);

$list = new PersonList();
$list->addPerson($userChecked_1);
$list->addPerson($userChecked_2);
$list->addPerson(new Person("Anna", "German"));

echo "Список пользователей:" . PHP_EOL;
foreach ($list as $person) {
    echo $person;
}
