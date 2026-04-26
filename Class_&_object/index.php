<?php

// require_once 'Movement.php';
// require_once 'Temperature.php';
// require_once 'Measurements.php';
// require_once 'SmartHome.php';

include 'autoloader.php';
spl_autoload_register('autoloader');


$sensor_m = new Movement('m1', 1);
$sensor_m->addMovementDate('02.05.2026');
$sensor_m->addMovementDate('05.05.2026');

// var_dump($sensor_m->getMovementDate());

$sensor_t = new Temperature('t2', 2);
$sensor_t->addMeasurements(new Measurements(24.2, '14.05.2026'));
$sensor_t->addMeasurements(new Measurements(28.2, '15.05.2026'));

// var_dump($sensor_t->getMeasurement());

$smart_home = new SmartHome('home');
$smart_home->addSensor($sensor_t, 'hall');
$smart_home->addSensor($sensor_t, 'kitchen');
$smart_home->addSensor($sensor_t, 'bedroom');
$smart_home->addSensor($sensor_m, 'kitchen');
$smart_home->addSensor($sensor_m, 'hall');


// var_dump($smart_home->getSensorRoom('hall'));
// var_dump($smart_home->getSensorRoom('kitchen'));
var_dump($smart_home->getSensorRoom('hall'));