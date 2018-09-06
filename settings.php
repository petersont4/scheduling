<?php

include_once("assets/scripts.php");

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>User Settings</title>
<link rel="stylesheet" href="assets/main.css">
<style>
	
	body{
		display: flex;
	}

	#leftColumn{
		flex: 15%;
		height: 100vh;
		background-color: #00B0DB;
	}
	
	#mainDiv{
		flex: 85%;
		height: 100vh;
		border: solid;
		border-color: #00B0DB;
	}
	
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
	
	#ajaxWindow{
		padding: 15px;
	}
</style>
	
</style>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/jquery-clock-timepicker.js"></script>-->
	<script>
		function loadPage(pageName){
			var page = new XMLHttpRequest();
			page.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					document.getElementById('ajaxWindow').innerHTML = this.responseText;
				}
			};
			page.open("GET", "settingsAJAX.php?" + pageName);
			page.send();
		}
		
		function saveHours(day, type, value){
			var updatePage = new XMLHttpRequest();
			updatePage.open("GET", "update.php?saveHours&" + day + "-" + type +"=" + value);
			updatePage.send();
		}
		
		function saveSetting(setting, value){
			var updatePage = new XMLHttpRequest();
			updatePage.open("GET", "update.php?settings&setting=" + setting + "&value=" + value);
			updatePage.send();
		}
		
		function checkboxSetting(setting, element){
			if(element.checked){
				saveSetting(setting, 'true');
			}
			else{
				saveSetting(setting, 'false');
			}
		}
	</script>
</head>

<body>
	<?php 
	$active = 'settings';
	include("assets/navigation.php"); 
	?>
	<div id="leftColumn">
		<ul>
			<li><a onclick="loadPage('scheduleManagement')" href="#">Schedule Management</a></li>
			<li><a onclick="loadPage('hours')" href="#">Hours</a></li>
		</ul>
	</div>
	<div id="mainDiv">
		<h1>Settings</h1>
		<div id="ajaxWindow">
		</div>
	</div>
</body>
</html>