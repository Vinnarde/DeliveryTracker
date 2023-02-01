<?php

require_once 'dbConn.php';
$pdo = pdo();

function authenticateUser(PDO $pdo, string $login, string $password): bool
{
	$sql = "SELECT password FROM users WHERE login = :login";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':login', $login);
	$stmt->execute();

	$hash = $stmt->fetchColumn();

	return password_verify($password, $hash);
}

if (!empty($_POST)) {
	if (isset($_POST['inputLogin']) && !empty(trim($_POST['inputLogin']))) {
		$login = htmlspecialchars($_POST['inputLogin']);
		$password = htmlspecialchars($_POST['inputPassword']);

		if (authenticateUser($pdo, $login, $password)) {
			$_SESSION['user_id'] = $login;
			header('Location: index.php');
		} else {
			header('Location: login.php');
		}
		die;
	}
} else {
	header('Location: login.php');
	die;
}
