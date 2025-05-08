<!DOCTYPE html>
<html>
<head>
	<title>Location</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="icon" type="image/png" href="image/title-logo.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
<div class="map">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241.25341419595824!2d120.98598395313567!3d14.652840536565083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdb527cbf8cb83483!2sEugene%20De%20Mazenod%20Community%20Center!5e0!3m2!1sen!2sph!4v1581259464661!5m2!1sen!2sph" width="100%" height="400" frameborder="0" style="border:1;" allowfullscreen=""></iframe>
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
			<h2><font face="Myriad Pro">Beth's Flower Shop</font></h2> 
			<p>
				EDMC Stall #2 cor. 2nd St. 11th Ave.<br> Gracepark, Caloocan City
			</p>
		</div>
		<div class="col-sm-3">
			<br>
			<br>
			<br>
				Copyright © 2020 bethsflowershop Ph
		</div>
		<div class="col-sm-2">
			<img src="image/facebook.png" height="10px" > 
			&nbsp; 
			<br>
			<a href="">Like Us on Facebook</a>
		</div>
		<div class="col-sm-2">
			<img src="image/phone.png" height="10px"> 
			<br>
			Call Us: +63 906-642-3230
		</div>

	</div>
	
</footer>
</body>
<script type="text/javascript">
	/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
//sidenav
function openNav() {
		  document.getElementById("mySidenav").style.width = "25%";
		}

		function closeNav() {
		  document.getElementById("mySidenav").style.width = "0";
		}

</script>
</html>