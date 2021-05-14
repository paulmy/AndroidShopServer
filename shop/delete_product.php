<?php
// Удаляем товар из базы данных по product id (pid)
  error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
 
    // подключаем файл с классом
    require_once __DIR__ . '/db_connect.php';
 
    // соединяемся с базой
    $db = new DB_CONNECT();
 
    // удаляем запись по pid
	$result = $db->query("DELETE FROM products WHERE pid = $pid");
	
	

    // check if row deleted or not
    if (mysqli_affected_rows() >=1) {
	//if (mysqli_num_rows() !=0) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully deleted";
 
    //    
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";
 
   //     echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
  //  echo json_encode($response);
}
echo json_encode($response);
?>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title>Удаление данных</title>
</head>
<body>
 <form method="POST" action="">
 <input name="pid" type="text" placeholder="id"/>
  
  <input type="submit" value="Отправить"/>
 </form>
  <iframe src="get_all_products.php" width="100%" height="200px">Загрузка....</iframe>
 <a href="index.html">Главная</a>
</body>
</html>
