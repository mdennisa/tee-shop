<?php
require_once 'session.php';
require_once 'config.php';

$post = $_POST;

//insert into purchase_order
$st = $db->prepare("INSERT INTO purchase_order(cart_id, payment_option, name, phone, email, address, total, entry_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
$st->execute(array(
	$_SESSION['cart_id'],
	$post['payment_option'],
	$post['name'],
	$post['phone'],
	$post['email'],
	$post['address'],
	$post['total'],
	date('Y-m-d H:i:s')
));

$insert_id = $db->lastInsertId();
$_SESSION['cart_insert-id'] = $insert_id;

//insert into purchase_item and update product stock
foreach ($_SESSION['cart'] as $cart) {
	$st = $db->prepare("INSERT INTO purchase_item(cart_ID, product_ID, qty) VALUES(?, ?, ?)");
	$st->execute(array(
		$insert_id,
		$cart['ID'],
		$cart['qty']
	));
	$st = $db->prepare("UPDATE product set stock=stock-? WHERE ID=?");
	$st->execute(array(
		$cart['qty'],
		$cart['ID']
	));
}

header('location:'. base_url .'payment_confirm.php');
?>