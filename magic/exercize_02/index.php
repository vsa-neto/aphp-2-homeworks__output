<?php

declare(strict_types=1);

require_once 'autoload.php';

$user = new CheckUser();

echo ($user->login("user_M1", 1234));
echo PHP_EOL . "----------------------" . PHP_EOL;

echo ($user->login("user_A1", 5678));
echo PHP_EOL . "----------------------" . PHP_EOL;

echo ($user->login("user_B1", 5678));
echo PHP_EOL . "----------------------" . PHP_EOL;
