<?php

define( 'DB_SERVER', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', 'dbflowershop' );


$action = $_POST[ 'clienttoadmin' ];

if ( $action === "cartToOrderReq" ) {

	$cartItem = $_POST[ 'jsonDataCart' ];
	$response = cartToOrderReq( $cartItem );

} else if ( $action === 'cusUpdate') {
	
	$sql = $_POST['cuSQL'];
	$response = cuquery( $sql );
}

//Cart Item Parser
/*$cartItem = '[{"name":"wala, meron e","item":[{"item":"2"},{"item":"1"}],"qty":[{"item":"2"},{"item":"2"}],"price":[{"item":"465"},{"item":"6546.56"}],"orderType":"Pick-Up","date":"05\/17\/2020","controlNumber":"51"}]';
cartToOrderReq( $cartItem );*/

function cartToOrderReq( $cartItem ) {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$array = json_decode( $cartItem, true );

	$name = $array[ 0 ][ 'name' ];
	$cID = $array[ 0 ][ 'cusID' ];
	$item = mysqli_real_escape_string( $db, json_encode( $array[ 0 ][ 'item' ] ) );
	$qty = mysqli_real_escape_string( $db, json_encode( $array[ 0 ][ 'qty' ] ) );
	$price = mysqli_real_escape_string( $db, json_encode( $array[ 0 ][ 'price' ] ) );
	$order = $array[ 0 ][ 'orderType' ];
	$date = $array[ 0 ][ 'date' ];
	$controlnum = $array[ 0 ][ 'controlNumber' ];
	$totalitemAmount = $array[ 0 ][ 'totalPrice' ];

	if ( date( "h" ) + 7 > 12 ) { //check for errors
		$hr = date( "h" );
	} else {
		$hr = date( "h" ) + 7;
	}
	$time = $hr . date( ":i:s A" );
	$datetoday = date( "Y-m-d" );

	/*foreach($array as $k=>$val):
	    echo '<b>Name: '.$k.'</b></br>';
	    $keys = array_keys($val);
	    foreach($keys as $key):
	        echo '&nbsp;'.ucfirst($key).' = '.$val[$key].'</br>';
	    endforeach;
	endforeach;*/

	/*print_r( $name . '<br>' );
	print_r( $item );
	echo( '<br>' );
	print_r( $qty );
	echo( '<br>' );
	print_r( $price );
	echo( '<br>' );
	print_r( $order . '<br>' );
	print_r( $date . '<br>' );
	print_r( $controlnum . '<br>' );*/

	/*INSERT INTO `fsorderrequest`(`O_OrderNumber`, `O_Type`, `O_ReqDate`, `O_CusName`, `O_Item`, `O_Qty`, `O_ItemAmount`, `O_PaymentMethod`, `O_ReferenceNumber`, `O_AmountTotaled`, `O_DateOrder`, `O_AcceptReq`, `RD_ItemAssignment`, `O_OrderStatus`, `RP_Status`, `SO_Status`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16])*/

	$sql = 'INSERT INTO `fsorderrequest`(`O_Type`, `CusOrder_ID`, `O_ReqDate`, `O_CusName`, `O_Item`, `O_Qty`, `O_ItemAmount`, `O_PaymentMethod`, `O_ReferenceNumber`, `O_AmountTotaled`, `O_DateOrder`, `O_AcceptReq`, `RD_ItemAssignment`, `O_OrderStatus`, `RP_Status`, `SO_Status`) VALUES ("' . $order . '","' . $cID . '","' .  $date . '","' . $name . '","' . $item . '","' . $qty . '","' . $price . '","Cebuana Lhuillier","' . $controlnum . '",' . $totalitemAmount . ',"' . $datetoday . '","Pending","Pending","Pending","Pending","Pending")';

	if ( mysqli_query( $db, $sql ) ) {
		return "Request added successfully!";
	} else {
		return "Error added record: " . mysqli_error( $db );
	}
	//return ( $cartItem );
}
//End Cart Item Parser

//Query Execute Filtered
function cuquery( $sql ) {

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


if ( $response != null && $action == 'artToOrderReq') {
	echo json_encode( $response );
} else {
	echo $response;
}
?>