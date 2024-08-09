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

$action = $_POST[ 'Item' ];

if ( $action === "addItem" ) {

	$file = addslashes( file_get_contents( $_FILES[ 'file' ][ 'tmp_name' ] ) );
	$response = addItem( $_POST[ 'aIName' ], $_POST[ 'aIPrice' ], $_POST[ 'aIDetails' ], $_POST[ 'aIOccation' ], $file );

} else if ( $action === "loadItem" ) {

	$response = loadItem();

}

function addItem( $name, $price, $desc, $cat, $fl ) {
	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$ianame = mysqli_real_escape_string( $db, $name );
	$idesc = mysqli_real_escape_string( $db, $desc );
	$icat = mysqli_real_escape_string( $db, $cat );

	$sql = "INSERT INTO `fsitems`(`I_ItemName`, `I_Description`, `I_Price`, `I_Occasion`, `I_Enable`, `I_Image`) VALUES ('$ianame','$idesc',$price,'$icat','Enable', '$fl')";

	if ( $db->query( $sql ) === TRUE ) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}
}

function loadItem() {

	$resInfo = '';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$sql = "SELECT * FROM fsitems";

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
	//$row = mysqli_fetch_array( $result, MYSQLI_ASSOC );

	if ( mysqli_num_rows( $result ) > 0 ) {

		while ( $row = mysqli_fetch_array( $result ) ) {
			$resInfo .= '<tr id="stats">
						      	<td><img src="data:image/jpeg;base64,' . base64_encode( $row[ 'I_Image' ] ) . '" width="250" height="250"/></td>
						      	<td>' . $row[ 'I_Code' ] . '</td>
						       	<td>' . $row[ 'I_ItemName' ] . '</td>
						       	<td>' . $row[ 'I_Occasion' ] . '</td>
						       	<td>Php ' . $row[ 'I_Price' ] . '</td>
						       	<!--<td>
						       		<button type="button"  data-toggle="modal" data-target="#exampleModal">Update</button><br><br>
						       		<label class="switch">
										<input type="checkbox" checked id="activate" onclick="activate()">
										<span class="slider round"></span>
									</label>
									<br>
									<label id="active" style="color: green">Enable</label>
									<label id="inactive" style="display: none;color: red">Disable</label>
						       	</td> Temporarily Disabled-->
						      </tr>';
		}

	} else {
		$resInfo = '<td colspan="6">Empty Database</td>';
	}
	return $resInfo;
}

if ( $response != null && $action != "loadItem" ) {
	echo json_encode( $response );
} else {
	echo $response;
}

?>