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
	<title>User</title>
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

<body>
	<div class="top">
		<div class="row">
			<div class="col-7">
				<img src="image/logo.png">
			</div>
			<div class="col-4 user">
				<label id="userlabel"></label>
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
		<button class="collapsibles">Items <img src="image/down.png"></button>
		<div class="content">
			<button class="collap " onclick="window.location.href='Add-Item.php'">Add New Items</button>
			<button class="collap" onclick="window.location.href='Items.php'">Items</button>
		</div>
		<button class="collapsibles">Report <img src="image/down.png"></button>
		<div class="content">
			<button class="collap" onclick="window.location.href='Report.php'">Report</button>
			<button class="collap" onclick="window.location.href='transaction-history.php'">Transaction Histroy</button>
		</div>
		<button class="collapsibles" style="background-color: #ff0066">User <img src="image/down.png"></button>
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
						<h4>User</h4>
						<div class="alert alert-success" id="succesfully-add-user" style="display: none;" role="alert">
							User Succesfully Added!
						</div>
						<div class="alert alert-danger" id="user-deactivated" style="display: none;" role="alert">
							User # **** is Deactivated!
						</div>
						<div class="row">
							<div class="col-2">
								<label>User Type</label>
								<br>
								<select class="type-generate" style="width: 100%;padding: 6px;font-size:14px;border-radius: 4px;border-color: grey;outline: none;" id="uUserType">
									<option>All</option>
									<option>User</option>
									<option>Admin</option>
									<option>Super Admin</option>
								</select>
							</div>
							<div class="col-2">
								<label>Account Status</label>
								<br>
								<select class="type-generate" style="width: 100%;padding: 6px;font-size:14px;border-radius: 4px;border-color: grey;outline: none;" id="uStatus">
									<option>All</option>
									<option>Active</option>
									<option>Inactive</option>
								</select>
							</div>
							<div class="col-4">
								<label>Search</label><br>
								<input class="search-input" type="" name="" placeholder="Search.." style="" id="uSearchtxt">
								<button class="search-button" style=""><img src="image/search.png" height="20px" id="usearch"></button>
							</div>
							<div class="col-2">
								<button type="button" data-toggle="modal" data-target="#exampleModal" style="padding: 3px;font-size: 12px;color: white;background-color:blue;float: right;">Add New User <img src="image/add-new-user.png" height="20px"></button>
							</div>
						</div>
						<div id="report">
							<br>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Username</th>
										<th>User Type</th>
										<th>Contact</th>
										<th>User Since</th>
										<th>Account Status</th>
										<th>Activate</th>
									</tr>
								</thead>
								<tbody id="tableDesti">
									<!--<tr id="1">
										<td>01</td>
										<td>John Matibay</td>
										<td>john23</td>
										<td>Staff</td>
										<td>09223209932</td>
										<td>08-28-2020</td>
										<td><label id="active" style="color: green">Active</label><label id="inactive" style="display: none;color: red">Inactive</label>
										</td>
										<td>
											<label class="switch">
												  <input type="checkbox" checked id="activate" onclick="activate()">
												  <span class="slider round"></span>
											</label>
										</td>
									</tr>-->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
				







					<h5>Add New User</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-2">
							<label>Name</label>
						</div>
						<div class="col-4">
							<input type="text" name="name" id="add-name" style="width: 100%;padding: 2px;">
						</div>
						<div class="col-2">
							<label>Position</label>
						</div>
						<div class="col-4">
							<select style="width: 100%;padding: 2px;font-size: 12px;" id="add-pos">
								<option>Delivery Man</option>
								<option>Staff</option>
								<option>Manager</option>
							</select>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-2">
							<label>User Type</label>
						</div>
						<div class="col-4">
							<select style="width: 100%;padding: 2px;font-size: 12px;" id="add-type">
								<option>User</option>
								<option>Admin</option>
								<option>Super Admin</option>
							</select>
						</div>
						<div class="col-2">
							<label>Contact</label>
						</div>
						<div class="col-4">
							<input type="text" name="contact" id="add-contact" style="width: 100%;padding: 2px;">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-2">
							<label>Username</label>
						</div>
						<div class="col-4">
							<input type="text" name="username" id="add-uname" style="width: 100%;padding: 2px;">
						</div>
						<div class="col-2">
							<label>Password</label>
						</div>
						<div class="col-4">
							<input type="Password" name="password" id="add-pass" style="width: 100%;padding: 2px;">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" id="close-modal">Close</button>
					<button type="button" id="add-user">Add User</button>
					<!--onclick="adduser()"-->
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

	function adduser() {
		document.getElementById( 'succesfully-add-user' ).style.display = "block";
		//hide delay
		$( "#succesfully-add-user" ).hide( 5000 );
		//end hide
	}

	function urowClick( id ) {
		var res = id.split( "_", 2 );
		if ( document.getElementById( 'activate_' + res[ 1 ] ).checked == true ) {
			document.getElementById( 'inactive_' + res[ 1 ] ).style.display = "none";
			document.getElementById( 'active_' + res[ 1 ] ).style.display = "block";
			document.getElementById( "user-deactivated" ).style.display = "none";
			$.ajax( {
				url: 'functions/accountSetting.php',
				method: "POST",
				data: {
					action: 'userActive',
					status: 'Active',
					id: res[ 1 ]
				},
				success: function ( data ) {
					console.log( data );
					logger( "User ID: " + res[ 1 ] + " was activated!" );
				},
				error: function () {
					alert( 'There was some error performing the AJAX call!' );
				}
			} );
		} else {
			document.getElementById( 'inactive_' + res[ 1 ] ).style.display = "block";
			document.getElementById( 'active_' + res[ 1 ] ).style.display = "none";
			document.getElementById( "user-deactivated" ).style.display = "block";
			document.getElementById( "user-deactivated" ).innerHTML = "User ID: " + res[ 1 ] + " was deactivated!";
			//hide delay
			$( "#user-deactivated" ).hide( 5000 );
			//end hide
			$.ajax( {
				url: 'functions/accountSetting.php',
				method: "POST",
				data: {
					action: 'userActive',
					status: 'Inactive',
					id: res[ 1 ]
				},
				success: function ( data ) {
					console.log( data );
					logger( "User ID: " + res[ 1 ] + " was deactivated!" );
				},
				error: function () {
					alert( 'There was some error performing the AJAX call!' );
				}
			} );
		}
	}

	function logger( acts ) {
		$.ajax( {
			url: 'functions/admin-JS-pHp.php',
			method: "POST",
			data: {
				logger: 'log',
				logAction: acts
			},
			success: function ( data ) {},
			error: function () {
				alert( 'There was some error performing the AJAX call!' );
			}
		} );
	}

	getuser();

	function getuser() {
		$.ajax( {
			url: 'functions/admin-JS-pHp.php',
			method: "POST",
			data: {
				getuser: 'getuser'
			},
			success: function ( data ) {
				document.getElementById( "userlabel" ).innerHTML = data;
			},
			error: function () {
				alert( 'There was some error performing the AJAX call!' );
			}
		} );
	}
	
	$( "#usearch" ).click( function () {
		alert( "Searching..." );
		loadUserTable();
	} );

	$( "#add-user" ).click( function () {
		adduserbtn();
	} );
	
</script>
</html>