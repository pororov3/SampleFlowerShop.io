<?php

define( 'DB_SERVER', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', 'dbflowershop' );


$action = $_POST[ 'clientaccount' ];

if ( $action === "clientlogin" ) {

	session_start();
	$uname = $_POST[ 'cllUsername' ];
	$pass = $_POST[ 'cllPassword' ];
	if ( $uname == 'admin' && $pass == 'admin' ) {
		echo '<script type="text/javascript">window.location.href="/Admin/admin-login.php"</script>';
		//header( "location: .\..\..\admin\admin-login.php" );
		//die();
		//echo 'window.location.href="admin-login.php"';
	} else {
		$response = clLogin( $uname, $pass );
	}

} else if ( $action === "clientregister" ) {

	$lname = $_POST[ 'clrLName' ];
	$gname = $_POST[ 'clrGName' ];
	$mi = $_POST[ 'clrMI' ];
	$email = $_POST[ 'clrEmail' ];
	$contact = $_POST[ 'clrContact' ];
	$block = $_POST[ 'clrAddBlock' ];
	$street = $_POST[ 'clrAddStreet' ];
	$brgy = $_POST[ 'clrBrgy' ];
	$city = $_POST[ 'clrCity' ];
	$province = $_POST[ 'clrProvince' ];
	$zip = $_POST[ 'clrZipCode' ];
	$user = $_POST[ 'clrUsername' ];
	$pass = $_POST[ 'clrPassword' ];
	$response = clientregister( $lname, $gname, $mi, $email, $contact, $street, $block, $brgy, $city, $province, $zip, $user, $pass );

} else if ( $action === "loginVer" ) {

	session_start();
	$response = loginVer();

} else if ( $action === "userInfo" ) {

	session_start();
	$response = userInfo();

} else if ( $action === "clLogout" ) {

	session_start();
	$response = clLogout();

} else if ( $action === "clmodalOA" ) {

	$fname = $_POST[ 'clname' ];
	$response = modalOA( $fname );

} else if ( $action === "clmodalOR" ) {

	$fname = $_POST[ 'clname' ];
	$response = modalOR( $fname );

} else if ( $action === "clmodalOD" ) {

	$fname = $_POST[ 'clname' ];
	$response = modalOD( $fname );

} else if ( $action === "clmodalR" ) {

	$fname = $_POST[ 'clname' ];
	$response = modalR( $fname );

} else if ( $action === "clrecentTrans" ) {

	$fname = $_POST[ 'clname' ];
	$response = recentTrans( $fname );

}

//Client Register
function clientregister( $lname, $gname, $mi, $email, $contact, $street, $block, $brgy, $city, $province, $zip, $user, $pass ) {
	$today = date( 'Y-m-d', strtotime( 'now' ) );

	$date = date_create( $today, timezone_open( "Asia/Manila" ) );
	
	$mydate = date_format( $date, "Y-m-d" );
	
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "INSERT INTO `fsclientlogin`( `CL_LName`, `CL_GName`, `CL_MInitial`, `CL_Email`, `CL_Contact`, `CL_AddBlockHouseNo`, `CL_AddStreet`, `CL_AddBrgy`, `CL_AddCity`, `CL_AddProvince`, `CL_AddZipCode`, `CL_Username`, `CL_Password`, `CL_DateRegistered` ) VALUES ('$lname','$gname','$mi','$email','$contact','$street','$block','$brgy','$city','$province','$zip','$user','$pass','$mydate')";

	if ( mysqli_query( $db, $sql ) ) {
		echo "Registered successfully!";
	} else {
		echo "Error updating record: " . mysqli_error( $db );
	}
}
//End Client Register

//Client Login
function clLogin( $user, $pass ) {
	if ( $user == 'admin' && $pass == 'admin' ) {
		header( "location: .\admin\admin-login.php" );
		//echo 'window.location.href="admin-login.php"';
	} else {
		$sql = 'SELECT * FROM fsclientlogin WHERE `CL_Username` = "' . $user . '" AND `CL_Password` = "' . $pass . '"';

		$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

		$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
		$count = mysqli_num_rows( $result );

		if ( $count == 1 ) {
			if ( mysqli_num_rows( $result ) > 0 ) {
				while ( $row = mysqli_fetch_array( $result ) ) {
					echo 'Login successful!';
					$_SESSION[ 'clUser' ] = $row[ 'CL_Username' ];
					$_SESSION[ 'clPass' ] = $row[ 'CL_Password' ];
					//$_SESSION[ 'clUID' ] = $row[ 'CL_ID' ];
					//$_SESSION[ 'clFullName' ] = $row[ 'CL_Password' ];
					//$_SESSION[ 'clContact' ] = $row[ 'CL_Password' ];
				}
			} else {
				echo( "Invalid!" );
			}
		} else if ( $count == 0 ) {
			echo 'No Account match!';
		} else {
			echo 'Multiple User seen!';
		}
	}
}
//End Client Login

//Login Session
function clSLogin( $user, $pass ) {
	$sql = 'SELECT * FROM fsclientlogin WHERE `CL_Username` = "' . $user . '" AND `CL_Password` = "' . $pass . '"';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
	$count = mysqli_num_rows( $result );

	if ( $count == 1 ) {
		if ( mysqli_num_rows( $result ) > 0 ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				echo 'Account Verified!';
			}
		} else {
			echo( "Invalid!" );
		}
	} else if ( $count == 0 ) {
		echo 'No Account match!';
	} else {
		echo 'Multiple User seen!';
	}

}
//End Login Session

