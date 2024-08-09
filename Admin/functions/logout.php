<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="./../Admin/js/jquery-3.4.1.js"></script>
	<title></title>
</head>

<body>
	<?php
	session_start();
	include "admin-JS-pHp.php";

	if ( !isset( $_SESSION[ 'user' ] ) && !isset( $_SESSION[ 'pass' ] ) ) {
		header( "location: ..\admin-login.php" );
	} else if ( isset( $_SESSION[ 'user' ] ) != "" && isset( $_SESSION[ 'pass' ] ) != "" ) {
		adLogin( $_SESSION[ 'user' ], $_SESSION[ 'pass' ] );
	}

	if ( isset( $_GET[ 'logout' ] ) ) {
		echo( 'function logger(acts) {
		$.ajax({
			url: \'functions/admin-JS-pHp.php\',
			method: "POST",
			data: {
				logger: \'log\',
				logAction: acts
			},
			success: function (data) {
			},
			error: function () {
				swal({
				title: "Program Error!",
				text: "Ajax Call Failed!",
				icon: "error",
				button: "Ok!",
			});
			}
		});
	}' );
		session_destroy();
		unset( $_SESSION[ 'user' ] );
		unset( $_SESSION[ 'pass' ] );
		unset( $_SESSION[ 'chklog' ] );
		unset( $_SESSION[ 'logAttemp' ] );
		unset( $_SESSION[ "type" ] );
		header( "location: ..\admin-login.php" );
	}
	?>
</body>
</html>