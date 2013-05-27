<?php
session_start();
if(empty($_SESSION['cart_id'])) {
	$cart_id = session_id();
	$_SESSION['cart_id'] = $cart_id;
	setcookie('cart_id', $cart_id, time()+3600);
}

if ($_SERVER['SCRIPT_NAME'] != '/tee-shop/index.php') {
	if(empty($_SESSION['logged_in'])) {
		echo 'You must login to access our product!';
		exit;
	}
}
?>