//isLogin Verifier
function loginVer() {

	if ( isset( $_SESSION[ 'clUser' ] ) ) {
		//echo( "Already logged in!" );
		clSLogin( $_SESSION[ 'clUser' ], $_SESSION[ 'clPass' ] );
	} else {
		echo( "Not logged in!" );
	}
}
//End isLogin Verifier

//Manage Profile

function userInfo() {

	$user = $_SESSION[ 'clUser' ];
	$pass = $_SESSION[ 'clPass' ];

	$sql = 'SELECT * FROM fsclientlogin WHERE `CL_Username` = "' . $user . '" AND `CL_Password` = "' . $pass . '"';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			return ( $row );
		}
	} else {
		return ( "Invalid!" );
	}

}

function clLogout() {
	unset( $_SESSION[ 'clUser' ] );
	unset( $_SESSION[ 'clPass' ] );
	//unset($_SESSION['clUID']);
	return ( "Logged Out" );
}

//End Manage Profile

//Dashboard
//get Item name by ID
function getName( $id ) {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );
	$sql = 'SELECT `I_ItemName` FROM `fsitems` WHERE `I_Code` = ' . $id . '';
	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$itemname = $row[ 0 ];
		}

	} else {
		$itemname = "Item Not Found";
	}

	return $itemname;
}
//End get Item name by ID

function modalOA( $fname ) {

	/*SELECT `O_OrderNumber`, `CusOrder_ID`, `O_Type`, `O_ReqDate`, `O_CusName`, `O_Item`, `O_Qty`, `O_ItemAmount`, `O_PaymentMethod`, `O_ReferenceNumber`, `O_AmountTotaled`, `O_DateOrder`, `O_AcceptReq`, `RD_ItemAssignment`, `O_OrderStatus`, `RP_Status`, `SO_Status` FROM `fsorderrequest` WHERE 1*/
	
	$sql = "SELECT * FROM `fsorderrequest` WHERE `O_CusName` = '" . $fname . "' AND `SO_Status` != 'Success' AND `O_OrderStatus` != 'Accepted' AND `RP_Status` != 'Accepted'";

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {

			$perItem = '';
			$perQty = '';

			$item = json_decode( $row[ 'O_Item' ], true );
			for ( $a = 0; $a < sizeof( $item ); $a++ ) {
				$perItem .= getName($item[ $a ][ 'item' ]) . '<br>';
			}

			$itemqty = json_decode( $row[ 'O_Qty' ], true );
			for ( $ab = 0; $ab < sizeof( $itemqty ); $ab++ ) {
				$perQty .= $itemqty[ $ab ][ 'item' ] . '<br>';
			}

			$resInfo .= '<tr>
						       	<td>' . $row[ 'O_OrderNumber' ] . '</td>
						       	<td>' . $row[ 'O_Type' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
								<td>' . $row[ 'O_AcceptReq' ] . '</td>
						 </tr>';
		}

	} else {
		$resInfo = '<td colspan="5">No Record Found!</td>';
	}

	return $resInfo;

}

function modalOR( $fname ) {

	$sql = "SELECT * FROM `fsorderrequest` WHERE `O_CusName` = '" . $fname . "' AND `SO_Status` != 'Success' AND `O_AcceptReq` = 'Accepted' AND `O_OrderStatus` = 'Accepted' AND `RP_Status` != 'Accepted'";

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {

			$perItem = '';
			$perQty = '';

			$item = json_decode( $row[ 'O_Item' ], true );
			for ( $a = 0; $a < sizeof( $item ); $a++ ) {
				$perItem .= getName($item[ $a ][ 'item' ]) . '<br>';
			}

			$itemqty = json_decode( $row[ 'O_Qty' ], true );
			for ( $ab = 0; $ab < sizeof( $itemqty ); $ab++ ) {
				$perQty .= $itemqty[ $ab ][ 'item' ] . '<br>';
			}

			$resInfo .= '<tr>
						       	<td>' . $row[ 'O_OrderNumber' ] . '</td>
						       	<td>' . $row[ 'O_Type' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
								<td>' . $row[ 'O_AcceptReq' ] . '</td>
						 </tr>';
		}

	} else {
		$resInfo = '<td colspan="5">No Record Found!</td>';
	}

	return $resInfo;

}

