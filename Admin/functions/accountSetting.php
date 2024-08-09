<?php
//Connection
define( 'DB_SERVER', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', 'dbflowershop' );

//$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE );

//Chk Connection
/*if ( mysqli_connect_errno() ) {
	printf( "Connect failed: %s\n", mysqli_connect_error() );
	exit();
}*/

//pending add date formater

//get action
$action = $_POST[ 'action' ];

if ( $action === "loginchk" ) {

	session_start();

	$adusername = $_SESSION[ 'user' ];
	$adpass = $_SESSION[ 'pass' ];

	$response = adlogin( $adusername, $adpass );

} else if ( $action === "add" ) {

	$adname = $_POST[ 'name' ];
	$adpos = $_POST[ 'position' ];
	$aduserType = $_POST[ 'userType' ];
	$adcontact = $_POST[ 'contact' ];
	$adusername = $_POST[ 'username' ];
	$adpass = $_POST[ 'password' ];
	$addate = date( "Y-m-d" );

	$response = addUser( $adname, $adpos, $aduserType, $adcontact, $adusername, $adpass, $addate );

} else if ( $action === "update" ) {

	session_start(); //to get session values

	$adname = $_POST[ 'name' ];
	$adcontact = $_POST[ 'contact' ];
	$adusername = $_POST[ 'username' ];
	$adpass = $_POST[ 'password' ];
	$currname = $_SESSION[ 'name' ];

	$response = update( $adname, $adcontact, $adusername, $adpass, $currname );

} else if ( $action === "loadtable" ) {

	$query = $_POST[ 'query' ];
	$response = loadinfo( $query );

} else if ( $action === "loadlog" ) {

	$response = loadlog();

} else if ( $action === "srclog" ) {

	$query = $_POST[ 'query' ];
	$response = searchlog( $query );

} else if ( $action === "userActive" ) {

	$status = $_POST[ 'status' ];
	$id = $_POST[ 'id' ];
	$response = userActive( $status, $id );
} else if ( $action === "addDelMan" ) {

	$response = addDelMan();
}

function addUser( $adname, $adpos, $aduserType, $adcontact, $adusername, $adpass, $addate ) {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );
	// username and password sent from form 
	$name = mysqli_real_escape_string( $db, $adname );
	$pos = mysqli_real_escape_string( $db, $adpos );
	$utype = mysqli_real_escape_string( $db, $aduserType );
	$contact = mysqli_real_escape_string( $db, $adcontact );
	$uname = mysqli_real_escape_string( $db, $adusername );
	$pass = mysqli_real_escape_string( $db, $adpass );
	$date = mysqli_real_escape_string( $db, $addate );

	$sql = "INSERT INTO `dbflowershop`.`fslogin` (`L_ID`, `L_Name`, `L_Username`, `L_Password`, `L_UserType`, `L_UserSince`, `L_AccountStatus`, `L_Contact`, `L_Position`) VALUES (NULL, '$name', '$uname', '$pass', '$utype', '$date', 'Active', '$contact', '$pos');";
	
	if ( $db->query( $sql ) === TRUE ) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}
	
	if ($pos == 'Delivery Man'){
		addDelMan();
	}
}

function update( $adname, $adcontact, $adusername, $adpass, $currname ) {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$name = mysqli_real_escape_string( $db, $adname );
	$contact = mysqli_real_escape_string( $db, $adcontact );
	$uname = mysqli_real_escape_string( $db, $adusername );
	$pass = mysqli_real_escape_string( $db, $adpass );

	$sql = "UPDATE `fslogin` SET `L_Name`='$name',`L_Contact`='$contact',`L_Username`='$uname',`L_Password`='$pass' WHERE `fslogin`.`L_Name` = '$currname'";

	if ( mysqli_query( $db, $sql ) ) {
		echo "Record updated successfully";
		$_SESSION[ 'name' ] = $name;
		$_SESSION[ 'user' ] = $uname;
		$_SESSION[ 'pass' ] = $pass;
	} else {
		echo "Error updating record: " . mysqli_error( $db );
	}
}

