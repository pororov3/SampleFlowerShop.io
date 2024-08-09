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
	<title>Order Request</title>
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

<body onLoad="orderrequestload()">
	<div class="top">
		<div class="row">
			<div class="col-7">
				<img src="image/logo.png">
			</div>
			<div class="col-4 user">
				<label id="orderrequestlabel"></label>
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
						<h4>Order Request</h4>
						<div class="alert alert-success" id="success" style="display: none;" role="alert">
							Order# 102919291 Succesfully approve. You can check it at Approved Module
						</div>
						<div class="alert alert-danger" id="cancel" style="display: none;" role="alert">
							Order# 102919291 has been cancelled
						</div>
						<div class="filter-by">
							<input type="" name="" placeholder="Search..." id="orSearch">
							<button id="orSearchBtn" onClick="orSearchBtn()">Search</button>
							<select>
								<option disabled selected>Filter By Date:</option>
								<option>New</option>
								<option>Old</option>
							</select>
							<button style="float: right;" type="button" value="Print Table" onclick="myApp.printTable()"><img src="image/print.png" height="20px"> Print Tables</button>
						</div>
						<table class="table table-bordered" id="printTable">
							<thead>
								<tr>
									<th>Order#</th>
									<th>Type</th>
									<th>Request Date</th>
									<th>Costumer Name</th>
									<th>Items</th>
									<th>Quantity</th>
									<th>Items Amount</th>
									<th>Payment Method</th>
									<th>Reference No./Control No./ Account No.</th>
									<th>Amount</th>
									<th>Contact</th>
									<th>Date</th>
									<th>Accept Request</th>
								</tr>
							</thead>
							<tbody id="insertorderrequest">
								<!--<tr>
						       	<td>0001</td>
						       	<td>Pick-Up</td>
						       	<td>March 10 2020</td>
						       	<td>Jun Santos</td>
						       	<td>Tulips</td>
						       	<td>1</td>
						       	<td>200.00</td>
						       	<td>Cebhuana Lhulier</td>
						       	<td>093k45802j9</td>
						       	<td>200.00</td>
						       	<td>0987-898-8989</td>
						       	<td>March 09 2020</td>
						       	<td>
<button type="button" data-toggle="modal" onclick="showSuccess()" data-target="#exampleModalLong">Accept</button>
<button type="button" data-toggle="modal" data-target="#exampleModal">Cancel</button>
						       	</td>
						      </tr>-->
								<div style="display: none;" id="idStorage"></div>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Button trigger modal -->
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
				






					<h5>Cancelation Reason</h5>
				</div>
				<div class="modal-body">
					<label>Customer Name:</label> 1299
					<br>
					<br>
					<textarea id="textCancel" style="width: 100%;height: 50px;resize: none;">Hi " " your order has been cancel because of the following reason *Out of Stock *Payment 
	      	  </textarea>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" id="orClose">Close</button>
					<button type="button" onclick="showCancel()">Send Cancelation Reason Update</button>
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
				document.getElementById( "orderrequestlabel" ).innerHTML = data;
			},
			error: function () {
				alert( 'There was some error performing the AJAX call!' );
			}
		} );
	}
	
</script>
</html>