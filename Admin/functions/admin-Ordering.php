<?php
//Connection
define( 'DB_SERVER', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', 'dbflowershop' );

//$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE );

/*function createCon() {
	// Create connection
	$db = new mysqli( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE );
	// Check connection
	if ( $db->connect_error ) {
		die( "Connection failed: " . $db->connect_error );
	}
}*/

//not in use?

getOrderNo();

function getOrderNo() {
	$db = new mysqli( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE );

	$sql = "select MAX(O_Number) from fsorder";

	$result = $db->query( $sql );

	if ( $result->num_rows > 0 ) {
		while ( $row = $result->fetch_assoc() ) {
			echo "Highest: " . $row[ "O_Number" ];
		}
		echo "<br>";
	} else {
		echo "0 results";
	}
	$db->close();
}

function reqOrder( $adname, $aduserType, $adcontact, $adusername, $adpass, $addate ) {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );
	// username and password sent from form 
	$name = mysqli_real_escape_string( $db, $adname );
	$utype = mysqli_real_escape_string( $db, $aduserType );
	$contact = mysqli_real_escape_string( $db, $adcontact );
	$uname = mysqli_real_escape_string( $db, $adusername );
	$pass = mysqli_real_escape_string( $db, $adpass );
	$date = mysqli_real_escape_string( $db, $addate );

	$sql = "INSERT INTO `fsorder`(`O_Number`, `O_Type`, `O_ReqDate`, `O_CusName`, `O_Item`, `O_Qty`, `O_ItemAmount`, `O_PayMethod`, `O_Ref_Con_AccNo`, `O_TAmount`, `O_Contact`, `O_DOTransaction`, `O_Accepted`, `O_Status`, `O_Address`, `O_DelManStatus`, `O_ReceivedDate`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17])";

	if ( $db->query( $sql ) === TRUE ) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}
}
?>