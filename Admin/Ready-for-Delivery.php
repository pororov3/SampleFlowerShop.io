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
	<title>Ready for Deliver</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="functions/ordering-process.js"></script>
	<!--<script type="text/javascript">require( "functions/ordering-process.js" );</script>-->
</head>

<body onLoad="readyfordelivery()">
	<div class="top">
		<div class="row">
			<div class="col-7">
				<img src="image/logo.png">
			</div>
			<div class="col-4 user">
				<label id="rdlabel"></label>
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
						<h4>Ready for Delivery Items</h4>
						<div class="alert alert-success" style="display: none;" id="assign" role="alert">
							Item(s) Succesfully assign to Andrew Tan to Deliver
						</div>
						<div class="alert alert-danger" style="display: none;" id="no-selected" role="alert">
							No Selected Items
						</div>
						<div class="filter-by">
							<input type="" name="" placeholder="Search..." id="rdSearch">
							<button id="rdSearchBtn" onClick="rdSearchBtn()">Search</button>
							<select>
								<option>All</option>
								<option>With Assign</option>
								<option>No Assign</option>
							</select>
							<select>
								<option disabled selected>Filter By Date:</option>
								<option>New</option>
								<option>Old</option>
							</select>

							<button style="float: right;margin-left: 5px;" type="button" value="Print Table" onclick="myApp.printTable()"><img src="image/print.png" height="20px"> Print Tables</button>

							<button data-toggle="modal" data-target="#exampleModal" type="button" onclick="showAssign();rdManList();" class="delivery-button">Assign Delivery Man <img src="image/delivery man.png" height="18px"></button>
						</div>
						<table class="table table-bordered" id="printTable">
							<thead>
								<tr>
									<th>Order#</th>
									<th>Costumer Name</th>
									<th>Items</th>
									<th>Quantity</th>
									<th>Address</th>
									<th>Contacts</th>
									<th>Date Order</th>
									<th>Date Request to Deliver</th>
									<!--<th> <input id="checkall" type="checkbox" name="" onclick="checkall()">&nbsp; Select All </th>--><!--Temporarily disabled dahil sa mahirap kuning ang multiple trans no at i filter sa del man que-->
									<th>Select</th>
									<th>Item Status</th>
								</tr>
							</thead>
							<tbody id="insertReadyforDelivery">
								<!--<tr>
						       	<td>r304580</td>
						       	<td>Paul San</td>
						       	<td>Bouquet 02</td>
						       	<td>1</td>
						       	<td>29 Mabolo St. Caloocan</td>
						       	<td>09238238</td>
						       	<td>March 09 2020</td>
						       	<td>March 10 2020</td>
						       	<td><input id="checked" type="checkbox" name=""></td>
						       	<td>Assign to Anndrew Tan</td>				
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
				

					<h5>Assign Delivery Man</h5>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Status</th>
								<th>Assign</th>
							</tr>
						</thead>
						<tbody id="insertRDManSelect">
							<!--<tr>
								<td>09</td>
								<td>Andrew Tan</td>
								<td><label style="color: green">Online</label>
								</td>
								<td><input type="radio" name="DelMan"> </td>
							</tr>
							<tr>
								<td>05</td>
								<td>Mike Andres</td>
								<td><label style="color: red">Offline</label>
								</td>
								<td><input type="radio" name="DelMan"> </td>
							</tr>
							<tr>
								<td>03</td>
								<td>John Lewis</td>
								<td><label style="color: green">Online</label>
								</td>
								<td><input type="radio" name="DelMan"> </td>
							</tr>-->
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" id="rdmodaldm">Close</button>
					<button type="button" onclick="assign()">Assign</button>
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
				document.getElementById( "rdlabel" ).innerHTML = data;
			},
			error: function () {
				alert( 'There was some error performing the AJAX call!' );
			}
		} );
	}
</script>
</html>