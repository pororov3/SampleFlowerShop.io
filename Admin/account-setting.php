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
	<script type="text/javascript" src="functions/accountSetting.js"></script>
</head>

<body onLoad="loadinfo()">
	<div class="top">
		<div class="row">
			<div class="col-7"> <img src="image/logo.png" alt="logo"> </div>
			<div class="col-4 user">
				<label id="accountsettinglabel"></label>
			</div>
			<div class="col-1 profile-pic"> <img src="image/profile.png" alt="profile"> </div>
		</div>
	</div>
	<div class="side">
		<button class="collapsibles active-side" onclick="window.location.href='admin-dashboard.php'">Dashboard</button>
		<button class="collapsibles">Ordering <img src="image/down.png" alt="down"></button>
		<div class="content">
			<button class="collap" onclick="window.location.href='order-request.php'">Order Request</button>
			<button class="collap" onclick="window.location.href='approved-order.php'">Approved Order</button>
			<button class="collap" onclick="window.location.href='Ready-for-Delivery.php'">Ready for Deliver</button>
			<button class="collap" onclick="window.location.href='Ready-for-PickUp.php'">Ready for Pickup</button>
			<button class="collap" onclick="window.location.href='On-Delivery.php'">On Delivery</button>
			<button class="collap" onclick="window.location.href='Received-Items.php'">Received</button>
		</div>
		<button class="collapsibles">Items <img src="image/down.png" alt="down"></button>
		<div class="content">
			<button class="collap " onclick="window.location.href='Add-Item.php'">Add New Items</button>
			<button class="collap" onclick="window.location.href='Items.php'">Items</button>
		</div>
		<button class="collapsibles">Report <img src="image/down.png" alt="down"></button>
		<div class="content">
			<button class="collap" onclick="window.location.href='Report.php'">Report</button>
			<button class="collap" onclick="window.location.href='transaction-history.php'">Transaction Histroy</button>
		</div>
		<button class="collapsibles" style="background-color: #ff0066">User <img src="image/down.png" alt="down"></button>
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
					<div class="order-reserve" style="padding: 20px;">
						<div class="alert alert-success" id="account-updated" style="display:none" role="alert"> Succesfully updated! </div>
						<div class="row">
							<div class="col-6 account-setting" style="padding: 20px;">
								<div class="row">
									<div class="col-4">
										<label>Name:</label>
									</div>
									<div class="col-8">
										<label id="L_Name"></label>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>Position:</label>
									</div>
									<div class="col-8">
										<label id="L_Pos"></label>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>User Type:</label>
									</div>
									<div class="col-8">
										<label id="L_Type"></label>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>User ID</label>
									</div>
									<div class="col-8">
										<label id="L_ID"></label>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>Username:</label>
									</div>
									<div class="col-8">
										<label id="L_Username"></label>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>Password</label>
									</div>
									<div class="col-8">
										<label id="L_Pass"></label>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>Contact</label>
									</div>
									<div class="col-8">
										<label id="L_Contact"></label>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>User since</label>
									</div>
									<div class="col-8">
										<label id="L_UserSince"></label>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-3">
										<button id="button-update" onclick="updateform()">Update</button>
									</div>
								</div>
							</div>
							<div class="col-6 account-setting" id="update-form" style="padding: 20px;background-color: pink;display: none;">
								<h4>Update Account</h4>
								<br>
								<div class="row">
									<div class="col-4">
										<label>Name:</label>
									</div>
									<div class="col-8">
										<input type="" name="upName" id="upName">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>Username:</label>
									</div>
									<div class="col-6">
										<input type="" name="upUsername" id="upUsername">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>Password:</label>
									</div>
									<div class="col-6">
										<input type="Password" name="Password" id="myInput">
									</div>
									<div class="col-1">
										<input class="ps" style="margin-left: -100px;" type="checkbox" onclick="myFunction()">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>Re-type Password:</label>
									</div>
									<div class="col-6">
										<input type="Password" name="upPass" id="reMyInput">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-4">
										<label>Contact:</label>
									</div>
									<div class="col-6">
										<input type="text" name="upContact" id="upContact">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-3">
										<button id="save" type="button" data-toggle="modal" data-target="#exampleModalCenter">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<div class="modal-body">
					<h4 style="color: grey">Save Changes?</h4>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" id="close-confirm">Close</button>
					<button type="button" data-dismiss="modal" id="save-confirm">Save</button>
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
				<div class="modal-body"> <i> Are you sure you want to log-off?</i> </div>
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

	function myFunction() {
		var x = document.getElementById( "myInput" );
		if ( x.type === "password" ) {
			x.type = "text";
		} else {
			x.type = "password";
		}
		var x = document.getElementById( "reMyInput" );
		if ( x.type === "password" ) {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}

	function updateform() {
		document.getElementById( 'update-form' ).style.display = "block";
		document.getElementById( 'account-updated' ).style.display = "none";
		document.getElementById( 'button-update' ).style.display = "none";
	}

	function update() {
		document.getElementById( 'account-updated' ).style.display = "block";
		document.getElementById( 'update-form' ).style.display = "none";
		document.getElementById( 'button-update' ).style.display = "block";
		//hide delay
		$( "#account-updated" ).fadeOut( 5000 );
		//end hide
	}
</script>
<script type="text/javascript">
	getuser();

	function getuser() {
		$.ajax( {
			url: 'functions/admin-JS-pHp.php',
			method: "POST",
			data: {
				getuser: 'getuser'
			},
			success: function ( data ) {
				document.getElementById( "accountsettinglabel" ).innerHTML = data;
			},
			error: function () {
				alert( 'There was some error performing the AJAX call!' );
			}
		} );
	}
	
	$( "#save-confirm" ).click( function () {
		saveconfirmbtn();
	} );
</script>
</html>