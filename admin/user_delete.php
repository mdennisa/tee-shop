<?php
session_start();
require_once '../config.php';
require_once 'session_admin.php';

$get = $_GET;
$st = $db->prepare("DELETE FROM user WHERE ID=?");
$st->execute(array($get['id']));

header('location:user.php?log=user-deleted');

?>