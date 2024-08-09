<?php
// Starting session
session_start();
if ( isset( $_SESSION[ "user" ] ) == "" && isset( $_SESSION[ "pass" ] ) == "" ) {
	header( "location: ..\admin\admin-login.php" );
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>On-Delivery</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="functions/item-process.js"></script>
</head>

<body>
	<div class="top">
		<div class="row">
			<div class="col-7">
				<img src="image/logo.png">
			</div>
			<div class="col-4 user">
				<label id="ailabel"></label>
			</div>
			<div class="col-1 profile-pic">
				<img src="image/profile.png">
			</div>
		</div>
	</div>
	<div class="side">
		<button class="collapsibles active-side" onclick="window.location.href='admin-dashboard.php'">Dashboard</button>
		<button class="collapsibles">Ordering <img src="image/down.png"></button>
		<div class="content">
			<button class="collap" onclick="window.location.href='order-request.php'">Order Request</button>
			<button class="collap" onclick="window.location.href='approved-order.php'">Approved Order</button>
			<button class="collap" onclick="window.location.href='Ready-for-Delivery.php'">Ready for Deliver</button>
			<button class="collap" onclick="window.location.href='Ready-for-PickUp.php'">Ready for Pickup</button>
			<button class="collap" onclick="window.location.href='On-Delivery.php'">On Delivery</button>
			<button class="collap" onclick="window.location.href='Received-Items.php'">Received</button>
		</div>
		<button class="collapsibles" style="background-color: #ff0066">Items <img src="image/down.png"></button>
		<div class="content">
			<button class="collap " onclick="window.location.href='Add-Item.php'">Add New Items</button>
			<button class="collap" onclick="window.location.href='Items.php'">Items</button>
		</div>
		<button class="collapsibles">Report <img src="image/down.png"></button>
		<div class="content">
			<button class="collap" onclick="window.location.href='Report.php'">Report</button>
			<button class="collap" onclick="window.location.href='transaction-history.php'">Transaction Histroy</button>
		</div>
		<button class="collapsibles">User <img src="image/down.png"></button>
		<div class="content">
			<button class="collap " onclick="window.location.href='account-setting.php'"> Account Settings</button>
			<button class="collap " onclick="window.location.href='user-log.php'">User Log History</button>
			<button class="collap " onclick="window.location.href='user.php'">User</button>
		</div>
		<button class="collapsibles" data-toggle="modal" data-target=".bs-example-modal-sm">Logout</button>
	</div>
	<div class="dashboard-container">
		<div class="dashboard">
			<div class="row">
				<div class="col-12 order-reserve-padding">
					<div class="order-reserve">
						<div class="alert alert-success" id="Succesfully" style="display: none;" role="alert">
							Succesfully Addded!
						</div>

						<div class="alert alert-danger" id="cancel" style="display: none;" role="alert">
							Lack of info (display this if some field are no data)
						</div>
						<!--<form action="functions/item-process.php" method="post" enctype="multipart/form-data">-->
							<div class="row add-item-div">
								<div class="col-6">
									<div class="row">
										<div class="col-3">Item Name</div>
										<div class="col-9"><input type="text" name="" style="width: 100%" id="aItemName">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-3">Item Price</div>
										<div class="col-9"><input type="text" name="" style="width: 100%" id="aItemPrice">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-3">Item Details</div>
										<div class="col-9">
											<textarea style="width: 100%;height: 50px;" id="aItemDetails"></textarea>
											<br>
											<br>
										</div>
									</div>
									<div class="row">
										<div class="col-3">Occasion</div>
										<div class="col-9">
											<select style="padding: 2px;width: 100%" id="aItemOccation">
												<option>Valentines</option>
												<option>Gifts</option>
												<option>Birthday</option>
												<option>Aniversary</option>
												<option>Symphathy</option>
												<option>Weddings</option>
												<option>Mother's Day</option>
											</select>
											<br>
											<br>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<button type="button" id="itemAdd" onClick="itemAdd()">Add</button>
										</div>
									</div>
								</div>
								<div class="col-3" style="padding: 0px;">
									<div class="img">
										<img id="blah" alt="Recommended 700 x 700" style="height: 205px;">
									</div>
									<br>
									<input type="file" style="outline: none;border:1px solid;width: 80%;cursor: pointer;" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" name="addImg" id="fileVal">
								</div>
							</div>
						<!--</form>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4>Logout <i class="fa fa-lock"></i></h4>
				</div>
				<div class="modal-body">
					</i> Are you sure you want to log-off?
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-6">
							<button style="float: left;font-size: 12px;width: 100%;background-color:pink;font-weight: bold;color: white" onclick="window.location.href='functions/logout.php?logout'">Logout</button>
						</div>
						<div class="col-6">
							<button style="float: right;font-size: 12px;width: 100%;background-color:pink;font-weight: bold;color: white" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="application/javascript">
	var coll = document.getElementsByClassName( "collapsibles" );
	var i;

	for ( i = 0; i < coll.length; i++ ) {
		coll[ i ].addEventListener( "click", function () {
			this.classList.toggle( "active" );
			var content = this.nextElementSibling;
			if ( content.style.maxHeight ) {
				content.style.maxHeight = null;
			} else {
				content.style.maxHeight = content.scrollHeight + "px";
			}
		} );
	}

	//$( '.file-upload' ).file_upload();

	/*function Succesfully() {
		document.getElementById( 'Succesfully' ).style.display = "block";
		$("#Succesfully").hide(5000);
	}*/

	getuser();

	function getuser() {
		$.ajax( {
			url: 'functions/admin-JS-pHp.php',
			method: "POST",
			data: {
				getuser: 'getuser'
			},
			success: function ( data ) {
				document.getElementById( "ailabel" ).innerHTML = data;
			},
			error: function () {
				alert( 'There was some error performing the AJAX call!' );
			}
		} );
	}
</script>
</html>