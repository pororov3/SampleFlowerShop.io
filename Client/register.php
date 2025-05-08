<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="image/title-logo.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="../Admin/js/jquery-3.4.1.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="functions/client-account.js"></script>
	<script type="text/javascript" src="functions/homeitems.js"></script>
</head>

<body onLoad="headLoad();">
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
		<div class="registration">
			<div class="register">
				<div class="row input">
					<div class="col-sm-2"><label>Name</label>
					</div>
					<div class="col-sm-4"><input class="Street input-field" type="" name="" id="clrLName" placeholder="Last Name">
					</div>
					<div class="col-sm-4"><input class="Street input-field" type="" name="" id="clrGName" placeholder="Given Name">
					</div>
					<div class="col-sm-2"><input class="Street input-field" type="" name="" id="clrMI" placeholder="M.I.">
					</div>
				</div>
				<div class="row input">
					<div class="col-sm-2"><label>E-mail</label>
					</div>
					<div class="col-sm-10"><input class="input-field" type="" name="" id="clrEmail" placeholder="E-mail Address">
					</div>
				</div>
				<div class="row input">
					<div class="col-sm-2"><label>Contact</label>
					</div>
					<div class="col-sm-10"><input class="input-field" type="" name="" id="clrContact" placeholder="Phone Number / Telephone">
					</div>
				</div>
				<div class="row input">
					<div class="col-sm-2"><label>Address</label>
					</div>
					<div class="col-sm-4"><input class="input-field" type="" name="" id="clrAddBlock" placeholder="Block no. / House no.">
					</div>
					<div class="col-sm-5"><input class="Street input-field" type="" name="" id="clrAddStreet" placeholder="Street">
					</div>
				</div>
				<div class="row input">
					<div class="col-sm-2"></div>
					<div class="col-sm-10"><input class="input-field" type="" name="" id="clrBrgy" placeholder="Barangay">
					</div>
				</div>
				<div class="row input">
					<div class="col-sm-2"></div>
					<div class="col-sm-4"><input class="input-field" type="" name="" id="clrCity" placeholder="City">
					</div>
					<div class="col-sm-5">
						<select class="input-field" id="clrProvince">
							<option disabled selected hidden>Province</option>
							<option>NCR</option>
							<option>Abra</option>
							<option>Agusan Del Norte</option>
							<option>Agusan Del Sur</option>
							<option>Aklan</option>
							<option>Albay</option>
							<option>Antique</option>
							<option>Apayao</option>
							<option>Aurora</option>
							<option>Basilan</option>
							<option>Bataan</option>
							<option>Batanes</option>
							<option>Batangas</option>
							<option>Benguet</option>
							<option>Biliran</option>
							<option>Bohol</option>
							<option>Bukidnon</option>
							<option>Bulacan</option>
							<option>Cagayan</option>
							<option>Camarines Norte</option>
							<option>Camarines Sur</option>
							<option>Camiguin</option>
							<option>Capiz</option>
							<option>Catanduanes</option>
							<option>Cavite</option>
							<option>Cebu</option>
							<option>Compostella Valley</option>
							<option>Cotabato</option>
							<option>Davao Del Norte</option>
							<option>Davao Del Sur</option>
							<option>Davao Occidental</option>
							<option>Davao Oriental</option>
							<option>Dinagat Islands</option>
							<option>Eastern Samar</option>
							<option>Guimaras</option>
							<option>Ifugao</option>
							<option>Ilocos Norte</option>
							<option>Ilocos Sur</option>
							<option>Iloilo</option>
							<option>Isabela</option>
							<option>Kalinga</option>
							<option>La Union</option>
							<option>Laguna</option>
							<option>Lanao Del Norte</option>
							<option>Lanao Del Sur</option>
							<option>Leyte</option>
							<option>Maguindanao</option>
							<option>Marinduque</option>
							<option>Masbate</option>
							<option>Misamis Occidental</option>
							<option>Misamis Oriental</option>
							<option>Mountain Province</option>
							<option>Negros Occidental</option>
							<option>Negros Oriental</option>
							<option>Northern Samar</option>
							<option>Nueva Ecija</option>
							<option>Nueva Vizcaya</option>
							<option>Occidental Mindoro</option>
							<option>Oriental Mindoro</option>
							<option>Palawan</option>
							<option>Pampanga</option>
							<option>Pangasinan</option>
							<option>Quezon</option>
							<option>Quirino</option>
							<option>Rizal</option>
							<option>Romblon</option>
							<option>Samar</option>
							<option>Sarangani</option>
							<option>Siquijor</option>
							<option>Sorsogon</option>
							<option>South Cotabato</option>
							<option>Southern Leyte</option>
							<option>Sultan Kudarat</option>
							<option>Sulu</option>
							<option>Surigao Del Norte</option>
							<option>Surigao Del Sur</option>
							<option>Tarlac</option>
							<option>Tawi-Tawi</option>
							<option>Zambales</option>
							<option>Zamboanga Del Norte</option>
							<option>Zamboanga Del Sur</option>
							<option>Zamboanga Sibugay</option>
						</select>
					</div>
				</div>
				<div class="row input">
					<div class="col-sm-2"></div>
					<div class="col-sm-4"><input class="input-field" type="" name="" id="clrZipCode" placeholder="Zip Code">
					</div>
				</div>
				<div class="row input">
					<div class="col-sm-2"><label>Username</label>
					</div>
					<div class="col-sm-7"><input class="input-field" type="" name="" id="clrUsername" placeholder="Username">
					</div>
				</div>
				<div class="row input">
					<div class="col-sm-2"><label>Password</label>
					</div>
					<div class="col-sm-6"><input class="input-field" class="input-field" type="password" placeholder="Password" name="psw" id="myInput">
					</div>
					<div class="col-sm-1"><input type="checkbox" onclick="myFunction()" style="width: 30px;float: right;margin-right: 23px;margin-top: 8px;">
					</div>
				</div>
				<div class="row input">
					<div class="col-sm-2"><label></label>
					</div>
					<div class="col-sm-6"><input class="input-field" class="input-field" type="Password" placeholder="Re-Type Password" name="psw" id="clrPassword">
					</div>
				</div>
				<div class="row input">
					<div class="col-sm-8 privacy-terms">
						<p>
							By registering as a new user, you accept without restriction the user terms (encompassing general user terms, registered user terms and privacy policy) and you will be granted access to our on-line business services. You can reserve, view new product, get discount and promo, and you can contact with us as our valued customer. As a registered customer, you can view your personal details in account settings. Without waiving any other rights and remedies, any breach or violation of the user terms is subject to legal prosecution.
						</p>
						<input type="checkbox" name="" id="clrChkAgg" style="width: 30px;">Accept user, terms and privacy cookie.
					</div>
					<div class="col-sm-2">
						<button class="submit" id="clrSubmitBtn" onClick="registerBtn()">Submit</button>
					</div>
					<div class="col-sm-2">
						<button class="reset" id="resetBtn" onClick="resetBtn()">Reset</button>
					</div>

				</div>
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

	//showpassword
	function myFunction() {
		var x = document.getElementById( "myInput" );
		if ( x.type === "password" ) {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
	//end
</script>
</html>