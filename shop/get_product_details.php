<?php
// Информация об отдельном товаре
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
// array for JSON response
$response = array();
 
// подключаем файл с классом
require_once __DIR__ . '/db_connect.php';
 
// соединяемся с базой данных
$db = new DB_CONNECT();
 
// проверяем данные GET
if (isset($_GET["pid"])) {
    $pid = $_GET['pid'];
 
    // получаем данные о товаре из таблицы products
    $result = $db->query("SELECT * FROM products WHERE pid = $pid");
 
    if (!empty($result)) {
        // если данные есть
        if (mysqli_num_rows($result) > 0) {
 
            $result = mysqli_fetch_array($result);
 
            $product = array();
            $product["pid"] = $result["pid"];
            $product["name"] = $result["name"];
            $product["price"] = $result["price"];
            $product["description"] = $result["description"];
            // success
            $response["success"] = 1;
 
            $response["products"] = array();
 
            array_push($response["products"], $product);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // не нашли данных
            $response["success"] = 0;
            $response["message"] = "No product found";
 
            echo json_encode($response);
        }
    } else {
        // не нашли данных
        $response["success"] = 0;
        $response["message"] = "No product found";
 
        echo json_encode($response);
    }
} else {
    // отсутствуют необходимые параметры
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    echo json_encode($response);
}
?>
