<?php
//Connection
define( 'DB_SERVER', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', 'dbflowershop' );


$action = $_POST[ 'ordering' ];

if ( $action === "orload" ) {

	$query = $_POST[ 'query' ];
	$response = orload( $query );

} else if ( $action === "acceptOrder" ) {

	$sql = $_POST[ 'query' ];
	$response = acceptOrder( $sql );

} else if ( $action === "oaload" ) {

	$query = $_POST[ 'query' ];
	$response = oaload( $query );

} else if ( $action === "rdload" ) {

	$query = $_POST[ 'query' ];
	$response = rdload( $query );

} else if ( $action === "rdquery" ) {

	$query = $_POST[ 'query' ];
	$response = rdquery( $query );

} else if ( $action === "rpload" ) {

	$query = $_POST[ 'query' ];
	$response = rpload( $query );

} else if ( $action === "rpUpdate" ) { //pending

	$query = $_POST[ 'query' ];
	$response = rpUpdateStatus( $query );

} else if ( $action === "odload" ) {

	$query = $_POST[ 'query' ];
	$response = odload( $query );

} else if ( $action === "riload" ) {

	$query = $_POST[ 'query' ];
	$response = riload( $query );

} else if ( $action === "riAdd" ) {

	$query = $_POST[ 'query' ];
	$response = riUpdateStatus( $query );

} else if ( $action === "rdManList" ) {

	$query = $_POST[ 'query' ];
	$response = rdManList( $query );

}

function orload( $sql ) {

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {

		while ( $row = mysqli_fetch_array( $result ) ) {

			$perItem = '';
			$perQty = '';
			$perPrice = '';

			$item = json_decode( $row[ 'O_Item' ], true );
			for ( $a = 0; $a < sizeof( $item ); $a++ ) {
				$perItem .= getName($item[ $a ][ 'item' ]) . '<br>';
			}

			$itemqty = json_decode( $row[ 'O_Qty' ], true );
			for ( $ab = 0; $ab < sizeof( $itemqty ); $ab++ ) {
				$perQty .= $itemqty[ $ab ][ 'item' ] . '<br>';
			}

			$itemprice = json_decode( $row[ 'O_ItemAmount' ], true );
			for ( $ac = 0; $ac < sizeof( $itemprice ); $ac++ ) {
				$perPrice .= '₱ ' . $itemprice[ $ac ][ 'item' ] . '<br>';
			}

			$resInfo .= '<tr>
						       	<td>' . $row[ 'O_OrderNumber' ] . '</td>
						       	<td>' . $row[ 'O_Type' ] . '</td>
						       	<td>' . $row[ 'O_ReqDate' ] . '</td>
						       	<td>' . $row[ 'O_CusName' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
						       	<td>' . $perPrice . '</td>
						       	<td>' . $row[ 'O_PaymentMethod' ] . '</td>
						       	<td>' . $row[ 'O_ReferenceNumber' ] . '</td>
						       	<td>' . '₱ ' . $row[ 'O_AmountTotaled' ] . '</td>
						       	<td>' . $row[ 'CL_Contact' ] . '</td>
						       	<td>' . $row[ 'O_DateOrder' ] . '</td>
						       	<td>
						       		<button type="button"  data-toggle="modal" onclick="showSuccess(this.id)" data-target="#exampleModalLong" id="orAccept_' . $row[ 'O_OrderNumber' ] . '">Accept</button>
						       		<button type="button"  data-toggle="modal" data-target="#exampleModal" id="orCancel_' . $row[ 'O_OrderNumber' ] . '" onclick="getID(this.id)">Cancel</button>
						       	</td>';
		}

	} else {
		$resInfo = '<td colspan="13">Empty Database</td>';
	}

	return $resInfo;

}

function acceptOrder( $sql ) {

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	if ( mysqli_query( $db, $sql ) ) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error( $db );
	}
}

function oaload( $sql ) {

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
						       	<td>' . $row[ 'O_CusName' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
						       	<td>
						       		<button onclick="showReady(this.id)" id="ready_' . $row[ 'O_OrderNumber' ] . '">Ready</button>
						       	</td>
						      </tr>';
		}

	} else {
		$resInfo = '<td colspan="6">Empty Database</td>';
	}

	return $resInfo;

}

