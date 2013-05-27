<?php
require_once 'config.php';

$post = $_POST;

$st = $db->prepare("INSERT INTO user(name, pass, email) VALUES(?, ?, ?)");
$st->execute(array(
	$post['name'],
	sha1($post['pass']),
	$post['email']
));

$insert_id = $db->lastInsertId();

header('location:index.php?log=Your account has been registered, wait for approval.');
?>