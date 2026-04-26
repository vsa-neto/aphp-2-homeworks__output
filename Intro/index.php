<?php

// require_once 'Student.php';
// require_once 'Car.php';
// require_once 'Drive.php';
// require_once 'TV.php';

include 'autoloader.php';
spl_autoload_register('autoloader');

$student_256 = new Student('Victor', 256);

$student_256->addGrade('mathematics', 4);
$student_256->addGrade('drawing', 5);
$student_256->addGrade('mechanics', 3);
$student_256->addGrade('materials', 4);

$student_256->addGrade('tribology', 5);
$student_256->addGrade('mechanism repair', 5);
$student_256->addGrade('welding technologies', 4);

$student_256->getStatus();


$Car_1 = new Car('Honda', 'CRV', 100 );
$Car_1->start();
$Car_1->drive(new Drive(200));


$Car_1 = new Car('Honda', 'CRV', 100 );
$Car_1->start();
$Car_1->drive(new Drive(200));


echo '---------------'.PHP_EOL;

$TV_1 = new TV ();
$TV_1->turnOn();

$TV_1->onChannel(7);

$TV_1->upVolume();
$TV_1->upVolume();
$TV_1->upVolume();

$TV_1->infoTV();
