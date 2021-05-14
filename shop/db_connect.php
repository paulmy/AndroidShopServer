<?php
//класс для соединения с базой данных
class DB_CONNECT {
    private $con = '';
    // конструктор
    function __construct() {
        // соединяемся с базой
        $this->connect();
    }
    // дескруктор
    function __destruct() {
        // закрываем соединение с базой
        $this->close();
    }
 
    // Функция для соединения с базой данных
    function connect() {
        // импортируем переменные для соединения с базой данных
        require_once __DIR__ . '/db_config.php';
 
        // Соединяемся с сервером mysql
        $this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysqli_error());
        
         // возвращаем результат соединения
        return $this->con;
    }
 
    //Функция для закрытия соединения с базой данных
    function close() {
         mysqli_close($this->con);
    }
	
	function query($query){
        return mysqli_query($this->con, $query);
    }
}
?>
