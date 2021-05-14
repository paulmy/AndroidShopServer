<?php
// Обновляем информацию о товаре через product id (pid)
 error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['pid']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
 
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
 
    // подключаем файл с классом
    require_once __DIR__ . '/db_connect.php';
 
    // соединяемся с базой данных
    $db = new DB_CONNECT();
 
    // обновляем ряд в таблице по pid
    $result = $db->query("UPDATE products SET name = '$name', price = '$price', description = '$description' WHERE pid = $pid");
 
    // проверяем успешность вставки
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
 
        echo json_encode($response);
    } else {
 
    }
} else {
    // отсутствуют нужные параметры
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    echo json_encode($response);
}
?><html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title>Обновление данных</title>
</head>
<body>
 <form method="POST" action="">
 <input name="pid" type="text" placeholder="id"/>
  <input name="name" type="text" placeholder="Название"/>
  <input name="price" type="text" placeholder="Цена"/>
  <input name="description" type="text" placeholder="Описание"/>
  <input type="submit" value="Отправить"/>
 </form>
  <iframe src="get_all_products.php" width="100%" height="200px">Загрузка....</iframe>
 <a href="index.html">Главная</a>
</body>
</html>
