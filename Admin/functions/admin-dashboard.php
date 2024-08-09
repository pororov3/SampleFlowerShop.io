<?php
//Connection
define( 'DB_SERVER', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', 'dbflowershop' );

//get action
$action = $_POST[ 'adminDashboard' ];

if ( $action === "monthlyEarnings" ) {

	$response = monEarnings();

} else if ( $action === "delPercentage" ) {

	$response = deliveryPercentage();

} else if ( $action === "pickPercentage" ) {

	$response = pickupPercentage();

} else if ( $action === "newCustomer" ) {

	$response = newCustomer();

} else if ( $action === "todaysReq" ) {

	$response = todaysReq();

} else if ( $action === "approvedReq" ) {

	$response = approvedReq();

} else if ( $action === "itemsOnDelivery" ) {

	$response = itemsOnDelivery();

} else if ( $action === "itemsPickUp" ) {

	$response = itemsPickUp();

} else if ( $action === "deliveredPickedUp" ) {

	$response = deliveredPickedUp();

} else if ( $action === "orderReq" ) {

	$response = orderReq();

} else if ( $action === "approvedReqOR" ) {

	$response = approvedReqOR();

} else if ( $action === "onDelivery" ) {

	$response = onDelivery();

} else if ( $action === "delivered" ) {

	$response = delivered();

} else if ( $action === "pickUpReq" ) {

	$response = pickUpReq();

} else if ( $action === "deliveryReq" ) {

	$response = deliveryReq();

} else if ( $action === "readyForPickup" ) {

	$response = readyForPickup();

} else if ( $action === "duetodayPickup" ) {

	$response = duetodayPickup();

} else if ( $action === "dueTomPickup" ) {

	$response = dueTomPickup();

} else if ( $action === "readyForDel" ) {

	$response = readyForDel();

} else if ( $action === "duetodayDel" ) {

	$response = duetodayDel();

} else if ( $action === "dueTomDel" ) {

	$response = dueTomDel();

} else if ( $action === "withAssDelMan" ) {

	$response = withAssDelMan();

} else if ( $action === "withoutAssDelMan" ) {

	$response = withoutAssDelMan();

}

date_default_timezone_set( 'Asia/Manila' );

function monEarnings() {
	$mydate = getdate( date( "U" ) );

	$month = 0;

	if ( $mydate[ 'mon' ] - 1 < 1 ) {
		$month = 12;
	} else {
		$month = $mydate[ 'mon' ] - 1;
	}

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT SUM(`O_AmountTotaled`) FROM `fsorderrequest` WHERE `SO_Status` = \"Success\" AND `O_DateOrder` = " . $mydate[ 'year' ] . "-" . $month . "-1";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			if ( isset( $row[ 0 ] ) ) {
				$value = $row[ 0 ];
			} else {
				$value = 0;
			}
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function deliveryPercentage() {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT (SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Delivery\") / (SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Delivery\" AND `SO_Status` = \"Success\")";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function pickupPercentage() {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT (SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Pick-Up\") / (SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Pick-Up\" AND `SO_Status` = \"Success\")";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function newCustomer() { //set as by month	Pending muna
	$today = date( 'Y-m-d', strtotime( 'now' ) );

	$date = date_create( $today, timezone_open( "Asia/Manila" ) );
	
	$mydate = date_format( $date, "Y-m-d" );
	
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`CL_DateRegistered`) FROM `fsclientlogin` WHERE `CL_DateRegistered` = '$mydate'";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function todaysReq() {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$mydate = getdate( date( "U" ) );

	$sql = "SELECT COUNT(`O_AcceptReq`) FROM `fsorderrequest` WHERE `O_AcceptReq` != \"Accepted\" AND `O_DateOrder` = " . $mydate[ 'year' ] . "-" . $mydate[ 'mon' ] . "-" . $mydate[ 'mday' ];

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function approvedReq() { // all
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_AcceptReq`) FROM `fsorderrequest` WHERE `O_AcceptReq` = \"Accepted\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function itemsOnDelivery() { //Not success
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Delivery\" AND `SO_Status` != \"Success\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function itemsPickUp() { //Not success
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Pick-Up\" AND `SO_Status` != \"Success\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function deliveredPickedUp() { //Success - all
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_OrderNumber`) FROM `fsorderrequest` WHERE `SO_Status` = \"Success\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function orderReq() { //Ordering and Reservation part - pending only
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_AcceptReq`) FROM `fsorderrequest` WHERE `O_AcceptReq` != \"Accepted\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}
	} else {
		$value = 0;
	}

	return ( $value );
}

function approvedReqOR() { //Ordering and Reservation part - per day
	$mydate = getdate( date( "U" ) );

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_AcceptReq`) FROM `fsorderrequest` WHERE `O_OrderStatus` = \"Accepted\" AND `SO_Status` != \"Success\" AND `O_DateOrder` >= " . $mydate[ 'year' ] . "-" . $mydate[ 'mon' ] . "-" . $mydate[ 'mday' ];

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function onDelivery() { //Ordering and Reservation part - with assigned Del man
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Delivery\" AND RD_ItemAssignment != \"Pending\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function delivered() { //Ordering and Reservation part
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Delivery\" AND `SO_Status` = \"Success\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function pickUpReq() { //Ordering and Reservation part - all not success
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Pick-Up\" AND `SO_Status` != \"Success\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function deliveryReq() { //Ordering and Reservation part - all not success
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Delivery\" AND `SO_Status` != \"Success\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function readyForPickup() { //Ordering and Reservation part -- Ready for Pick-up Items all not success
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Pick-Up\" AND `O_OrderStatus` != \"Accepted\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function duetodayPickup() { //Ordering and Reservation part -- Ready for Pick-up Items
	$mydate = getdate( date( "U" ) );

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` != \"Pick-Up\" AND `O_DateOrder` = " . $mydate[ 'year' ] . "-" . $mydate[ 'mon' ] . "-" . $mydate[ 'mday' ];

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function dueTomPickup() { //Ordering and Reservation part -- Ready for Pick-up Items
	$today = date( 'Y-m-d', strtotime( 'now' ) );

	$date = date_create( $today, timezone_open( "Asia/Manila" ) );
	
	$date->modify('+1 day');
	
	$mydate = date_format( $date, "Y-m-d" );

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` != \"Pick-Up\" AND `O_DateOrder` = " . strval( $mydate );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function readyForDel() { //Ordering and Reservation part -- Ready for Delivery Items all not success
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Delivery\" AND `O_OrderStatus` = \"Accepted\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function duetodayDel() { //Ordering and Reservation part -- Ready for Delivery Items
	$mydate = getdate( date( "U" ) );

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` != \"Delivery\" AND `O_DateOrder` = " . $mydate[ 'year' ] . "-" . $mydate[ 'mon' ] . "-" . $mydate[ 'mday' ];
	
	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function dueTomDel() { //Ordering and Reservation part -- Ready for Delivery Items
	$today = date( 'Y-m-d', strtotime( 'now' ) );

	$date = date_create( $today, timezone_open( "Asia/Manila" ) );
	
	$date->modify('+1 day');
	
	$mydate = date_format( $date, "Y-m-d" );

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` != \"Delivery\" AND `O_DateOrder` = " . strval( $mydate );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function withAssDelMan() { //Ordering and Reservation part -- Ready for Delivery Items - all not success
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Delivery\" AND `O_OrderStatus` = \"Accepted\" AND `RD_ItemAssignment` LIKE \"%Item was assign to%\" AND `SO_Status` != \"Success\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

function withoutAssDelMan() { //Ordering and Reservation part -- Ready for Delivery Items - all not success
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT COUNT(`O_Type`) FROM `fsorderrequest` WHERE `O_Type` = \"Delivery\" AND `O_OrderStatus` = \"Accepted\" AND `RD_ItemAssignment` = \"Pending\" AND `SO_Status` != \"Success\"";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$value = $row[ 0 ];
		}

	} else {
		$value = 0;
	}

	return ( $value );
}

//JSON Encode
/*if ( $response != null && $action != 'monthlyEarnings' || $action != 'delPercentage' || $action != 'pickPercentage' ) {
	echo json_encode( $response );
} else {
	echo $response;
}*/
echo $response;
?>