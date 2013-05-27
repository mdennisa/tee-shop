<?php
session_start();
require_once '../config.php';
require_once 'session_admin.php';

$post = $_POST;
$pic = '';

//print_r($_FILES); // debug only

if (is_uploaded_file($_FILES['img']['tmp_name'])) {
	$pic = $_FILES['img']['name'];
	if(is_file('../images/'. $pic)) {
		$pic = mt_rand(999, 10000) .'_'. $pic;
	}
	move_uploaded_file($_FILES['img']['tmp_name'], '../images/'. $pic);
}

$st = $db->prepare("INSERT INTO product(category, name, price, stock, img, info) VALUES(?, ?, ?, ?, ?, ?)");
$st->execute(array(
	$post['category'],
	$post['name'],
	$post['price'],
	$post['stock'],
	$pic,
	$post['info']
));

$insert_id = $db->lastInsertId();

header('location:product_update.php?id='.$insert_id);

?>