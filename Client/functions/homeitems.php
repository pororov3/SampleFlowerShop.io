<?php

define( 'DB_SERVER', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', 'dbflowershop' );


$action = $_POST[ 'clienthome' ];

if ( $action === "homeitemsload" ) {

	//$query = $_POST[ 'query' ];
	$response = homeitemsload();

} else if ( $action === "acLoadDetails" ) {

	$id = $_POST[ 'itemID' ];
	$response = acLoadItemID( $id );

} else if ( $action === "cartLoadItem" ) {

	$id = $_POST[ 'itemID' ];
	$cartID = $_POST[ 'cartNumber' ];
	$qty = $_POST[ 'itemQty' ];
	$response = cartLoadItem( $id, $cartID, $qty );

}

//Product Home
function homeitemsload() {
	$eaitem = '';

	$sql = 'SELECT * FROM `fsitems`';

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );

	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {

			$eaitem .= '<div class="col-sm-3 add-to-cart" id="' . $row[ 'I_Code' ] . '">
				<div class="product-background-color">
						<div class="product-image">
							<div class="promo">
								<label></label>
							</div>
							<img src="data:image/jpeg;base64,' . base64_encode( $row[ 'I_Image' ] ) . '" onclick="window.location.href=\'add-to-cart.php\'" id="' . $row[ 'I_Code' ] . '"/>
						</div>
						<div class="product-name">
							' . $row[ 'I_ItemName' ] . '
						</div>
						<div class="product-price">
							<label><span>&#8369;</span> ' . number_format($row[ 'I_Price' ],2) . '</label>
						</div>
						<div class="product-add">
							<button onclick="window.location.href=\'add-to-cart.php\'" id="' . $row[ 'I_Code' ] . '" class="homeproducts">Check Details</button>
					</div>
				</div>	
			</div>';
		}
		echo $eaitem;
	} else {
		echo( "No Item Found!" );
	}
}
//End Product Home

//item description
function acLoadItemID( $id ) {
	$item = '';

	$sql = 'SELECT * FROM `fsitems` WHERE `I_Code` = ' . $id;

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$item = '<div class="row" style="background-color: white;padding-top: 20px;padding-bottom: 20px;border-radius: 20px;">
			<div class="col-md-6">
				<img src="data:image/jpeg;base64,' . base64_encode( $row[ 'I_Image' ] ) . '" style="width: 100%;height: auto;">
			</div>
			<div class="col-md-6 cart-add">
				<h1>' . $row[ 'I_ItemName' ] . '</h1>
				<h3><label>Price: Php</label> <label id="acprice">' . number_format($row[ 'I_Price' ],2) . '</label></h3>
				<div class="row">
					<h3>Quantity:
				<button id="decrease" style="width: 20px;color: blue" onclick="decreaseValue()" value="Decrease Value">-</button>
		        	<input class="input" type="number" id="number" value="1" />
		        <button id="increase" style="width: 20px;color: blue" onclick="increaseValue()" value="Increase Value">+</button>
		        </h3>
				</div>
				<div class="row" id="acItemDesc">
					<h4><label>Details:</label><p id="pitem">' . $row[ 'I_Description' ] . '</p></h4>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">
						<button style="background-color: #990033;" onclick="addtocartBtn(this.id)" id="' . $row[ 'I_Code' ] . '">Add to Cart</button>
					</div>
					<div class="col-md-6">
						<button style="color:#990033;" onclick="window.location.href=\'product.php\'">Pay Now</button>
					</div>
				</div>
			</div>
		</div>';
		}
		echo $item;
	} else {
		echo( "No Item Selected!" );
	}
}
//End item description

//Cart
function cartLoadItem( $id, $cartID, $qty ) {
	$item = '';

	$sql = 'SELECT * FROM `fsitems` WHERE `I_Code` = ' . $id;

	$db = mysqli_connect( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE )or die( mysqli_error( $db ) );

	$result = mysqli_query( $db, $sql )or die( mysqli_error( $db ) );
	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {
			$item = '<div class="row" style="padding: 10px;border:2px solid;border-color: #bfbfbf;">
					<div class="row">
						<div class="col-md-6">
							<img src="data:image/jpeg;base64,' . base64_encode( $row[ 'I_Image' ] ) . '" style="width:100%">
						</div>
						<div class="col-md-6">
							<div class="row divs">
								<div class="col-md-6">
									<label>Item:</label>
								</div>
								<div class="col-md-6">
									<label>' . $row[ 'I_ItemName' ] . '</label>
								</div>
							</div>
							<div class="row divs">
								<div class="col-md-6">
									<label>Price:</label>
								</div>
								<div class="col-md-6">
									<label id="itemPrice_'.$cartID.'">' . number_format($row[ 'I_Price' ],2) . '</label>
								</div>
							</div>
							<div class="row divs">
								<div class="col-md-6">
									<label>Details:</label>
								</div>
								<div class="col-md-6">
									<label>' . $row[ 'I_Description' ] . '</label>
								</div>
							</div>
							<div class="row divs">
								<div class="col-md-6">
									Quantity:
								</div>
								<div class="col-md-6">
									<button id="decrease" style="width: 20px;color: blue" onclick="decreaseValue('.$cartID.');cartCalculator();headLoad();" value="Decrease Value">-</button>
									<input class="inputItemQty" type="number" id="number_'.$cartID.'" value="'.$qty.'" onchange="cartCalculator();headLoad();" style="width: 50%;"/>
									<button id="increase" style="width: 20px;color: blue" onclick="increaseValue('.$cartID.');cartCalculator();headLoad();" value="Increase Value">+</button>
								</div>
							</div>
							<div class="row divs">
								<div class="col-md-6">
								</div>
								<div class="col-md-6">
									<button onclick="removeItem('.$cartID.')">Delete Order</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>';
		}
		echo $item;
	} else {
		echo( "Invalid!" );
	}
}
//End Cart

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
if ( $response != null && $action != 'homeitemsload' && $action != 'acLoadDetails' && $action != 'cartLoadItem' ) {
	echo json_encode( $response );
} else {
	echo $response;
}
?>