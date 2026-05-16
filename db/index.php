
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

function dataTable($table, $pdo, $data)
{

    if ($table === 'shop') {
        $stmt = $pdo->prepare(
            "INSERT IGNORE INTO $table (name, address) 
        VALUES (:name, :address)"
        );
        $params = [
            ':name' => $data[0],
            ':address' => $data[1]
        ];
    }
    if ($table === 'client') {
        $stmt = $pdo->prepare(
            "INSERT IGNORE INTO $table (name, phone) 
        VALUES (:name, :phone)"
        );
        $params = [
            ':name' => $data[0],
            ':phone' => $data[1]
        ];
    }
    if ($table === 'product') {
        $stmt = $pdo->prepare(
            "INSERT IGNORE INTO $table (shop_id, name, price, count) 
        VALUES (:shop_id, :name, :price, :count)"
        );
        $params = [
            ':shop_id' => $data[0],
            ':name' => $data[1],
            ':price' => $data[2],
            ':count' => $data[3]
        ];
    }
    if ($table === 'orders') {
        $stmt = $pdo->prepare(
            "INSERT IGNORE INTO $table (shop_id, client_id, seller_name, created_at) 
        VALUES (:shop_id, :client_id, :seller_name, :created_at)"
        );
        $params = [
            ':shop_id' => $data[0],
            ':client_id' => $data[1],
            ':seller_name' => $data[2],
            ':created_at' => $data[3]
        ];
    }
    if ($table === 'order_product') {
        $stmt = $pdo->prepare(
            "INSERT IGNORE INTO $table (order_id, product_id, price, count) 
        VALUES (:order_id, :product_id, :price, :count)"
        );
        $params = [
            ':order_id' => $data[0],
            ':product_id' => $data[1],
            ':price' => $data[2],
            ':count' => $data[3]
        ];
    }
    $stmt->execute($params);
}


foreach ($shops as $shop) {
    dataTable('shop', $pdo, $shop);
}

foreach ($clients as $client) {
    dataTable('client', $pdo, $client);
}

foreach ($products as $product) {
    dataTable('product', $pdo, $product);
}
foreach ($orders as $order) {
    dataTable('orders', $pdo, $order);
}
foreach ($order_products as $order_product) {
    dataTable('order_product', $pdo, $order_product);
}



$shopTable = new ShopTable($pdo);
$clientTable = new ClientTable($pdo);
$productTable = new ProductTable($pdo);
$orderTable = new OrderTable($pdo);

// 1. Тест INSERT
echo "<br>"."[INSERT] Добавляем новый магазин...\n"."<br>";
$newShop = $shopTable->insert(
    ['name', 'address'],
    ['ТехноПлюс', 'ул. Новая, д. 1']
);
print_r($newShop);


echo "<br>"."[INSERT] Добавляем нового клиента..."."<br>";
$newClient = $clientTable->insert(
    ['name', 'phone'],
    ['Алексей Петров', '+79990001122']
);
print_r($newClient);


// 2. Тест UPDATE
echo "<br>"."[UPDATE] Изменяем адрес магазина с ID " . $newShop['shop_id']."<br>";
$updatedShop = $shopTable->update(
    $newShop['shop_id'],
    ['address' => 'ул. Пушкина, д. 10 (Переезд)']
);
print_r($updatedShop);

// 3. Тест FIND
echo "<br>"."[FIND] Ищем в базе клиента с ID " . $newClient['client_id']."<br>";
$foundClient = $clientTable->find($newClient['client_id']);
print_r($foundClient);

// 4. Тест DELETE
echo "<br>"."[DELETE] Удаляем клиента с ID " . $newClient['client_id']."<br>";
$isDeleted = $clientTable->delete($newClient['client_id']);
echo "Результат удаления (bool): " . ($isDeleted ? 'true' : 'false')."<br>";

echo "<br>"."[FIND] Проверяем существование удаленного клиента..."."<br>";
$deletedClientCheck = $clientTable->find($newClient['client_id']);
print_r($deletedClientCheck); // Выведет пустой массив []