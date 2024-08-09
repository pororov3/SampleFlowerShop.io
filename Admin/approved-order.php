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
	<title>Approved Order</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="functions/ordering-process.js"></script>
</head>

<body onLoad="approvedorderload()">
	<div class="top">
		<div class="row">
			<div class="col-7">
				<img src="image/logo.png">
			</div>
			<div class="col-4 user">
				<label id="aolabel"></label>
			</div>
			<div class="col-1 profile-pic">
				<img src="image/profile.png">
			</div>
		</div>
	</div>
	<div class="side">
		<button class="collapsibles active-side" onclick="window.location.href='admin-dashboard.php'">Dashboard</button>
		<button class="collapsibles" style="background-color: #ff0066">Ordering <img src="image/down.png"></button>
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
						<h4>Approved Order</h4>
						<div class="alert alert-success" id="ready" style="display: none;" role="alert">
							Order# 102919291 is ready for Delivery or Pickup
						</div>
						<div class="filter-by">
							<input type="" name="" placeholder="Search..." id="oaSearch">
							<button id="oaSearchBtn" onClick="oaSearchBtn()">Search</button>
							<select>
								<option disabled selected>Filter By Date:</option>
								<option>New</option>
								<option>Old</option>
							</select>
							<select>
								<option disabled selected>Filter By Type:</option>
								<option>Delivery</option>
								<option>Pickup</option>
							</select>
							<button style="float: right;" type="button" value="Print Table" onclick="myApp.printTable()"><img src="image/print.png" height="20px"> Print Tables</button>
						</div>
						<table class="table table-bordered" id="printTable">
							<thead>
								<tr>
									<th>Order#</th>
									<th>Order Type</th>
									<th>Costumer Name</th>
									<th>Items</th>
									<th>Quantity</th>
									<th>Update Status</th>
								</tr>
							</thead>
							<tbody id="insertApprovedOrder">
								<!--<tr>
						       	<td>058341</td>
						       	<td>Pick-up</td>
						       	<td>Jun Santos</td>
						       	<td>Tulips</td>
						       	<td>1</td>
						       	<td>
						       		<button onclick="showReady()">Ready</button>
						       	</td>
						      </tr>-->
							</tbody>
						</table>
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

	var myApp = new function () {
		this.printTable = function () {
			var tab = document.getElementById( 'printTable' );
			var win = window.open( '', '', 'height=600,width=900' );
			win.document.write( tab.outerHTML );
			win.document.close();
			win.print();
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
				document.getElementById( "aolabel" ).innerHTML = data;
			},
			error: function () {
				alert( 'There was some error performing the AJAX call!' );
			}
		} );
	}
</script>
</html>