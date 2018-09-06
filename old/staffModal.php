<?php
include_once("../assets/scripts.php");

$scheduleID = $_GET['scheduleID'];

$staffModalSQL = "SELECT users.firstName, users.lastName, schedule.location, DATE_FORMAT(schedule.scheduleStartTime, '%H:%i') as scheduleStartTime, DATE_FORMAT(schedule.scheduleStopTime, '%H:%i') as scheduleStopTime, schedule.notes FROM users, schedule WHERE users.userID = schedule.userID AND schedule.scheduleID = $scheduleID";

if(!$staffMembers = $connection->query($staffModalSQL)){
	die('There was an error running the query [' . $connection->error . ']');
}

header("Content-type: text/xml");

$xml = new SimpleXMLElement('<Staff/>');

while($staff = $staffMembers->fetch_assoc()){

	$xml->addChild('header', $staff['firstName'] . ' ' . $staff['lastName'] . " - " . $staff['location'] . ": " . $staff['scheduleStartTime'] . "-" . $staff['scheduleStopTime'] );
	$xml->addChild('content', htmlspecialchars($staff['notes']));

}
echo $xml->asXML();
?>