function adlogin( $adusername, $adpass ) {
	$result_array = array();

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$myusername = mysqli_real_escape_string( $db, $adusername );
	$mypassword = mysqli_real_escape_string( $db, $adpass );

	$sql = "SELECT * FROM fslogin WHERE L_Username = '$myusername' and L_Password = '$mypassword'";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
	$row = mysqli_fetch_array( $result, MYSQLI_ASSOC );

	return ( $row );
}

function loadinfo( $sql ) {

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {

		while ( $row = mysqli_fetch_array( $result ) ) {
			$condition = '';
			if ( $row[ "L_AccountStatus" ] != 'Active' ) {
				$condition = '';
				$style1 = 'display: none;';
				$style2 = '';
			} else {
				$condition = 'checked';
				$style1 = '';
				$style2 = 'display: none;';
			}
			$resInfo .= '<tr id="1">
							<td>' . $row[ "L_ID" ] . '</td>
							<td>' . $row[ "L_Name" ] . '</td>
							<td>' . $row[ "L_Username" ] . '</td>
							<td>' . $row[ "L_UserType" ] . '</td>
							<td>' . $row[ "L_Contact" ] . '</td>
							<td>' . $row[ "L_UserSince" ] . '</td>
							<td><label id="active_' . $row[ "L_ID" ] . '" style="' . $style1 . 'color: green">Active</label><label id="inactive_' . $row[ "L_ID" ] . '" style="' . $style2 . 'color: red">Inactive</label>
										</td>
										<td>
											<label class="switch">
												  <input type="checkbox" ' . $condition . ' id="activate_' . $row[ "L_ID" ] . '" onclick="urowClick(this.id)">
												  <span class="slider round"></span>
											</label>
										</td>
						 </tr>';
		}

	} else {
		$resInfo = '<td colspan="8">Empty Database</td>';
	}

	return $resInfo;

}

function loadlog() {

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT * FROM fsuserlogs";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {

		while ( $row = mysqli_fetch_array( $result ) ) {
			$resInfo .= '<tr>
							<td>' . $row[ 'UL_Date' ] . '</td>
							<td>' . $row[ 'UL_Time' ] . '</td>
							<td>' . $row[ 'UL_Action' ] . '</td>
							<td>' . $row[ 'UL_Position' ] . '</td>
							<td>' . $row[ 'UL_Name' ] . '</td>
						</tr>';
		}

	} else {
		$resInfo = '<td colspan="5">Empty Database</td>';
	}
	return $resInfo;
}

function searchlog( $sql ) {

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {

		while ( $row = mysqli_fetch_array( $result ) ) {
			$resInfo .= '<tr>
							<td>' . $row[ 'UL_Date' ] . '</td>
							<td>' . $row[ 'UL_Time' ] . '</td>
							<td>' . $row[ 'UL_Action' ] . '</td>
							<td>' . $row[ 'UL_Position' ] . '</td>
							<td>' . $row[ 'UL_Name' ] . '</td>
						</tr>';
		}

	} else {
		$resInfo = '<td colspan="5">Empty Database</td>';
	}
	return $resInfo;
}

function userActive( $status, $id ) {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$stat = mysqli_real_escape_string( $db, $status );

	$sql = "UPDATE `fslogin` SET `L_AccountStatus`='$stat' WHERE L_ID=" . $id;

	if ( mysqli_query( $db, $sql ) ) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error( $db );
	}
}

function addDelMan(){
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );
	$db1 = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, 'SELECT MAX(L_ID) FROM fslogin' )or die( mysqli_error( $db ) );
	$row = mysqli_fetch_array( $result );
	
	$sql = 'INSERT INTO `fs_rd_delmanstatus`(`RD_ID`) VALUES ('.$row[0].')';
	
	if ( $db1->query( $sql ) === TRUE ) {
		echo " New Delivery Man recorded successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $db1->error;
	}
}

if ( $response != null && $action != 'loadtable' && $action != 'loadlog' && $action != "srclog" ) {
	echo json_encode( $response );
} else {
	echo $response;
}

?>