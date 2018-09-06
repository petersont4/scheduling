<?php

include_once("assets/scripts.php");

session_start();
if(!isset($_SESSION['GUID'])){
	header("Location: /login.php");
	die();
}



?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Schedule</title>
<link rel="stylesheet" href="assets/main.css">
</head>

<body>
	<?php 
	$active = 'home';
	include("assets/navigation.php"); 
	?>
	<h1>This is the home page</h1>
</body>
</html>