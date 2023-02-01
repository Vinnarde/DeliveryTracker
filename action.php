<?php

require 'vendor/autoload.php';

require_once 'dbConn.php';
$pdo = pdo();
function debug(mixed $value, string $message = ""): void
{
	echo $message;
	echo '<pre>';
	print_r($value);
	echo '</pre>' . PHP_EOL . PHP_EOL;
}

function printEssentialInfo(string $trackNumber, string $latestStatus, mixed $latestAddress): void
{
	print_r("<p>" . "Track number: {$trackNumber}" . "</p>");
	print_r("<p>" . "Latest status: {$latestStatus}" . "</p>");
	print_r("<p>" . "Latest address:" . "</p>");
	debug($latestAddress);
}

if (!empty($_POST)) {
	if (isset($_POST['deliveryJSON']) && !empty(trim($_POST['deliveryJSON']))) {
		try {
			echo $_POST['deliveryJSON'];

			$jsonSchema = (object)['$ref' => 'file://' . realpath('schema.json')];
			$validator = new JsonSchema\Validator();

			$json = json_decode($_POST['deliveryJSON']);
			$validator->validate(
				$json,
				$jsonSchema
			);

			if (!$validator->isValid()) {
				throw new Exception('JSON does not match schema!');
			}

			$json = json_decode($_POST['deliveryJSON'], true);


			if (json_last_error() !== JSON_ERROR_NONE) {
				throw new Exception('JSON decode error: ' . json_last_error_msg());
			}

			$trackNumber = $json['data']['number'] ?? "";
			$trackInfo = $json['data']['track_info'] ?? "";
			$latestStatus = $trackInfo['latest_status']['status'] ?? "";
			$latestAddress = $trackInfo['latest_event']['address'] ?? "";

			insertDeliveryInfo($pdo, $json);

			$_SESSION['toastMessage'] = "Track info was successfully added!";
			$_SESSION['toastType'] = 'success';

			header('Location: index.php');
			die;

		} catch (Exception $e) {
			$_SESSION['toastMessage'] = "An error occurred while adding track info!";
			$_SESSION['toastType'] = 'error';

			header('Location: index.php');
			die;
		}

	}
}

function isExistTrackingInfo(PDO $pdo, string $trackNumber): bool
{
	$sql = "SELECT * FROM trackInfo WHERE trackNumber = :trackNumber";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':trackNumber', $trackNumber);
	$stmt->execute();

	return $stmt->rowCount() > 0;
}

function updateTrackStatus($pdo, $trackNumber, $latestStatus): void
{
	$sql = "UPDATE trackInfo SET status = :status WHERE trackNumber = :trackNumber";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':status', $latestStatus);
	$stmt->bindParam(':trackNumber', $trackNumber);
	$stmt->execute();
}

function insertTrackHistory(PDO $pdo, array $trackInfo): int
{
	$trackNumber = $trackInfo['number'];
	$latestStatus = $trackInfo['lastStatus'];
	$latestEventDate = $trackInfo['latestEventDate'];
	$description = $trackInfo['description'];

	$sql = "INSERT INTO trackingHistory (trackNumber, status, description, dateUpdated) VALUES (:trackNumber, :status, :description, :dateUpdated)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':trackNumber', $trackNumber);
	$stmt->bindParam(':status', $latestStatus);
	$stmt->bindParam(':description', $description);
	$stmt->bindParam(':dateUpdated', $latestEventDate);
	$stmt->execute();

	return $pdo->lastInsertId();
}

function insertTrackInfo(PDO $pdo, array $trackInfo): void
{
	$trackNumber = $trackInfo['number'];
	$latestStatus = $trackInfo['lastStatus'];
	$latestEventDate = $trackInfo['latestEventDate'];
	$addressId = $trackInfo['addressId'];

	$sql = "INSERT INTO trackInfo (trackNumber, dateRegistered, status, addressID) VALUES (:trackNumber, :dateRegistered, :lastStatus, :addressId)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':trackNumber', $trackNumber);
	$stmt->bindParam(':dateRegistered', $latestEventDate);
	$stmt->bindParam(':lastStatus', $latestStatus);
	$stmt->bindParam(':addressId', $addressId);
	$stmt->execute();


}

function insertAddress(PDO $pdo, array $address): int
{
	$country = $address['country'];
	$state = $address['state'];
	$city = $address['city'];
	$street = $address['street'];
	$postalCode = $address['postal_code'];

	$sql = "INSERT INTO address (country, state, city, street, postalCode) VALUES (:country, :state, :city, :street, :postal_code)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':country', $country);
	$stmt->bindParam(':state', $state);
	$stmt->bindParam(':city', $city);
	$stmt->bindParam(':street', $street);
	$stmt->bindParam(':postal_code', $postalCode);
	$stmt->execute();

	return $pdo->lastInsertId();
}


function insertDeliveryInfo(PDO $pdo, array $json): void
{
	$latestEvent = $json['data']['track_info']['latest_event'];
	$trackNumber = $json['data']['number'];

	if (!empty($latestEvent) && !isExistTrackingInfo($pdo, $trackNumber)) {
		$address = [
			"country" => $latestEvent['address']['country'] ?? "",
			"state" => $latestEvent['address']['state'] ?? "",
			"city" => $latestEvent['address']['city'] ?? "",
			"street" => $latestEvent['address']['street'] ?? "",
			"postal_code" => $latestEvent['address']['postal_code'] ?? ""
		];

		$addressId = insertAddress($pdo, $address);

		$trackInfo = [
			"number" => $trackNumber,
			"latestEventDate" => $latestEvent['time_iso'],
			"lastStatus" => $json['data']['track_info']['latest_status']['status'],
			"description" => $json['data']['track_info']['latest_event']['description'] ?? "",
			"addressId" => $addressId
		];

//		print_r($trackInfo);

		insertTrackInfo($pdo, $trackInfo);
		insertTrackHistory($pdo, $trackInfo);
	} else if (isExistTrackingInfo($pdo, $trackNumber)) {
		$trackInfo = [
			"number" => $trackNumber,
			"latestEventDate" => $latestEvent['time_iso'],
			"lastStatus" => $json['data']['track_info']['latest_status']['status'],
			"description" => $json['data']['track_info']['latest_event']['description'] ?? ""
		];

		insertTrackHistory($pdo, $trackInfo);
		updateTrackStatus($pdo, $trackNumber, $trackInfo['lastStatus']);
	}
}



