<?php
require_once 'session.php';
require_once 'config.php';

$get = $_GET;
$id = $get['id'];

$qty = $_SESSION['cart'][$id]['qty'];
$price = $_SESSION['cart'][$id]['price'];
$total = $qty * $price;

$_SESSION['subtotal'] = $_SESSION['subtotal'] - $total;
$_SESSION['items'] = $_SESSION['items'] - $qty;

unset($_SESSION['cart'][$id]);
//print_r($_SESSION['cart']);
header('location:'.base_url.'cart.php');
?>