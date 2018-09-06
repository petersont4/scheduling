<?php
include_once("assets/scripts.php");

//Code to add a new scheduling assignment
if(isset($_GET['addAssignment'])){
	$userID = $_GET['userID'];
	$startTime = $_GET['startTime'];
	$stopTime = $_GET['stopTime'];
	$desk = $_GET['desk'];
	
	$otherAreaCheckSQL = "SELECT COUNT(*) FROM schedule WHERE userID = ? AND scheduleStartTime = ? AND scheduleStopTime = ?";
	$otherAreaCheckInsert = $connection->prepare($otherAreaCheckSQL);
	$otherAreaCheckInsert->bind_param("sss", $userID, $startTime, $stopTime);
	$otherAreaCheckInsert->execute();
	$otherAreaCheckInsert->bind_result($count);
	$otherAreaCheckInsert->fetch();	
	$otherAreaCheckInsert->close();
	if($count > 0){
		echo "False";
	}
	else{
		$scheduleSQL = "INSERT INTO schedule (userID, scheduleStartTime, scheduleStopTime, location) VALUES (?, ?, ?, ?)";
		$scheduleInsert = $connection->prepare($scheduleSQL);
		$scheduleInsert->bind_param("ssss", $userID, $startTime, $stopTime, $desk);
		$scheduleInsert->execute();
		echo $connection->insert_id;
		$scheduleInsert->close();
	}
	

	
	
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
else if(isset($_GET['saveHours'])){
	unset($_GET['saveHours']);
	foreach($_GET as $key=>$value){
		$updateHoursSQL = "UPDATE userSettings SET settingValue = ? WHERE userID = 'COV' AND settingKey = ?";
		$updateHoursInsert = $connection->prepare($updateHoursSQL);
		$updateHoursInsert->bind_param("ss", $value, $key);
		$updateHoursInsert->execute();
		$updateHoursInsert->close();
	}
}
else if(isset($_GET['settings'])){
	$setting = $_GET['setting'];
	$value = $_GET['value'];
	
	if(!isset($_SESSION)){ session_start(); }
	$userID = $_SESSION['GUID'];
	
	$settingCheckSQL = "SELECT settingValue FROM userSettings WHERE userID = ? AND settingKey = ?";
	$settingsCheck = $connection->prepare($settingCheckSQL);
	$settingsCheck->bind_param('ss', $userID, $setting);
	$settingsCheck->execute();
	$settingsCheck->store_result();
	$settingsCheck->bind_result($settingValue);
	$settingsCheck->fetch();
	if($settingsCheck->num_rows() == 1){
		$updateSQL = "UPDATE userSettings SET settingValue = ? WHERE userID = ? AND settingKey = ?";
		$updateSetting = $connection->prepare($updateSQL);
		$updateSetting->bind_param('sss', $value, $userID, $setting);
		$updateSetting->execute();
	}
	else{
		$insertSQL = "INSERT INTO userSettings (userID, settingKey, settingValue) VALUES (?, ?, ?)";
		$insertSetting = $connection->prepare($insertSQL);
		$insertSetting->bind_param('sss', $userID, $setting, $value);
		$insertSetting->execute();
	}
}
?>