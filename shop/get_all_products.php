<?php
// Получаем список всех продуктов
 error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
// массив JSON-ответов
$response = array();
 
// подключаем класс соединения с базой
require_once __DIR__ . '/db_connect.php';
 
// подключаемся к базе данных
$db = new DB_CONNECT();
 
// получаем список всех товаров из таблицы products
$result = $db->query('SELECT * FROM products') or die('Ошибка при получении списка товаров');

// если данные есть
if (mysqli_num_rows($result) > 0) {
    // проходим в цикле через все результаты
    $response["products"] = array();
 
    while ($row = mysqli_fetch_array($result)) {
        $product = array();
        $product["pid"] = $row["pid"];
        $product["name"] = $row["name"];
        $product["price"] = $row["price"];
        $product["description"] = $row["description"];
 
        // помещаем информацияю о товаре  в массив
        array_push($response["products"], $product);
    }
    // success
    $response["success"] = 1;
 
    echo json_encode($response);
} else {
    // если товаров нет
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    echo json_encode($response);
}
?>
