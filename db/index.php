
<?php

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/tables.php';


$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbName = 'my_database';

try {
    // 1. Подключение к серверу БЕЗ указания $dbName
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Создаем базу данных, если ее нет
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "База данных успешно создана или уже существует.";

    // 3. Подключение к созданной базе
    $pdo->exec("USE `$dbName`;");

    // Подключение sql с таблицами:
    $sqlTables = file_get_contents('./sql_db/tables.sql');
    $pdo->exec($sqlTables);

} catch (PDOException $e) {
    die("Ошибка: " . $e->getMessage());
}


$shopTable = new ShopTable($pdo);
$clientTable = new ClientTable($pdo);
$productTable = new ProductTable($pdo);
$orderTable = new OrderTable($pdo);

// 1. Тест INSERT
echo "<br>"."\n"."[INSERT] Добавляем новый магазин...\n"."<br>";
$newShop = $shopTable->insert(
    ['name', 'address'],
    ['ТехноПлюс', 'ул. Новая, д. 1']
);
print_r($newShop);


echo "<br>"."\n"."[INSERT] Добавляем нового клиента...\n"."<br>";
$newClient = $clientTable->insert(
    ['name', 'phone'],
    ['Алексей Петров', '+79990001122']
);
print_r($newClient);


// 2. Тест UPDATE
echo "<br>"."\n"."[UPDATE] Изменяем адрес магазина с ID" . $newShop['shop_id']."\n"."<br>";
$updatedShop = $shopTable->update(
    $newShop['shop_id'],
    ['address' => 'ул. Пушкина, д. 10 (Переезд)']
);
print_r($updatedShop);

// 3. Тест FIND
echo "<br>"."\n"."[FIND] Ищем в базе клиента с ID " . $newClient['client_id']."\n"."<br>";
$foundClient = $clientTable->find($newClient['client_id']);
print_r($foundClient);

// 4. Тест DELETE
echo "<br>"."\n"."[DELETE] Удаляем клиента с ID " . $newClient['client_id']."\n"."<br>";
$isDeleted = $clientTable->delete($newClient['client_id']);
echo "Результат удаления (bool): " . ($isDeleted ? 'true' : 'false')."\n"."<br>";

echo "<br>"."\n"."[FIND] Проверяем существование удаленного клиента..."."\n"."<br>";
$deletedClientCheck = $clientTable->find($newClient['client_id']);
print_r($deletedClientCheck); // Выведет пустой массив []