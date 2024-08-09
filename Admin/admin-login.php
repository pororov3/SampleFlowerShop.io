<?php
// Starting session
session_start();
if ( isset( $_SESSION[ "user" ] ) && isset( $_SESSION[ "pass" ] ) ) {
	header( "location: ..\admin\admin-dashboard.php" );
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../Admin/js/jquery-3.4.1.js"></script>
	<script type="application/javascript" src="../Admin/functions/accountSetting.js"></script>
	<!--<script>require("functions/accountSetting.js")</script>-->
</head>
<style type="text/css">
	body {
		background-color: pink;
		font-family: calibri;
		font-size: 13px;
		color: grey;
	}
	
	form {
		height: auto;
		padding: 20px;
		margin-top: 10%;
		margin-left: 35%;
		margin-right: 35%;
		text-align: left;
		border-radius: 5%;
		background-color: white;
	}
	
	img {
		width: 100%;
		height: auto;
		margin-bottom: 10px;
	}
	
	input {
		width: 100%;
		font-size: 10px;
		padding-left: 10px;
		padding: 5px;
		border-radius: 5px;
		outline: none;
		border: none;
		background-color: pink;
	}
	
	button {
		width: 30%;
		margin-top: 20px;
		padding: 7px;
		font-size: 11px;
		border-radius: 10px;
		border: none;
		background-color: maroon;
		padding-left: 20px;
		color: white;
		padding-right: 20px;
		outline: none;
	}
	
	button:hover {
		background-color: maroon;
		color: white;
		font-weight: bold;
		cursor: pointer;
		-webkit-box-shadow: 11px 20px 120px -2px rgba(0, 0, 0, 0.52);
		-moz-box-shadow: 11px 20px 120px -2px rgba(0, 0, 0, 0.52);
		box-shadow: 11px 20px 120px -2px rgba(0, 0, 0, 0.52);
	}
	
	.row {
		margin: 5px;
	}
	
	.ps {
		margin-top: 6px;
		margin-right: 25px;
		float: right;
	}
	
	.b {
		text-align: center;
	}
	
	label {
		font-family: bank gothic;
	}
	
	#errormsg {
		color: red;
	}
</style>

<body>
	<form>
		<img src="image/logo.png" alt="logo">
		<center>
			<h2 id="message">Admin Login</h2>
			<h5 id="errormsg"></h5>
		</center>
		<div class="row">
			<div class="col-md-3">
				<label>Username:</label>
			</div>
			<div class="col-md-9">
				<input type="text" name="Username" id="lusername">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<label>Password:</label>
			</div>
			<div class="col-md-7">
				<input type="Password" name="Password" id="loginpass">
			</div>
			<div class="col-md-2">
				<input class="ps" type="checkbox" onclick="myFunction()">
			</div>
		</div>
		<div class="b">
			<button type="button" id="loginbtn">LOG IN</button>
		</div>
	</form>
</body>
<script type="text/javascript">
	function myFunction() {
		var x = document.getElementById( "loginpass" );
		if ( x.type === "password" ) {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
</script>
<script type="text/javascript">
	<?php //pending
	if ( !isset($_SESSION[ "logAttemp" ])) {// $_SERVER[ 'HTTP_CACHE_CONTROL' ] != 'max-age=0' 
		$_SESSION[ "logAttemp" ] = 0;
		}
		else {
			if ( $_SESSION[ "logAttemp" ] > 0 ) {
				echo 'document.getElementById( "errormsg" ).innerHTML = "Invalid Credentials"';
			} else {
				echo 'document.getElementById( "errormsg" ).innerHTML = ""';
			}
		}
		?>
</script>
<script type="text/javascript">
	// Button Executions
	$( "#loginbtn" ).click( function () {
		loginbtn();
	} );
</script>
</html>