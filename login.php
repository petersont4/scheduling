<?php

if(isset($_POST['username'])){
	
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>KCPL Scheduling Login</title>
<link rel="stylesheet" href="assets/main.css">
<style>
	body{
		margin: 0;
		background: url('/assets/desktop.jpeg') no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-color: rgba(161,130,113,1.00);
	}
	
	.loginBox{
		background: white;
		margin-left: auto;
		margin-right: auto;
		margin-top: 20vh;
		height: 60vh;
		width: 40vh;
		text-align: center;
		box-shadow: 20px 20px 20px black;
		padding: 10px;
	}
	
	.loginInput{
		outline: none;
		border: 0;
		border-bottom: 2px solid #00B0DB;
		width: 80%;
		margin-bottom: 60px;
		font-size: 24pt;
	}
	
	.loginInput:focus{
		border-bottom: 4px solid #005E84;
	}
	
	#submit{
		height: 50px;
		background-color: #00B0DB;
		width: 80%;
		border-style: none;
		border-radius: 10px;
		box-shadow: 0;
		font-size: 24pt;
		color: #005E84;
	}
	#submit:active{
		background-color: #005E84;
		color: #00B0DB;
	}
	
	</style>
</head>

<body>
	<div class="loginBox">
		<form action="" method="post">
			<h2 style="padding-bottom: 60px;">KCPL Scheduling Login</h2>
			<br>
			<input class="loginInput" type="text" name="username" id="username" placeholder="Username"><br>
			<input class="loginInput" type="password" name="password" id="password" placeholder="Password"><br>
			<input type="submit" name="submit" id="submit" value="Login"><br>
			<br><br><br>
			<img src="/assets/logo.jpg" width="90%">
		</form>
	</div>
</body>
</html>