function rdload( $sql ) {

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
						       	<td>' . $row[ 'O_CusName' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
						       	<td>' . $row[ 'CL_AddBlockHouseNo' ] . ' ' . $row[ 'CL_AddStreet' ] . ' ' . $row[ 'CL_AddBrgy' ] . ' ' . $row[ 'CL_AddCity' ] . ' ' . $row[ 'CL_AddProvince' ] . '</td>
						       	<td>' . $row[ 'CL_Contact' ] . '</td>
						       	<td>' . $row[ 'O_DateOrder' ] . '</td>
						       	<td>' . $row[ 'O_ReqDate' ] . '</td>
						       	<td><input class="chkboxs" id="checked_' . $row[ 'O_OrderNumber' ] . '" type="radio" name="grpRadio" value="' . $row[ 'O_OrderNumber' ] . '" onchange="showAssign()"></td>
						       	<td>' . $row[ 'RD_ItemAssignment' ] . '</td>				
						      </tr>';
		}

	} else {
		$resInfo = '<td colspan="10">Empty Database</td>';
	}

	return $resInfo;

}
	
function rdManList( $sql ) {
	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$condition = rdstatus( $row[ 'L_ID' ] );
			$status = '';
			$offline = '<label style="color: green">Available</label>';
			$ifDisabled = '';

			if ( $condition != 'Busy' ) {
				$status = '<label style="color: green">Available</label>';
			} else {
				$status = '<label style="color: red">Busy</label>';
				$ifDisabled = 'disabled';
			}
			$resInfo .= '<tr>
								<td>' . $row[ 'L_ID' ] . '</td>
								<td>' . $row[ 'L_Name' ] . '</td>
								<td>' . $status . '
								</td>
								<td><input type="radio" '.$ifDisabled.' name="DelMan" value="' . $row[ 'L_ID' ] . '"> </td>
						</tr>';
		}

	} else {
		$resInfo = '<td colspan="4">Empty Database</td>';
	}

	return $resInfo;
}

function rdstatus( $id ){
	
	$status = '';
	
	$sql = 'SELECT `RD_Status` FROM `fs_rd_delmanstatus` WHERE `RD_ID` = ' . $id;
		
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
	
	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$status = $row['RD_Status'];
		}
	} else {
		$status = 'null';
	}
	
	return($status);
}

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


function rpload( $sql ) {

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
						       	<td>' . $row[ 'O_CusName' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
						       	<td>' . $row[ 'O_ReqDate' ] . '</td>
						       	<td>' . $row[ 'CL_Contact' ] . '</td>
						       	<td>
						       		<button onclick="showpickup(this.id)" id="rpReady_' . $row[ 'O_OrderNumber' ] . '">Pickup</button>
						       	</td>
						      </tr>';
		}

	} else {
		$resInfo = '<td colspan="7">Empty Database</td>';
	}

	return $resInfo;

}

function rpUpdateStatus( $sql ) {

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	if ( mysqli_query( $db, $sql ) ) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error( $db );
	}
}

function odload( $sql ) {

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
						       	<td>' . $row[ 'O_CusName' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
						       	<td>' . $row[ 'CL_AddBlockHouseNo' ] . ' ' . $row[ 'CL_AddStreet' ] . ' ' . $row[ 'CL_AddBrgy' ] . ' ' . $row[ 'CL_AddCity' ] . ' ' . $row[ 'CL_AddProvince' ] . '</td>
						       	<td>' . $row[ 'CL_Contact' ] . '</td>
						      </tr>';
		}

	} else {
		$resInfo = '<td colspan="7">Empty Database</td>';
	}

	return $resInfo;

}

function riload( $sql ) {

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		/*`fsorderrequest`(`O_OrderNumber`, `O_Type`, `O_ReqDate`, `O_CusName`, `O_Item`, `O_Qty`, `O_ItemAmount`, `O_PaymentMethod`, `O_ReferenceNumber`, `O_AmountTotaled`, `O_Contact`, `O_DateOrder`, `O_AcceptReq`, `RD_ItemAssignment`, `O_OrderStatus`, `RP_Status`)
		`fsclientlogin`(`CL_ID`, `CL_LName`, `CL_GName`, `CL_MInitial`, `CL_Email`, `CL_Contact`, `CL_AddBlockHouseNo`, `CL_AddStreet`, `CL_AddBrgy`, `CL_AddCity`, `CL_AddProvince`, `CL_AddZipCode`, `CL_Username`, `CL_Password`, `Cus_OrderNumber`)*/
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
						       	<td>' . $row[ 'O_CusName' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
						       	<td>' . $row[ 'O_ReqDate' ] . '</td>
						      </tr>';
		}

	} else {
		$resInfo = '<td colspan="7">Empty Database</td>';
	}

	return $resInfo;

}

function riUpdateStatus( $sql ) {

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	if ( mysqli_query( $db, $sql ) ) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error( $db );
	}
}

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

if ( $response != null && $action != 'orload' && $action != 'oaload' && $action != 'rdload' && $action != 'rpload' && $action != 'odload' && $action != 'riload' && $action != 'rdManList' ) {
	echo json_encode( $response );
} else {
	echo $response;
}

?>