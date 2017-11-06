<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05.11.2017
 * Time: 13:18
 */
require_once 'login.php';

//Mysql connection
$connect = new mysqli($db_hostname, $db_user, $db_pass, $db_database);
if ($connect->connect_error) {
    die($connect->connect_error);
}

$query = "SELECT * FROM orders";
$result = $connect->query($query);
if (!$result) {
    die($connect->error);
}
echo "Все закази \n";
echo "<br>";
while ($row = $result->fetch_assoc()) {
    echo "Id заказа " . $row['id'] . " Адресс " . $row['address'] . " Доставка " . $row['delivery'] . " Id юзера " .
        $row['user_id'] . "<br>";
}

$query = "SELECT * FROM users";
$result = $connect->query($query);
if (!$result) {
    die($connect->error);
}
echo "Все пользиватели \n";
echo "<br>";
while ($row = $result->fetch_assoc()) {
    echo "Email юзера " . $row['email'] . " Имя " . $row['name'] . " Телефон " . $row['phone'] . " Id юзера " .
        $row['id'] . "<br>";
}