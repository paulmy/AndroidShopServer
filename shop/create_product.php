<?php
// Создаем новую запись
// Вся информация о товаре считывается через запрос HTTP Post
 error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
// array for JSON response
$response = array();
 
// check for required fields

if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
	
	

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
 
    // подключаем файл с классом
    require_once __DIR__ . '/db_connect.php';
 
    // соединяемся с базой данных
    $db = new DB_CONNECT();
  if($name!=NULL && $price!=NULL && $description!=NULL){
	  // вставляем новую запись через INSERT
	$result = $db->query("INSERT INTO products(name, price, description) VALUES('$name', '$price', '$description')");  
 
    // проверяем, вставлена ли новая запись
    if ($result) {
        // запись успешно вставлена
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
		echo "Информация занесена в базу данных";

	
    // echoing JSON response
        echo json_encode($response);
    } else {
		
        // ошибка при вставке
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
		echo "Информация не занесена в базу данных";
        // echoing JSON response
        echo json_encode($response);
    }
  }
} else {
	echo "Ошибка ввода данных";
    // необходимые параметры отсутствуют
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
	
}

?>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title>Запись в БД через форму на php</title>
</head>
<body>
 <form method="POST" action="">
  <input name="name" type="text" placeholder="Название"/>
  <br/>
  <input name="price" type="text" placeholder="Цена"/>
  <br/>
  <input name="description" type="text" placeholder="Описание">
  <br/>
  <input type="submit" value="Отправить"/>
 </form>
 
 <p>Список продуктов</p>
 <iframe src="get_all_products.php" width="100%" height="200px">Загрузка....</iframe>
<a href="index.html">Главная</a>
</body>
</html>