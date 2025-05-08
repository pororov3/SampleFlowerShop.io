<!DOCTYPE html>
<html>
<head>
	<title>Payment Method</title>
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
	<script type="text/javascript" src="./../Admin/js/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="./functions/homeitems.js"></script>
	<script type="text/javascript" src="./functions/client-admin.js"></script>
	<script type="text/javascript" src="./functions/client-account.js"></script>
</head>

<body onLoad="loaduserInfo();headLoad();payOnload();">
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
		<div class="row ceb" style="background-color: white;padding-top: 20px;padding-bottom: 20px;">
			<div class="col-12">
				<center>
					<h4>The System is currently in the state of development as of today<br> we only accepting payment transaction through Cebuana Lhullier.</h4>
				</center>
			</div>
			<div class="col-12">
				<center>
					<img src="image/cbl.jpg" style="width:30%">
				</center>
			</div>
			<div class="col-md-12">
				<center>
					<h4>Follow this Step of Payment</h4>
				</center>
			</div>
			<div class="col-md-12">
				<center>
					<h1 style="font-size: 40px">STEP 1</h1>
				</center>
			</div>
			<div class="col-md-12">
				<center>
					<h4>Go to the nearest Cebuana Lhulier Branch and please put the following details in the form of Cebuana Lhullier,<br> 
			Note: Pay exact amount only to avoid cancelation of request.</h4>
				</center>
			</div>
			<div class="col-md-12">
				<center>
					<h1>Receiver : Beth's Flowershop</h1>
					<h1 id="pay1Amount">Amount: 100.00</h1>
				</center>
			</div>
			<div class="col-md-12">
				<center>
					<h1 style="font-size: 40px">STEP 2</h1>
				</center>
			</div>
			<div class="col-md-12">
				<center>
					<h4>After you pay the exact amount to the details above please fill the form below.</h4>
				</center>
			</div>
			<div class="col-md-12 cebhuana">
				<center>
					<h2>Control No. : <input type="" name="" id="payControlNo"></h2>
					<h2>Sender : <input type="" name="" id="paySender" disabled></h2>
					<h2>Contact : <input type="" name="" id="payContact" disabled></h2>
					<h2>Amount : <input id="pay2Amount" type="" name="" value="0" disabled></h2>
				</center>
			</div>
			<div class="col-md-12">
				<center>
					<h1 style="font-size: 40px">STEP 3</h1>
				</center>
			</div>
			<div class="col-md-12">
				<center>
					<h4>Send to us.</h4>
				</center>
			</div>
			<div class="col-md-12">
				<center>
					<button onclick="sendRequest();">Send Your Order Request</button>
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
/*
	function increaseValue() {
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
	}

	$( function () {
		$( "#datepicker-12" ).datepicker();
		$( "#datepicker-12" ).datepicker( "setDate", "+1" );
	} );*/
</script>
</html>