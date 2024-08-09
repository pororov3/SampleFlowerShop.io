<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="image/title-logo.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="./../Admin/js/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="./functions/homeitems.js"></script>
	<script type="text/javascript" src="./functions/client-account.js"></script>
	<script type="text/javascript" src="./functions/client-admin.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<style type="text/css">
	/*.header {
		background-image: url('image/hydrangeas.jpg');
	}*/
	
	#myModalOA,
	#myModalOR,
	#myModalOD,
	#myModalR {
		display: none;
		z-index: 2;
		position: absolute;
		top: 0;
		left: 0;
		max-width: 100%;
		max-height: 100%;
	}
	
	.modal-header {
		padding: 2px 5px;
		background-color: #F7CFF5;
		color: white;
	}
	
	.modal-content h2 {
		margin: auto;
		padding: 5px 0px;
	}
	/* Modal Body */
	
	.modal-body {
		padding: 2px 10px;
		overflow: auto;
		max-height: 180px;
		width: max-content;
	}
	/* Modal Footer */
	
	.modal-footer {
		padding: 5px 16px;
		background-color: #F7CFF5;
		color: white;
	}
	/* Modal Content */
	
	.modal-content {
		position: relative;
		background-color: #fefefe;
		margin: auto;
		padding: 0;
		border: 1px solid #888;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		animation-name: animatetop;
		animation-duration: 0.4s;
		margin: 0px 10px;
		width: max-content;
		scroll-behavior: smooth;
	}
	/* Add Animation */
	
	@keyframes animatetop {
		from {
			top: -300px;
			opacity: 0
		}
		to {
			top: 0;
			opacity: 1
		}
	}
	
	th,
	td {
		border-bottom: 1px solid #ddd;
		padding-left: 17px;
		padding-right: 17px;
		text-align: center;
	}
</style>

<body onLoad="headLoad();loaduserInfo();">
	<div class="row top-nav">
		<div class="col-12 nav">
			<span class="open-nav" onclick="openNav()">&#9776;</span>
			<img src="image/logo.jpg" class="logo">

			<img src="image/logo-res.png" class="font-logo">

			<div class="dropdown">
				<a href="home.php">Products</a>
			</div>
			<div class="dropdown">
				<a href="contact.php">Contact</a>
			</div>
			<div class="dropdown">
				<a href="location.php">Location</a>
			</div>
			<div class="dropdown">
				<a href="about.php">About</a>
			</div>
			<div class="dropdown">
				<a href="login.php">Login</a>
			</div>
			<div class="dropdown">
				<a href="register.php">Register</a>
			</div>
			<div class="dropdown">
				<a href="dashboard.php">Dashboard</a>
			</div>
			<div class="dropdown cart">
				<button onclick="window.location.href='product.php'" class="dropbtn">
						<img class="cart-pic" src="image/cart.png">
						<label class="item-number">PHP:0.00 &nbsp;&nbsp;</label>
					</button>
			

			</div>
		</div>
	</div>
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="dashboard.php">Dashoard</a>
		<a href="home.php">Products</a>
		<a href="">Contact</a>
		<a href="location.php">Location</a>
		<a href="">About us</a>
		<a href="login.php">Login</a>
		<a href="register.php">Register</a>
	</div>

	<div class="product-section">
		<div class="row rp" style="background-color: white;padding-top: 20px;padding-bottom: 20px;border-radius: 20px;">
			<div class="col-md-4 ">
				<center>
					<img src="image/login-icon.png">

					<h2 class="dashActiveUser"></h2>
				</center>
				<div class="col-md-12">
					<ul>
						<li><a href="dashboard.php">Dashboard</a>
						</li>
						<li><a href="recent.php">Recent Trancsaction</a>
						</li>
						<li><a href="manage-profile.php">Manage Profile</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-8" style="border-left:5px solid;border-color: grey;font-weight: bold;">
				<center>

					<!--https://www.w3schools.com/howto/howto_css_modals.asp-->
					<!-- Modal -->
					<h2 type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalOA" onClick="modalOA();">Order Aproved / Pending</h2>
					<div class="container">

						<!-- Button to Open the Modal -->
						<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Order Aproved</button>-->

						<!-- The Modal -->
						<div class="modal" id="myModalOA">
							<div class="modal-dialog modal-dialog-scrollable">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h2 class="modal-title">Order Aproved / Pending</h2>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										<table class="table table-sm" id="printTable">
											<thead>
												<tr>
													<th>Order#</th>
													<th>Order Type</th>
													<th>Items</th>
													<th>Quantity</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody id="insertModalApprovedOrder"></tbody>
										</table>
									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>

								</div>
							</div>
						</div>

					</div>
					<!--End Modal-->

					<!--<h2>Order Ready</h2>-->
					<!-- Modal -->
					<h2 type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalOR" onClick="modalOR();">Order Ready</h2>


					<div class="container">

						<!-- Button to Open the Modal -->
						<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Order Aproved</button>-->

						<!-- The Modal -->
						<div class="modal" id="myModalOR">
							<div class="modal-dialog modal-dialog-scrollable">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h2 class="modal-title">Order Ready</h2>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										<table class="table table-sm" id="printTable">
											<thead>
												<tr>
													<th>Order#</th>
													<th>Order Type</th>
													<th>Items</th>
													<th>Quantity</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody id="insertModalOrderReady"></tbody>
										</table>
									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>

								</div>
							</div>
						</div>

					</div>
					<!--End Modal-->

					<!--<h2>On Pickup/ On Delivery</h2>-->
					<!-- Modal -->
					<h2 type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalOD" onClick="modalOD();">On Delivery</h2>
					<div class="container">

						<!-- Button to Open the Modal -->
						<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Order Aproved</button>-->

						<!-- The Modal -->
						<div class="modal" id="myModalOD">
							<div class="modal-dialog modal-dialog-scrollable">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h2 class="modal-title">On Delivery</h2>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										<table class="table table-sm" id="printTable">
											<thead>
												<tr>
													<th>Order#</th>
													<th>Order Type</th>
													<th>Items</th>
													<th>Quantity</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody id="insertModalOnDelivery"></tbody>
										</table>
									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>

								</div>
							</div>
						</div>

					</div>
					<!--End Modal-->

					<!--<h2>Received</h2>-->
					<!-- Modal -->
					<h2 type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalR" onClick="modalReceived();">Received</h2>
					<div class="container">

						<!-- Button to Open the Modal -->
						<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Order Aproved</button>-->

						<!-- The Modal -->
						<div class="modal" id="myModalR">
							<div class="modal-dialog modal-dialog-scrollable">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h2 class="modal-title">Received</h2>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										<table class="table table-sm" id="printTable">
											<thead>
												<tr>
													<th>Order#</th>
													<th>Order Type</th>
													<th>Items</th>
													<th>Quantity</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody id="insertModalReceived"></tbody>
										</table>
									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>

								</div>
							</div>
						</div>

					</div>
					<!--End Modal-->
				</center>
			</div>
		</div>
	</div>
	<footer>
		<div class="row">

			<div class="col-sm-2">
				<h3>Customer Care</h3>
				<a href="">Terms and Condition</a><br>
				<a href="">Privacy and Policy</a><br>
				<a href="">Payment Method</a><br>
			</div>
			<div class="col-sm-3">
				<h2>
					<font face="Myriad Pro">Beth's Flower Shop</font>
				</h2>
				<p>
					EDMC Stall #2 cor. 2nd St. 11th Ave.<br> Gracepark, Caloocan City
				</p>
			</div>
			<div class="col-sm-3">
				<br>
				<br>
				<br> Copyright © 2020 bethsflowershop Ph
			</div>
			<div class="col-sm-2">
				<img src="image/facebook.png" height="10px"> &nbsp;
				<br>
				<a href="">Like Us on Facebook</a>
			</div>
			<div class="col-sm-2">
				<img src="image/phone.png" height="10px">
				<br> Call Us: +63 906-642-3230
			</div>

		</div>
	</footer>
