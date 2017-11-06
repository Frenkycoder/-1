<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.11.2017
 * Time: 16:51
 */

require_once 'login.php';

//Data from form
$name = $_POST['name'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$street = $_POST['street'];
$home = $_POST['home'];
$part = $_POST['part'];
$apt = $_POST['$apt'];
$floor = $_POST['floor'];

//Mysql connection
$connect = new mysqli($db_hostname, $db_user, $db_pass, $db_database);
if ($connect->connect_error) {
    die($connect->connect_error);
}

function escape($connect, $data)
{
    return $connect->real_escape_string($data);
}

//
//function orderReg($connect, $mail, $street, $home, $part, $apt, $floor)
//{
//    // оформлення заказу
//    $order = "INSERT INTO orders (address, delivery, user_id) VALUES ('".
//        escape($connect, $street)."','". escape($connect, $home).
//        escape($connect, $part).escape($connect, $apt).
//        escape($connect, $floor).
//        "',(SELECT id FROM users WHERE email='".$mail."'))";
//    $regres = $connect->query($order);
//    if (!$regres) {
//        die($connect->error);
//    } else {
//        echo "Заказ оформлен";
//    }
//}

//function getOrderId($connect)
//{
//    $query = "SELECT id FROM orders";
//    $result = $connect->query($query);
//    if (!$result) {
//        die($connect->error);
//    }
//    $row = $result->fetch_all(MYSQLI_NUM);
//    $row = end($row);
//    return $row[0];
//}
//$getOrderId = getOrderId($connect);
//$getOrderId = escape($connect, $getOrderId);


//function getUserId($getOrderId, $connect)
//{
//    $query = "SELECT user_id FROM orders WHERE id=$getOrderId";
//    $result = $connect->query($query);
//    if (!$result) {
//        die($connect->error);
//    }
//    $row2 = $result->fetch_assoc();
//    $user_id = $row2['user_id'];
//    return $user_id;
//}
//    $getUserId = getUserId($getOrderId, $connect);
//    $getUserId = escape($connect, $getUserId);

//function ordersCount($getUserId, $connect)
//{
//    $query = "SELECT * FROM orders WHERE user_id=$getUserId";
//    $result = $connect->query($query);
//    if (!$result) {
//        die($connect->error);
//    }
//    $row_cnt = $result->num_rows;
//    return $row_cnt + 1;
//}
//$row_cnt = ordersCount($getUserId, $connect);
//function putToTheFile($getOrderId, $street, $home, $part, $floor, $apt, $row_cnt)
//{
//    $data = "Заказ №{$getOrderId} \n
//        Ваш заказ будет доставлен по адресу \n
//        $street $home $part $floor $apt \n
//        Содержимое заказа - DarkBeefBurger за 500 рублей, 1 шт \n
//        Спасибо!Это ваш $row_cnt  заказ";
//    file_put_contents('result.html', $data);
//}
//Check is $mail exist
$query = "SELECT email FROM users";
$result = $connect->query($query);
$row = $result->fetch_all(MYSQLI_NUM);
$key = array_search($mail, array_column($row, '0'));
if ($key) {
    echo "Таке мило вже є!";
    // оформлення заказу
    $order = "INSERT INTO orders (address, delivery, user_id) VALUES ('".
        escape($connect, $street)."','". escape($connect, $home).
        escape($connect, $part).escape($connect, $apt).
        escape($connect, $floor).
        "',(SELECT id FROM users WHERE email='".$mail."'))";
    $regres = $connect->query($order);
    if (!$regres) {
        die($connect->error);
    } else {
        echo "Заказ оформлен";
    }
    $query = "SELECT id FROM orders";
    $result = $connect->query($query);
    if (!$result) {
        die($connect->error);
    }
    $row = $result->fetch_all(MYSQLI_NUM);
    $row = end($row);
    $query = "SELECT user_id FROM orders WHERE id=$row[0]";
    $result = $connect->query($query);
    if (!$result) {
        die($connect->error);
    }
    $row2 = $result->fetch_assoc();
    $user_id = $row2['user_id'];
    $query = "SELECT * FROM orders WHERE user_id=$user_id";
    $result = $connect->query($query);
    if (!$result) {
        die($connect->error);
    }
    $row_cnt = $result->num_rows;
    $data = "Заказ №{".$row[0]."} \n 
        Ваш заказ будет доставлен по адресу \n
        $street $home $part $floor $apt \n
        Содержимое заказа - DarkBeefBurger за 500 рублей, 1 шт \n
        Спасибо!Это ваш $row_cnt  заказ";
    file_put_contents('result.php', $data);
} elseif ($connect->error) {
    die($connect->error);
} else {
    // 'реєструється юзер'
    $register =
        "INSERT INTO users (email, name, phone) VALUES ('".
        escape($connect, $mail)."','".
        escape($connect, $name)."','".
        escape($connect, $phone)."')";
    $regres = $connect->query($register);
    if (!$regres) {
        die($connect->error);
    }
    // оформлення заказу
    $order = "INSERT INTO orders (address, delivery, user_id) VALUES ('".
        escape($connect, $street)."','". escape($connect, $home).
        escape($connect, $part).escape($connect, $apt).
        escape($connect, $floor).
        "',(SELECT id FROM users WHERE email='".$mail."'))";
    $regres = $connect->query($order);
    if (!$regres) {
        die($connect->error);
    } else {
        echo "Заказ оформлен";
    }
    $query = "SELECT id FROM orders";
    $result = $connect->query($query);
    if (!$result) {
        die($connect->error);
    }
    $row = $result->fetch_all(MYSQLI_NUM);
    $row = end($row);

    $query = "SELECT user_id FROM orders WHERE id=$row[0]";
    $result = $connect->query($query);
    if (!$result) {
        die($connect->error);
    }
    $row2 = $result->fetch_assoc();
    $user_id = $row2['user_id'];
    $query = "SELECT * FROM orders WHERE user_id=$user_id";
    $result = $connect->query($query);
    if (!$result) {
        die($connect->error);
    }
    $row_cnt = $result->num_rows;
    $data = "Заказ №{".$row[0]."} \n 
        Ваш заказ будет доставлен по адресу \n
        $street $home $part $floor $apt \n
        Содержимое заказа - DarkBeefBurger за 500 рублей, 1 шт \n
        Спасибо!Это ваш первий заказ";
    file_put_contents('result.php', $data);
}
