<?php
session_start();

//save log
$content = '$'. $_SESSION['name'] .' | signout , '.date('Y-m-d H:i:s')."\n";
file_put_contents('access.log', $content, FILE_APPEND | FILE_BINARY);
//end log

session_unset();
session_destroy();

//$base = dirname($_SERVER['SCRIPT_NAME']);

header('location:index.php?log=sign-out');
?>