<!DOCTYPE html>
<html>
<head>
	<title>Dashboard-Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="image/title-logo.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="./../Admin/js/jquery-3.4.1.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="./functions/homeitems.js"></script>
	<script type="text/javascript" src="./functions/client-account.js"></script>
	<script type="text/javascript" src="./functions/client-admin.js"></script>
</head>
<style type="text/css">
	.header {
		background-image: url('image/hydrangeas.jpg');
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
					<h4>Manage Profile</h4>
				</center>
				<label id="mpName">Name : </label><br>
				<label id="mpAddress">Billing Address : </label><br>
				<label id="mpUserName">Username : </label><br><br>
				<label> *Change Password*</label><br>
				<label> Current Password: </label><input type="Password" name="" placeholder="Enter Current Password" class="mpChangePass"><br>
				<label> New Password: </label><input type="Password" name="" placeholder="Enter New Password" class="mpChangePass"><br>
				<label> Re-type New Password: </label><input type="Password" name="" placeholder="Re-Enter New Password" class="mpChangePass"><br><br>
				<button>Save Changes</button>
				<button onClick="clLogout();">Log-Out</button>

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
</script>
</html>