</body>
<script type="text/javascript">
	/* When the user clicks on the button, toggle between hiding and showing the dropdown content */
	function myFunction() {
		document.getElementById( "myDropdown" ).classList.toggle( "show" );
	}

	// Close the dropdown if the user clicks outside of it
	window.onclick = function ( event ) {
			if ( !event.target.matches( '.dropbtn' ) ) {
				var dropdowns = document.getElementsByClassName( "dropdown-content" );
				var i;
				for ( i = 0; i < dropdowns.length; i++ ) {
					var openDropdown = dropdowns[ i ];
					if ( openDropdown.classList.contains( 'show' ) ) {
						openDropdown.classList.remove( 'show' );
					}
				}
			}
		}
		//sidenav
	function viewcart() {
		document.getElementById( 'cart-view' ).style.display = "block";
		document.getElementById( 'Added' ).style.display = "block";
	}

	function openNav() {
		document.getElementById( "mySidenav" ).style.width = "25%";
	}

	function closeNav() {
		document.getElementById( "mySidenav" ).style.width = "0";
	}


	/*function increaseValue() {
		var value = parseInt( document.getElementById( 'number' ).value, 10 );
		value = isNaN( value ) ? 1 : value;
		value++;
		document.getElementById( 'number' ).value = value;
	}

	function decreaseValue() {
		var value = parseInt( document.getElementById( 'number' ).value, 10 );
		value = isNaN( value ) ? 1 : value;
		value < 1 ? value = 1 : '';
		value--;
		document.getElementById( 'number' ).value = value;
	}*/

	//Modal on Dashboard
	// Get the modal
	/*var modal = document.getElementById( "myModal" );

	// Get the button that opens the modal
	var btn = document.getElementById( "myBtn" );

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName( "close" )[ 0 ];

	// When the user clicks on the button, open the modal
	btn.onclick = function () {
		modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function () {
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function ( event ) {
			if ( event.target == modal ) {
				modal.style.display = "none";
			}
		}*/
	//Modal on Dashboard
</script>
</html>