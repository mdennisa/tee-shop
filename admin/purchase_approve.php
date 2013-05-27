<?php
session_start();
require_once '../config.php';
require_once 'session_admin.php';

$get = $_GET;
$q = "UPDATE purchase_order SET status=? WHERE ID=?";
$st = $db->prepare($q);
$st->execute(array(
	1, $get['id']
));

header('location:purchase_details.php?id='.$get['id']);

?>