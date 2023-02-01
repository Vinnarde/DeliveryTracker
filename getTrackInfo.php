<?php


require_once 'dbConn.php';
$pdo = pdo();
require_once 'authChecker.php';
function selectTracksInfo(PDO $pdo): array
{
	$sql = "SELECT tI.trackNumber, tI.status, tI.dateRegistered, tH.dateUpdated from trackInfo tI
INNER JOIN trackingHistory  tH on tH.trackNumber = tI.trackNumber
WHERE tH.trackingId = (SELECT max(trackingId) from trackingHistory WHERE trackingHistory.trackNumber = tH.trackNumber)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$result = selectTracksInfo($pdo);
echo json_encode($result);