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
	<title>Items</title>
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

<body onLoad="loadItem()">
	<div class="top">
		<div class="row">
			<div class="col-7">
				<img src="image/logo.png">
			</div>
			<div class="col-4 user">
				<label id="ilabel"></label>
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
						<div class="alert alert-success" id="Updated" style="display: none;" role="alert">
							Succesfully Updated
						</div>
						<div class="filter-by">
							<input type="" name="" placeholder="Search...">
							<button>Search</button>
							<select>
								<option disabled selected>Filter By Name:</option>
								<option>A-Z</option>
								<option>Z-A</option>
							</select>
							<select>
								<option disabled selected>Filter By Price:</option>
								<option>High to Low</option>
								<option>Low to High</option>
							</select>
						</div>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Image</th>
									<th>Code</th>
									<th>Item</th>
									<th>Occasion</th>
									<th>Price</th>
									<!--<th>Edit</th> Temporaryliy Disabled-->
								</tr>
							</thead>
							<tbody id="insertItem">
								<!--<tr id="stats">
						      	<td><img src="image/Tulips.jpg" height="100px" width="100px"></td>
						      	<td>Code</td>
						       	<td>Bouquet</td>
						       	<td>B111</td>
						       	<td>Php 200.00</td>
						       	<td>
						       		<button type="button"  data-toggle="modal" data-target="#exampleModal">Update</button><br><br>
						       		<label class="switch">
										<input type="checkbox" checked id="activate" onclick="activate()">
										<span class="slider round"></span>
									</label>
									<br>
									<label id="active" style="color: green">Enable</label>
									<label id="inactive" style="display: none;color: red">Disable</label>
						       	</td>
						      </tr>-->
							</tbody>
						</table>
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
				
					<h5>Update Item</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-6">
							<div class="row">
								<div class="col-3">Item Name</div>
								<div class="col-9"><input type="" name="" style="width: 100%">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-3">Item Price</div>
								<div class="col-9"><input type="" name="" style="width: 100%">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-3">Occasion</div>
								<div class="col-9">
									<select style="padding: 2px;width: 100%">
										<option>Valentines</option>
										<option>Gifts</option>
										<option>Birthday</option>
										<option>Aniversary</option>
										<option>Symphathy</option>
										<option>Weddings</option>
										<option>Mother's Day</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-3">Item Details</div>
								<div class="col-9">
									<textarea style="width: 100%;height: 100px;"></textarea>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="img">
								<img id="blah" alt="Recommended 768px x 768px" style="width: 262px;height: 205px;">
							</div>
							<br>
							<input type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal">Close</button>
					<button type="button" onclick="Updated()" data-dismiss="modal">Update</button>
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

	var loadFile = function ( event ) {
		var output = document.getElementById( 'output' );
		output.src = URL.createObjectURL( event.target.files[ 0 ] );
	};


	function Updated() {
		document.getElementById( 'Updated' ).style.display = "block";
	}

	function activate() {
		if ( document.getElementById( 'activate' ).checked == true ) {
			document.getElementById( 'inactive' ).style.display = "none";
			document.getElementById( 'active' ).style.display = "block";
			document.getElementById( 'stats' ).style.color = "black";
		} else {
			document.getElementById( 'inactive' ).style.display = "block";
			document.getElementById( 'active' ).style.display = "none";
			document.getElementById( 'stats' ).style.color = "red";
		}

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
				document.getElementById( "ilabel" ).innerHTML = data;
			},
			error: function () {
				alert( 'There was some error performing the AJAX call!' );
			}
		} );
	}
</script>
</html>