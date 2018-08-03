<?php
include_once("assets/scripts.php");

//Code to add a new scheduling assignment
if(isset($_GET['addAssignment'])){
	$userID = $_GET['userID'];
	$startTime = $_GET['startTime'];
	$stopTime = $_GET['stopTime'];
	$desk = $_GET['desk'];
	
	$scheduleSQL = "INSERT INTO schedule (userID, scheduleStartTime, scheduleStopTime, location) VALUES (?, ?, ?, ?)";
	
	$scheduleInsert = $connection->prepare($scheduleSQL);
	
	$scheduleInsert->bind_param("isss", $userID, $startTime, $stopTime, $desk);
	
	$scheduleInsert->execute();
	
	echo $connection->insert_id;
	
	$scheduleInsert->close();
}
else if(isset($_GET['removeAssignment'])){
	$scheduleID = $_GET['scheduleID'];
		
	$unScheduleSQL = "DELETE FROM schedule WHERE scheduleID = ?";
	
	$unScheduleInsert = $connection->prepare($unScheduleSQL);
	
	$unScheduleInsert->bind_param("s", $scheduleID);
	
	print_r($connection->error_list);
	
	$unScheduleInsert->execute();	
}
else if(isset($_GET['notesUpdate'])){
	$scheduleID = $_GET['scheduleID'];
	$notes = $_GET['notes'];
	
	$scheduleSQL = "UPDATE schedule SET notes = ? WHERE scheduleID = ?";
	
	$scheduleInsert = $connection->prepare($scheduleSQL);
	
	$scheduleInsert->bind_param("si", $notes, $scheduleID);
	
	$scheduleInsert->execute();
		
	$scheduleInsert->close();
	
}
?>