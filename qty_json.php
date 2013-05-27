<?php
require_once 'session.php';
require_once 'config.php';

$get = $_GET;
$id = $get['id'];
$qty = $get['qty'];



//check if qty > stock
$st = $db->prepare("SELECT name, stock FROM product WHERE ID=?");
$st->execute(array($id));
$r = $st->fetchObject();

if ($qty > $r->stock) {
	$qty = 1;
	$log = "Your demand exceed our available stock, our current stock for ". $r->name ." : ". $r->stock;
} else {
	$log = $r->name ." qty updated, total updated.";
}

//set up current item qty
$_SESSION['cart'][$id]['qty'] = $qty;

//reset subtotal and items
$_SESSION['subtotal'] = 0;
$_SESSION['items'] = 0;

//recalculate subtotal and items
foreach($_SESSION['cart'] as $cart) {
	$_SESSION['subtotal'] = $_SESSION['subtotal'] + $cart['price'] * $cart['qty'];
	$_SESSION['items'] = $_SESSION['items'] + $cart['qty'];
}

//passing to array
$data = array(
	'qty' => $qty,
	'price' => $_SESSION['cart'][$id]['price'],
	'subtotal' => $_SESSION['subtotal'],
	'items' => $_SESSION['items'], 
	'log' => $log
);
echo json_encode($data);
?>