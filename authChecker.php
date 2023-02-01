<?php

require_once 'dbConn.php';
$pdo = pdo();

if (!isset($_SESSION['user_id'])) {
	header('Location: login.php');
	exit;
}

?>

