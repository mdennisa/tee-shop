<?php
require_once 'session.php';
require_once 'config.php';

$get = $_GET;
$id = $get['id'];

	$st = $db->prepare("SELECT * FROM product WHERE ID=?");
	$st->execute(array($get['id']));
	$r = $st->fetchObject();

if( empty($_SESSION['cart']) ) {
	$cart = array(
		'ID' => $r->ID,
		'name' => $r->name,
		'img' => $r->img,
		'price' => $r->price,
		'qty' => 1,
		'size' => 'all-size'
	);
	$_SESSION['cart'][$id] = $cart;
} else {
	if( array_key_exists($id ,$_SESSION['cart']) ) {
		$_SESSION['cart'][$id]['qty'] = $_SESSION['cart'][$id]['qty'] + 1;
	} else {
		$cart = array(
			'ID' => $r->ID,
			'name' => $r->name,
			'img' => $r->img,
			'price' => $r->price,
			'qty' => 1,
			'size' => 'all-size'
		);
		$_SESSION['cart'][$id] = $cart;
	}
}

	$_SESSION['subtotal'] = $_SESSION['subtotal'] + $r->price;
	$_SESSION['items'] = $_SESSION['items'] + 1;
	
//print_r($_SESSION['cart']);
header('location:'.base_url.'cart.php');
?>