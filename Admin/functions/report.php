<?php
//Connection
define( 'DB_SERVER', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', 'dbflowershop' );

//get action
$action = $_POST[ 'report' ];

if ( $action === "loadTH" ) {

	$sql = $_POST[ 'sql' ];
	$response = loadTransHistory( $sql );

} else if ( $action === "loadOR" ) {

	$sql = $_POST[ 'sql' ];
	$response = loadOrderReserve( $sql );

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

//Order Sorting
function sortItem( $filter ) {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = 'SELECT `O_Item`, `O_Qty` FROM `fsorderrequest` ' . $filter;

	$totalOrderCount = 0;
	$totalOrderSales = 0;
	$itemArray = array();
	$itemDecode;
	$sumArray = array();

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {

		while ( $row = mysqli_fetch_array( $result ) ) {

			$perItem = '';
			$perQty = '';

			$item = json_decode( $row[ 'O_Item' ], true );
			for ( $a = 0; $a < sizeof( $item ); $a++ ) {
				$perItem = $item[ $a ][ 'item' ];

				$itemqty = json_decode( $row[ 'O_Qty' ], true );
				$perQty = $itemqty[ $a ][ 'item' ];

				$itemArray[] = array( $perItem, $perQty );
			}
		}

		foreach ( $itemArray as $set => $subset ) {

			$tempKey = 0;
			$tempValue = 0;

			$tempKey = ( int )json_encode( $subset[ 0 ] );
			$tempValue = ( int )json_encode( $subset[ 1 ] );

			if ( !array_key_exists( $tempKey, $sumArray ) ) { //isset( $sumArray[ $tempKey ][ $tempValue ] )
				$sumArray[ $tempKey ] = $tempValue;
			} else {
				$sumArray[ $tempKey ] += $tempValue;
			}
		}

	} else {
		$sumArray = array();
	}

	return $sumArray;
}
//End of Order Sorting

//Ordering and Reservation Report
function loadOrderReserve( $sql ) {

	$parsedSQL = substr($sql,strpos($sql,'WHERE'));
	$resInfo = '';
	$perItem = '';
	$itemizedRow = array();
	$totalItems = sortItem($parsedSQL);
	ksort( $totalItems );

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql . " LIMIT " . count( $totalItems ) )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {

		while ( $row = mysqli_fetch_array( $result ) ) {

			$totalOrderCount = 0;
			$totalOrderSales = 0;

			foreach ( $totalItems as $key => $value ) {
				if ( $row[ 'I_Code' ] == $key ) {
					$totalOrderCount = $value;
					$totalOrderSales = $row[ 'I_Price' ] * $totalOrderCount;
				}
			}

			$resInfo .= '<tr>
								<td>' . $row[ 'I_Code' ] . '</td>
						       	<td>' . $row[ 'I_ItemName' ] . '</td>
						       	<td>' . $row[ 'I_Description' ] . '</td>
						       	<td>' . $row[ 'I_Occasion' ] . '</td>
						       	<td>' . $row[ 'I_Price' ] . '</td>
						       	<td>' . $totalOrderCount . '</td>
						       	<td> ₱ ' . $totalOrderSales . '</td>';

		}

	} else {
		$resInfo = '<td colspan="7">Empty Database</td>';
	}

	return $resInfo;
}
//End Ordering and Reservation Report

//Transaction History
function loadTransHistory( $sql ) {

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
				$perItem .= getName( $item[ $a ][ 'item' ] ) . '<br>';
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
						       	<td>' . $row[ 'O_CusName' ] . '</td>
						       	<td>' . $row[ 'O_Type' ] . '</td>
						       	<td>' . $perItem . '</td>
						       	<td>' . $perQty . '</td>
						       	<td>' . $perPrice . '</td>
						       	<td>' . $row[ 'O_PaymentMethod' ] . '</td>
						       	<td>' . $row[ 'O_ReferenceNumber' ] . '</td>
						       	<td>' . '₱ ' . $row[ 'O_AmountTotaled' ] . '</td>
						       	<td>' . $row[ 'O_ReqDate' ] . '</td>
						       	<td>' . $row[ 'O_DateOrder' ] . '</td>';
		}

	} else {
		$resInfo = '<td colspan="11">Empty Database</td>';
	}

	return $resInfo;
}
//End Transaction History

if ( $response != null && $action == 'loadOR' && $action == 'loadTH' ) {
	echo json_encode( $response );
} else {
	echo $response;
}

?>