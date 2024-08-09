<?php
//Connection
define( 'DB_SERVER', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', 'dbflowershop' );

/*$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE );

//Chk Connection
if ( mysqli_connect_errno() ) {
	printf( "Connect failed: %s\n", mysqli_connect_error() );
	exit();
}*/

if ( isset( $_POST[ 'chklogin' ] ) == true ) {
	if ( $_POST[ 'chklogin' ] === 'login' ) {
		session_start();
		adLogin( $_SESSION[ "user" ], $_SESSION[ "pass" ] );
	}
}

if ( isset( $_POST[ 'logger' ] ) == true ) {
	if ( $_POST[ 'logger' ] === 'log' ) {
		session_start();
		addLog( $_SESSION[ "id" ], $_POST[ 'logAction' ], $_SESSION[ "name" ], $_SESSION[ "pos" ], $_SESSION[ "type" ] );
	}
}

if ( isset( $_POST[ 'login' ] ) == true ) {
	if ( $_POST[ 'login' ] === 'login' ) {
		adLogin( $_POST[ "luser" ], $_POST[ "lpass" ] );
	}
}

if ( isset( $_POST[ 'getuser' ] ) == true ) {
	if ( $_POST[ 'getuser' ] === 'getuser' ) {
		session_start();
		echo $_SESSION['type']."-".$_SESSION['pos']."-".$_SESSION['name'];
	}
}


function adLogin( $uname, $upass ) {

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );
	// username and password sent from form 
	$myusername = mysqli_real_escape_string( $db, $uname );
	$mypassword = mysqli_real_escape_string( $db, $upass );

	$sql = "SELECT * FROM fslogin WHERE L_Username = '$myusername' and L_Password = '$mypassword'";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
	$row = mysqli_fetch_array( $result, MYSQLI_ASSOC );

	$count = mysqli_num_rows( $result );

	// If result matched $myusername and $mypassword, table row must be 1 row

	if ( $count == 1 ) {
		// Starting session
		session_start();
		// Storing session data
		$_SESSION[ "user" ] = $row[ "L_Username" ];
		$_SESSION[ "name" ] = $row[ "L_Name" ];
		$_SESSION[ "pass" ] = $row[ "L_Password" ];
		$_SESSION[ "type" ] = $row[ "L_UserType" ];
		$_SESSION[ "pos" ] = $row[ "L_Position" ];
		$_SESSION[ "id" ] = $row[ "L_ID" ];
		$_SESSION[ "chklog" ] = "ok";
		$_SESSION[ "logAttemp" ] = 0;
		header( "location: ..\admin-dashboard.php" );
		echo 'window.location.href=admin-dashboard.php';
	} else {
		$error = "Your Login Name or Password is invalid";
		//session_destroy();
		$_SESSION[ "logAttemp" ] += 1;
		unset( $_SESSION[ "chklog" ] );
		unset( $_SESSION[ 'user' ] );
		unset( $_SESSION[ 'name' ] );
		unset( $_SESSION[ 'pass' ] );
		unset( $_SESSION[ "type" ] );
		unset( $_SESSION[ "pos" ] );
		unset( $_SESSION[ "id" ] );
		header( "location: ..\admin-login.php" );
		echo 'window.location.href=admin-login.php';
	}
}

function addLog( $id, $aksione, $usern, $pos, $utype ) { // espanyole
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$ids = mysqli_real_escape_string( $db, $id );
	$acts = mysqli_real_escape_string( $db, $aksione );
	$names = mysqli_real_escape_string( $db, $usern );
	$posi = mysqli_real_escape_string( $db, $pos );
	$ut = mysqli_real_escape_string( $db, $utype );
	
	date_default_timezone_set('Asia/Manila');
	/*if ( date( "h" ) > 12 ) { //check for errors
		$hr = date( "h" );
	} else {
		$hr = date( "h" ) + 12; // i use + to set military time
	}
	$time = $hr . date( ":i:s A" );*/
	$time = date( "H:i:s A" );
	$date = date( "Y-m-d" );

	$sql = "INSERT INTO `fsuserlogs`(`UL_ID`, `UL_Name`, `UL_Position`, `UL_Date`, `UL_Time`, `UL_Action`, `UL_UserType`) VALUES ('$ids','$names','$posi','$date','$time','$acts', '$ut');";

	if ( $db->query( $sql ) === TRUE ) {
		echo "Log $ids: $acts";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}
}

?>