function modalOD( $fname ) {

	$sql = "SELECT * FROM `fsorderrequest` WHERE `O_CusName` = '" . $fname . "' AND `SO_Status` != 'Success' AND `O_AcceptReq` = 'Accepted' AND `O_OrderStatus` = 'Accepted' AND `RD_ItemAssignment` != 'Pending' AND `O_Type` = 'Delivery'";

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {

			$perItem = '';
			$perQty = '';

			$item = json_decode( $row[ 'O_Item' ], true );
			for ( $a = 0; $a < sizeof( $item ); $a++ ) {
				$perItem .= getName($item[ $a ][ 'item' ]) . '<br>';
			}

			$itemqty = json_decode( $row[ 'O_Qty' ], true );
			for ( $ab = 0; $ab < sizeof( $itemqty ); $ab++ ) {
				$perQty .= $itemqty[ $ab ][ 'item' ] . '<br>';
			}

			$resInfo .= '<tr>
						       	<td>' . $row[ 'O_OrderNumber' ] . '</td>
						       	<td>' . $row[ 'O_Type' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
								<td>' . $row[ 'O_AcceptReq' ] . '</td>
						 </tr>';
		}

	} else {
		$resInfo = '<td colspan="5">No Record Found!</td>';
	}

	return $resInfo;

}

function modalR( $fname ) {

	$sql = "SELECT * FROM `fsorderrequest` WHERE `O_CusName` = '" . $fname . "' AND `SO_Status` = 'Success'";

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {

			$perItem = '';
			$perQty = '';

			$item = json_decode( $row[ 'O_Item' ], true );
			for ( $a = 0; $a < sizeof( $item ); $a++ ) {
				$perItem .= getName($item[ $a ][ 'item' ]) . '<br>';
			}

			$itemqty = json_decode( $row[ 'O_Qty' ], true );
			for ( $ab = 0; $ab < sizeof( $itemqty ); $ab++ ) {
				$perQty .= $itemqty[ $ab ][ 'item' ] . '<br>';
			}

			$resInfo .= '<tr>
						       	<td>' . $row[ 'O_OrderNumber' ] . '</td>
						       	<td>' . $row[ 'O_Type' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
								<td> Received </td>
						 </tr>';
		}

	} else {
		$resInfo = '<td colspan="5">No Record Found!</td>';
	}

	return $resInfo;

}
//End Dashboard

//Recent Transaction
function recentTrans( $fname ) {

	$sql = "SELECT * FROM `fsorderrequest` WHERE `O_CusName` = '" . $fname . "'";

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {

			$perItem = '';
			$perQty = '';

			$item = json_decode( $row[ 'O_Item' ], true );
			for ( $a = 0; $a < sizeof( $item ); $a++ ) {
				$perItem .= getName($item[ $a ][ 'item' ]) . '<br>';
			}

			$itemqty = json_decode( $row[ 'O_Qty' ], true );
			for ( $ab = 0; $ab < sizeof( $itemqty ); $ab++ ) {
				$perQty .= $itemqty[ $ab ][ 'item' ] . '<br>';
			}

			$resInfo .= '<tr>
						       	<td>' . $row[ 'O_OrderNumber' ] . '</td>
						       	<td>' . $row[ 'O_Type' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
								<td>' . $row[ 'SO_Status' ] . '</td>
						 </tr>';
		}

	} else {
		$resInfo = '<td colspan="5">No Record Found!</td>';
	}

	return $resInfo;

}
//End Recent Transaction

//reference only
function rdquery( $sql ) {

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	if ( strpos( $sql, "UPDATE" ) !== false || strpos( $sql, "INSERT" ) !== false ) {
		if ( mysqli_query( $db, $sql ) ) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . mysqli_error( $db );
		}
	} else {
		$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
		if ( mysqli_num_rows( $result ) > 0 ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				echo( $row[ 0 ] );
			}
		} else {
			echo( "Invalid!" );
		}
	}
}

//double chk values below
if ( $response != null && $action != 'homeitemsload' && $action != 'acLoadDetails' && $action != 'clmodalOA' && $action != 'clmodalOR' && $action != 'clmodalOD' && $action != 'clmodalR' && $action != 'clrecentTrans' ) {
	echo json_encode( $response );
} else {
	echo $response;
}
?>