<?php

include_once("assets/scripts.php");

if(isset($_GET['date'])){
	$date = $_GET['date'];
	$dateFormated = DateTime::createFromFormat('Y-m-d', $date);
}
else{
	$date = date('Y-m-d');
	$dayOfTheWeek = date('l');
	$dateFormated = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
}
$yesterday = $dateFormated->modify('-1 day')->format("Y-m-d");
$tomorrow = $dateFormated->modify('+1 day')->format("Y-m-d");

$times[] = array();

$getHoursSettingsSQL = "SELECT settingKey, settingValue FROM userSettings WHERE userID = 'COV'";
$getHoursSettings = $connection->prepare($getHoursSettingsSQL);
$getHoursSettings->execute();
$getHoursSettings->bind_result($settingKey, $settingValue);
while($getHoursSettings->fetch()){
	$settings[$settingKey] = $settingValue;
}
$getHoursSettings->close();

$closeTime = DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' ' . $settings[strtolower($dayOfTheWeek) . "-close"] . 'EST');
$loopTime = DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' ' . $settings[strtolower($dayOfTheWeek) . "-open"] . 'EST');


$times[0] = array('startTime' => $loopTime->format('Y-m-d H:i:s e'), 'stopTime' => date_add($loopTime, date_interval_create_from_date_string('1 hour') )->format('Y-m-d H:i:s e'));

$i = 1;
while($loopTime < $closeTime){
	$times[$i] = array('startTime' => $loopTime->format('Y-m-d H:i:s e'), 'stopTime' => date_add($loopTime, date_interval_create_from_date_string('1 hour') )->format('Y-m-d H:i:s e'));
	$i++;
}

$locations = array("scheduleManagementCirculationDesk"=>"Cirulation Desk", 
									 "scheduleManagementCirculationBackRoom"=>"Circulation BackRoom", 
									 "scheduleManagementCirculationOther"=>"Circulation Other", 
									 "scheduleManagementAdultServicesDesk"=>"AdultServices Desk", 
									 "scheduleManagementAdultServicesMakerspace"=>"AdultServices Makerspace", 
									 "scheduleManagementAdultServicesProgram"=>"Adult Services Program", 
									 "scheduleManagementChildrensDesk"=>"Childrens Desk",
									 "scheduleManagementChildrensPrograms"=>"Childrens Programs");

foreach($locations as $setting=>$title){
	if(checkSettingValue($setting) == 'false'){
		unset($locations[$setting]);
	}
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Schedule Management</title>
<link rel="stylesheet" href="assets/main.css">
</head>

<body>
		<?php 
	$active = 'scheduleManagement';
	include("assets/navigation.php"); 
	?>
	<table id="schedule" border="solid">
		<tr>
			<td></td>
			<?php
			foreach($locations as $location){
				echo "<td>" . $location . "</td>";
			}
			?>
		</tr>
		<?php
		
		foreach($times as $time){
			$startTime = DateTime::createFromFormat('Y-m-d H:i:s e', $time['startTime'])->format('g:i a');
			$startTimeLong = DateTime::createFromFormat('Y-m-d H:i:s e', $time['startTime'])->format('Y-m-d H:i:s');
			$stopTime = DateTime::createFromFormat('Y-m-d H:i:s e', $time['stopTime'])->format('g:i a');
			$stopTimeLong = DateTime::createFromFormat('Y-m-d H:i:s e', $time['stopTime'])->format('Y-m-d H:i:s');
			echo "<tr>";
				echo "<td>" . $startTime . "-" . $stopTime . "</td>";
				foreach($locations as $location){
					echo "<td startTime=\"" . $startTimeLong . "\" stopTime=\"" . $stopTimeLong . "\" desk=\"" . $location . "\">" . "</td>";
				}	
			echo "</tr>";
		}
		?>
	</table>
</body>
</html>