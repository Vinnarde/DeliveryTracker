<?php

session_start();
function pdo(): PDO
{
	static $pdo;

	if (!$pdo) {
		$username = "root";
		$password = "";
		$host = "localhost";
		$dbname = "DeliveryTracker";

		$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	}

	return $pdo;
}