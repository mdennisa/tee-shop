<?php
session_start();
require_once '../config.php';
require_once 'session_admin.php';

$post = $_POST;

$st = $db->prepare("UPDATE product SET category=?, name=?, price=?, stock=?, info=? WHERE ID=?");
$st->execute(array(
	$post['category'],
	$post['name'],
	$post['price'],
	$post['stock'],
	$post['info'],
	$post['id']
));

header('location:product_update.php?id='.$post['id'].'&log=updated');