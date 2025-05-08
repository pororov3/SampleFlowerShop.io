<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="image/title-logo.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!--<script type="text/javascript" src="./Admin/js/jquery-3.4.1.js"></script>-->
	<script type="text/javascript" src="./functions/homeitems.js"></script>
	<script type="text/javascript" src="./functions/client-account.js"></script>
</head>

<body onLoad="headLoad();loadItemCart();cartCalculator();loaduserInfo();">
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
		<div class="row" style="background-color: white;padding-top: 20px;padding-bottom: 20px;">
			<div class="col-md-8" id="cartInsert">
				<!--<div class="row" style="padding: 10px;border:2px solid;border-color: #bfbfbf;">
					<div class="row">
						<div class="col-md-6">
							<img src="image/Tulips.jpg" style="width:100%">
						</div>
						<div class="col-md-6">
							<div class="row divs">
								<div class="col-md-6">
									<label>Item:</label>
								</div>
								<div class="col-md-6">
									<label>Tulips</label>
								</div>
							</div>
							<div class="row divs">
								<div class="col-md-6">
									<label>Price:</label>
								</div>
								<div class="col-md-6">
									<label>200.00</label>
								</div>
							</div>
							<div class="row divs">
								<div class="col-md-6">
									<label>Details:</label>
								</div>
								<div class="col-md-6">
									<label>(...)</label>
								</div>
							</div>
							<div class="row divs">
								<div class="col-md-6">
									Quantity:
								</div>
								<div class="col-md-6">
									<button id="decrease" style="width: 20px;color: blue" onclick="decreaseValue()" value="Decrease Value">-</button>
									<input class="input" type="number" id="number" value="1"/>
									<button id="increase" style="width: 20px;color: blue" onclick="increaseValue()" value="Increase Value">+</button>
								</div>
							</div>
							<br>
							<br>
							<div class="row divs">
								<div class="col-md-6">

								</div>
								<div class="col-md-6">
									<button>Delete Order</button>
								</div>

							</div>
						</div>
					</div>
				</div>-->
				<br>
			</div>
			<div class="col-md-4 total-payment-add-to-cart">
				<h3>Order Summary</h3>
				<div class="row">
					<div class="col-md-8">
						<label id="subTotal">Subtotal (0 items)</label>
					</div>
					<div class="col-md-4">
						<label id="itemTotal">₱ 0.00</label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8">
						<label>Delivery Fee</label>
					</div>
					<div class="col-md-4">
						<label id="delFee">₱ 0.00</label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">
						Enter Date:
					</div>
					<div class="col-md-6">
						<input style="width: 100%" type="text" id="datepicker-12">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<center>
							<label><input class="OrderType" name="myRadio" type="radio" value="Pick-Up" onClick="cartCalculator();headLoad();" />Pick-Up</label>
							<label><input class="OrderType" name="myRadio" type="radio" value="Delivery" onClick="cartCalculator();headLoad();" checked />Delivery</label>
						</center>
					</div>
				</div>
				<br>
				<div class="row total-form">
					<div class="col-md-8">
						<label>Total</label>
					</div>
					<div class="col-md-4">
						<label id="Total">₱ 0.00</label>
					</div>
				</div>
				<br>
				<center>
					<button class="proceed-button" onclick="toPayment();">
					Proceed to Payment
				</button>
				



					<button class="proceed-button" onclick="clearCart()">
					Clear items on Cart
				</button>
				





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
	/* When the user clicks on the button, 
						toggle between hiding and showing the dropdown content */
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
	function openNav() {
		document.getElementById( "mySidenav" ).style.width = "25%";
	}

	function closeNav() {
		document.getElementById( "mySidenav" ).style.width = "0";
	}

	function increaseValue( itemNumber ) {
		var value = parseInt( document.getElementById( 'number_' + itemNumber ).value, 10 );
		value = isNaN( value ) ? value == 0 ? 1 : value : value;
		value++;
		document.getElementById( 'number_' + itemNumber ).value = value;
		localStorage.setItem( "itemQty_" + itemNumber, document.getElementById( 'number_' + itemNumber ).value );
	}

	function decreaseValue( itemNumber ) {
		var value = parseInt( document.getElementById( 'number_' + itemNumber ).value, 10 );
		value = isNaN( value ) ? value == 0 ? 1 : value : value;
		value < 1 ? value = 1 : '';
		value--;
		document.getElementById( 'number_' + itemNumber ).value = value;
		localStorage.setItem( "itemQty_" + itemNumber, document.getElementById( 'number_' + itemNumber ).value );
	}

	$( function () {
		$( "#datepicker-12" ).datepicker();
		$( "#datepicker-12" ).datepicker( "setDate", "+1" );
	} );
</script>
</html>