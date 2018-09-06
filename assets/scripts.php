<?php
////////////////////////////////////////////////////////////////
//                                                            //
//  This file contains php scripts needed for the rest of the //
// homebound database website.                                //
//                                                            //
////////////////////////////////////////////////////////////////

//MySQL Connection Settings **********************************
$servername = 'localhost';
$username = 'schedule';
$password = 'drp80OAysvztG4Hh';
$db = 'schedule';

$connection = new mysqli($servername, $username, $password, $db);


//Logs user into system with LDAP
function authenticationSet($Username, $UserPassword){
	
	$ADServer = "ldap://10.1.0.11";
	$ldap = ldap_connect($ADServer);
	$ldapUser = $Username . "@kenton.lib.ky.us";
	
	if( $bind = ldap_bind($ldap, $ldapUser, $UserPassword) ){
		$filter = "sAMAccountName=$Username";
		$result = ldap_search($ldap, "OU=Staff users,dc=kenton,dc=lib,dc=ky,dc=us",$filter);
		$data = ldap_get_entries($ldap, $result);
		$objectGUID = bin2hex($data[0]["objectguid"][0]);
		
		if(!isset($_SESSION)){ session_start(); }
		$_SESSION['GUID'] = $objectGUID;
		return true;
	}
	else{
		return false;
	}
	
	ldap_close($ldap);
	
}

//Ends User Session
function authenticationEnd(){
	if(!isset($_SESSION)){ session_start(); }
	session_destroy();
}

//////////////////////////////
//													//
//Default Registry Settings //
//													//
//////////////////////////////



function checkSettingValue($setting){
	$servername = 'localhost';
	$username = 'schedule';
	$password = 'drp80OAysvztG4Hh';
	$db = 'schedule';
	$connection = new mysqli($servername, $username, $password, $db);
	
	//Schedule Management Defaults
	$scheduleManagementCirculationDesk = 'true';
	$scheduleManagementCirculationBackRoom = 'true';
	$scheduleManagementCirculationOther = 'true';

	$scheduleManagementAdultServicesDesk = 'true';
	$scheduleManagementAdultServicesProgram = 'true';
	$scheduleManagementAdultServicesMakerspace = 'true';

	$scheduleManagementChildrensDesk = 'true';
	$scheduleManagementChildrensPrograms = 'true';
	
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
		$settingsCheck->fetch();
		return $settingValue;
	}
	else{
		return $$setting;
	}
}
?>