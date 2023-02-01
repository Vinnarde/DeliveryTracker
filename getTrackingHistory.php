<?php

require_once 'dbConn.php';
$pdo = pdo();
require_once 'authChecker.php';
function selectTrackHistory(PDO $pdo, string $trackNumber): array
{
	$sql = "SELECT * FROM trackingHistory WHERE trackNumber = :trackNumber";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':trackNumber', $trackNumber);
	$stmt->execute();

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function selectTrackAddress(PDO $pdo, string $trackNumber): array
{
	$sql = "SELECT * FROM address WHERE addressId = (SELECT addressId FROM trackInfo WHERE trackNumber = :trackNumber)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':trackNumber', $trackNumber);
	$stmt->execute();

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!empty($_POST)) {
	if (isset($_POST['trackNumber']) && !empty(trim($_POST['trackNumber']))) {
		$trackNumber = $_POST['trackNumber'];
		$trackHistory = selectTrackHistory($pdo, $trackNumber);

		$trackAddress = selectTrackAddress($pdo, $trackNumber);
		$trackInfo = array_merge($trackAddress, $trackHistory);

//		echo json_encode($trackHistory);
//		echo json_encode($trackAddress);
		echo json_encode($trackInfo);
	}
}