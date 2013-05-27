<?php
session_start();
require_once '../config.php';
require_once 'session_admin.php';

$get = $_GET;
$st = $db->prepare("SELECT * FROM user WHERE ID=?");
$st->execute(array($get['id']));
$r = $st->fetchObject();

if($get['action'] == 'approve') {
	$q = "UPDATE user SET status=?, usergroup=? WHERE ID=?";
	$st = $db->prepare($q);
	$st->execute(array(
		1, $get['usergroup'], $r->ID
	));
} else if($get['action'] == 'block') {
	$q = "UPDATE user SET status=? WHERE ID=?";
	$st = $db->prepare($q);
	$st->execute(array(
		0, $r->ID
	));
}

header('location:user.php');

?>