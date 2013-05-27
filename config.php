<?php
$host = 'localhost'; // Host name
//$port=3306;
$user = 'root'; // Mysql username
$pass = 'root'; // Mysql password
$db_name = 'db_tee-shop'; // Database name

// Database PDO Connection
try{
	$db = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass); // PDO(dbtype:host;port;dbname, user, pass);
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}catch(PDOException $e){
	echo $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}

define('base_url', 'http://localhost/tee-shop/');
define('title', 'Lucky Tee');
date_default_timezone_set('Asia/Jakarta');

// define session to prevent error
if (empty($_SESSION['subtotal']) || $_SESSION['subtotal'] < 0) {
  $_SESSION['subtotal'] = 0;
}
if (empty($_SESSION['items']) || $_SESSION['items'] < 0) {
  $_SESSION['items'] = 0;
}
?>