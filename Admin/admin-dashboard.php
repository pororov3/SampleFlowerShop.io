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
	<title>Admin | Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<script type="application/javascript" src="js/rbar.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="functions/global-js.js"></script>
	<script type="text/javascript" src="functions/admin-dashboard.js"></script>
</head>

<body onLoad="loadDashboard();">
	<div class="top">
		<div class="row">
			<div class="col-7"> <img src="image/logo.png" alt="logo"> </div>
			<div class="col-4 user">
				<label id="admindashboardlabel"></label>
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
		<button class="collapsibles">User <img src="image/down.png" alt="down"></button>
		<div class="content">
			<button class="collap " onclick="window.location.href='account-setting.php'"> Account Settings</button>
			<button class="collap " onclick="window.location.href='user-log.php'">User Log History</button>
			<button class="collap " onclick="window.location.href='user.php'">User</button>
		</div>
		<button class="collapsibles" data-toggle="modal" data-target=".bs-example-modal-sm">Logout</button>
	</div>
	<div class="dashboard-container">
		<div class="dashboard">
			<div class="row" style="padding-left: 20px">
				<div class="col-md-3">
					<div class="row colls1">
						<h3 id="monEarnings"></h3>
					</div>
					<div class="row colls1">
						<h5>Monthly Earnings</h5>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row colls1">
						<h3 id="delPercentage"></h3>
					</div>
					<div class="row colls1">
						<h5>Delivery</h5>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row colls1">
						<h3 id="pickPercentage"></h3>
					</div>
					<div class="row colls1">
						<h5>Pick-up</h5>
					</div>
				</div>
			</div>
			<br>
			<div class="row" style="padding-left: 20px">
				<div class="col-md-2">
					<div class="row colls1">
						<div class="col-4"> <img src="image/new-user.png" alt="new user"> </div>
						<div class="col-4">
							<h3 id="newCustomer"></h3>
						</div>
					</div>
					<div class="row colls1">
						<h5>New Customer</h5>
					</div>
				</div>
				<div class="col-md-2">
					<div class="row colls1">
						<div class="col-4"> <img src="image/request.png" alt="request"> </div>
						<div class="col-4">
							<h3 id="todaysReq"></h3>
						</div>
					</div>
					<div class="row colls1">
						<h5>Today Request</h5>
					</div>
				</div>
				<div class="col-md-2">
					<div class="row colls1">
						<div class="col-4"> <img src="image/approved.png" alt="approved"> </div>
						<div class="col-4">
							<h3 id="approvedReq"></h3>
						</div>
					</div>
					<div class="row colls1">
						<h5>Approved Request</h5>
					</div>
				</div>
				<div class="col-md-2">
					<div class="row colls1">
						<div class="col-4"> <img src="image/delivery man.png" alt="delivery man"> </div>
						<div class="col-4">
							<h3 id="itemsOnDelivery"></h3>
						</div>
					</div>
					<div class="row colls1">
						<h5>Items On Delivery</h5>
					</div>
				</div>
				<div class="col-md-2">
					<div class="row colls1">
						<div class="col-4"> <img src="image/pick.png" alt="pick"> </div>
						<div class="col-4">
							<h3 id="itemsPickUp"></h3>
						</div>
					</div>
					<div class="row colls1">
						<h5>Items Pick-Up</h5>
					</div>
				</div>
				<div class="col-md-2">
					<div class="row colls1">
						<div class="col-4"> <img src="image/delivered.png" alt="delivered"> </div>
						<div class="col-4">
							<h3 id="deliveredPickedUp"></h3>
						</div>
					</div>
					<div class="row colls1">
						<h5>Delivered / Picked-Up</h5>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12" style="background-color: white">
					<h3 style="font-weight: bold;">Ordering and Reservation</h3>
				</div>
			</div>
			<br>
			<div class="row" style="padding-left: 20px">
				<div class="col-md-3">
					<div class="row colls">
						<div class="col-4"> <img src="image/request.png" alt="request"> </div>
						<div class="col-4">
							<h2 id="orderReq"></h2>
						</div>
					</div>
					<div class="row colls">
						<h4>Order Request</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row colls">
						<div class="col-4"> <img src="image/approved.png" alt="approved"> </div>
						<div class="col-4">
							<h2 id="approvedReqOR"></h2>
						</div>
					</div>
					<div class="row colls">
						<h4>Approved Request</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row colls2">
						<div class="col-4"> <img src="image/request.png" alt="request"> </div>
						<div class="col-4">
							<h2 id="pickUpReq"></h2>
						</div>
					</div>
					<div class="row colls2">
						<h4>Pickup  Request</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row colls2">
						<div class="col-4"> <img src="image/request.png" alt="request"> </div>
						<div class="col-4">
							<h2 id="deliveryReq"></h2>
						</div>
					</div>
					<div class="row colls2">
						<h4>Delivery Request</h4>
					</div>
				</div>
			</div>
			<br>
			<div class="row" style="padding-left: 20px">
				<div class="col-md-3">
					<div class="row colls">
						<div class="col-4"> <img src="image/delivery man.png" alt="delivery man"> </div>
						<div class="col-4">
							<h2 id="onDelivery"></h2>
						</div>
					</div>
					<div class="row colls">
						<h4>On Delivery</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row colls">
						<div class="col-4"> <img src="image/delivered.png" alt="delivered"> </div>
						<div class="col-4">
							<h2 id="delivered"></h2>
						</div>
					</div>
					<div class="row colls">
						<h4>Delivered</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row colls2">
						<div class="col-4"> <img src="image/pick.png" alt="pick"> </div>
						<div class="col-4">
							<h2 id="readyForPickup"></h2>
						</div>
					</div>
					<div class="row colls2">
						<h4>Ready for Pick-up Items</h4>
					</div>
					<div class="row colls2">
						<div class="col-6">
							<h5>Items Due Today</h5>
						</div>
						<div class="col-6">
							<h5>Items Due Tommorow</h5>
						</div>
					</div>
					<div class="row colls2">
						<div class="col-6">
							<label id="duetodayPickup"></label>
						</div>
						<div class="col-6">
							<label id="dueTomPickup"></label>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row colls2">
						<div class="col-4"> <img src="image/ready.png" alt="ready"> </div>
						<div class="col-4">
							<h2 id="readyForDel"></h2>
						</div>
					</div>
					<div class="row colls2">
						<h4>Ready for Delivery Items</h4>
					</div>
					<div class="row colls2">
						<div class="col-6">
							<h5>Items Due Today</h5>
						</div>
						<div class="col-6">
							<h5>Items Due Tommorow</h5>
						</div>
					</div>
					<div class="row colls2">
						<div class="col-6">
							<label id="duetodayDel"></label>
						</div>
						<div class="col-6">
							<label id="dueTomDel"></label>
						</div>
					</div>
					<div class="row colls2">
						<div class="col-6">
							<h5>With Assigned Delivery Man</h5>
						</div>
						<div class="col-6">
							<h5>Without Assigned Delivery Man</h5>
						</div>
					</div>
					<div class="row colls2">
						<div class="col-6">
							<label id="withAssDelMan"></label>
						</div>
						<div class="col-6">
							<label id="withoutAssDelMan"></label>
						</div>
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
	
	getuser();

	function getuser() {
		$.ajax( {
			url: 'functions/admin-JS-pHp.php',
			method: "POST",
			data: {
				getuser: 'getuser'
			},
			success: function ( data ) {
				document.getElementById( "admindashboardlabel" ).innerHTML = data;
			},
			error: function () {
				alert( 'There was some error performing the AJAX call!' );
			}
		} );
	}
	
	loadDashboard();
</script>
</html>