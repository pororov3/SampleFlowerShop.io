// JavaScript Document

//Registration Page
function registerBtn() {
	var chkAgg = document.getElementById("clrChkAgg").checked; //true or false
	var pass1 = $('#myInput').val();
	var pass2 = $('#clrPassword').val();

	if (chkAgg == false) {
		swal({
			title: "Registration",
			text: "Please Check Policy Agreement!",
			icon: "warning",
			button: "Ok!",
		});
	} else {
		if (pass1 != pass2 || pass1 == '' || pass2 == '') {
			swal({
				title: "Registration",
				text: "Retype Password!",
				icon: "warning",
				button: "Ok!",
			});
		} else {
			swal({
				title: "Registration",
				text: "Please Wait. . .",
				icon: "warning",
				button: "Ok!",
			});
			$.ajax({
				url: './functions/client-account.php',
				method: 'POST',
				data: {
					clientaccount: 'clientregister',
					clrLName: $('#clrLName').val(),
					clrGName: $('#clrGName').val(),
					clrMI: $('#clrMI').val(),
					clrEmail: $('#clrEmail').val(),
					clrContact: $('#clrContact').val(),
					clrAddBlock: $('#clrAddBlock').val(),
					clrAddStreet: $('#clrAddStreet').val(),
					clrBrgy: $('#clrBrgy').val(),
					clrCity: $('#clrCity').val(),
					clrProvince: $('#clrProvince').val(),
					clrZipCode: $('#clrZipCode').val(),
					clrUsername: $('#clrUsername').val(),
					clrPassword: $('#clrPassword').val()
				},
				success: function (data) {
					//console.log(data);
					//alert(data);
					swal({
						title: "Registration",
						text: data,
						icon: "success",
						button: "Ok!",
					});
				},
				error: function () {
					swal({
						title: "Program Error!",
						text: "Ajax Call Failed!",
						icon: "error",
						button: "Ok!",
					});
				}
			});
		}
	}
}

function resetBtn() {
	document.getElementById("clrLName").value = '';
	document.getElementById("clrGName").value = '';
	document.getElementById("clrMI").value = '';
	document.getElementById("clrEmail").value = '';
	document.getElementById("clrContact").value = '';
	document.getElementById("clrAddBlock").value = '';
	document.getElementById("clrAddStreet").value = '';
	document.getElementById("clrBrgy").value = '';
	document.getElementById("clrCity").value = '';
	document.getElementById("clrProvince").value = 'Province';
	document.getElementById("clrZipCode").value = '';
	document.getElementById("clrUsername").value = '';
	document.getElementById("clrPassword").value = '';
	document.getElementById("myInput").value = '';
	document.getElementById("clrChkAgg").checked = false;
}
//End Registration Page

//Login
function cllLoginBtn() {

	//var win = window.open(URL, "../Client/login.php");

	swal({
		title: "Login",
		text: "Logging in. . .",
		icon: "info",
		button: "Ok!",
	});
	$.ajax({
		url: './functions/client-account.php',
		method: 'POST',
		data: {
			clientaccount: 'clientlogin',
			cllUsername: $('#cllUsername').val(),
			cllPassword: $('#cllPassword').val()
		},
		success: function (data) {
			if (data.length < 20) {
				if (data == 'Login successful!') {
					swal({
						title: "Login",
						text: data,
						icon: "success",
						button: "Ok!",
					}).then((value) => {
						//reloadpage(); // for enhancement
						ifLoggedIn();
						document.getElementById("clLoginBtn").innerHTML = "You are logged in";
						document.getElementById("clLoginBtn").disabled = true;
						document.getElementById("cllUsername").disabled = true;
						document.getElementById("cllPassword").disabled = true;
					});
				} else {
					swal({
						title: "Login",
						text: data,
						icon: "error",
						button: "Ok!",
					});
				}
				//window.location.href="thank-you.php"';
			} else {
				document.writeln(data);
			}
		},
		error: function () {

		}
	});
}

function ifLoggedIn() {
	//console.log(localStorage.getItem("clFullName") != null);
	if (localStorage.getItem("clFullName") != null) {
		//window.location.href = "manage-profile.php";
		document.getElementById("clLoginBtn").innerHTML = "You are logged in";
		document.getElementById("clLoginBtn").disabled = true;
		document.getElementById("cllUsername").disabled = true;
		document.getElementById("cllPassword").disabled = true;
		swal({
			title: "Login",
			text: "You're already logged in!\nGo To Dashboard -> Manage Profile to Log out.",
			icon: "warning",
			button: "Ok!",
		});
	}
}

function reloadpage() {
	var delayInMilliseconds = 500; //1000 = 1 second
	/*var e = $.Event('keydown', {
		keyCode: 116
	});
	var f = $.Event('keyup', {
		keyCode: 116
	});*/

	setTimeout(function () {

		//your code to be executed after 1 second
		location.reload();
		//ifLoggedIn();

		/*$(document).trigger(e);
		$(document).trigger(f);*/

	}, delayInMilliseconds);
}
//End Login

//Manage Profile
function loaduserInfo() {
	$.ajax({
		url: './functions/client-account.php',
		method: 'POST',
		data: {
			clientaccount: 'userInfo'
		},
		success: function (data) {
			if (data.includes("Invalid") == true) {
				var divs = document.getElementsByClassName('dashActiveUser');
				[].slice.call(divs).forEach(function (div) {
					div.innerHTML = "Please Login!";
				});

				if (window.location.href.includes('manage-profile.php') == true) {
					document.getElementById('mpName').innerHTML = "Name : ";
					document.getElementById('mpAddress').innerHTML = "Billing Address : ";
					document.getElementById('mpUserName').innerHTML = "Username : ";

					var classes = document.getElementsByClassName('mpChangePass');
					[].slice.call(classes).forEach(function (classMP) {
						classMP.disabled = true;
					});
				}

			} else {
				var jsonData = JSON.parse(data);

				if (window.location.href.includes('manage-profile.php') == true) {
					document.getElementById('mpName').innerHTML = "Name : " + jsonData.CL_LName + ", " + jsonData.CL_GName + " " + jsonData.CL_MInitial;
					document.getElementById('mpAddress').innerHTML = "Billing Address : " + jsonData.CL_AddBlockHouseNo + " " + jsonData.CL_AddStreet + " " + jsonData.CL_AddBrgy + " " + jsonData.CL_AddCity;
					document.getElementById('mpUserName').innerHTML = "Username : " + jsonData.CL_Username;
				}

				var divs = document.getElementsByClassName('dashActiveUser');
				[].slice.call(divs).forEach(function (div) {
					div.innerHTML = jsonData.CL_LName + ", " + jsonData.CL_GName + " " + jsonData.CL_MInitial;
				});

				localStorage.setItem("clFullName", jsonData.CL_LName + ", " + jsonData.CL_GName + " " + jsonData.CL_MInitial);
				localStorage.setItem("clContact", jsonData.CL_Contact);
				localStorage.setItem("clID", jsonData.CL_ID);
			}
		},
		error: function () {
			console.log("Error!");
		}
	});
}

function clLogout() {
	//var alert = confirm("Are you sure you want to logout?");
	var clFullNameKey = "clFullName";
	var clContactKey = "clContact";
	var clCLIDKey = "clID";

	/*if (alert == true) {
		$.ajax({
			url: './functions/client-account.php',
			method: 'POST',
			data: {
				clientaccount: 'clLogout'
			},
			success: function (data) {
				//location.reload();
				localStorage.removeItem(clFullNameKey);
				localStorage.removeItem(clContactKey);
				loaduserInfo();
				console.log(data);
			},
			error: function () {
				console.log("Error!");
			}
		});
	} else {
		console.log("Logout Aborted!");
	}*/

	swal({
			title: "Logout",
			text: "Are you sure you want to logout?",
			icon: "warning",
			buttons: {
				cancel: {
					text: "Cancel",
					value: null,
					visible: true,
					className: "",
					closeModal: true,
				},
				confirm: {
					text: "OK",
					value: true,
					visible: true,
					className: "",
					closeModal: true
				}
			}
		})
		.then((value) => {
			switch (value) {

				case true:
					$.ajax({
						url: './functions/client-account.php',
						method: 'POST',
						data: {
							clientaccount: 'clLogout'
						},
						success: function (data) {
							//location.reload();
							localStorage.removeItem(clFullNameKey);
							localStorage.removeItem(clContactKey);
							localStorage.removeItem(clCLIDKey);
							loaduserInfo();
							console.log(data);
							swal({
								title: "Logout",
								text: "Successfully Logged Out!",
								icon: "success",
								button: "Ok!",
							});
							if (localStorage.getItem(clFullNameKey) != null) {
								localStorage.removeItem(clFullNameKey);
								localStorage.removeItem(clContactKey);
								localStorage.removeItem(clCLIDKey);
							}
						},
						error: function () {
							swal({
								title: "Program Error!",
								text: "Ajax Call Failed!",
								icon: "error",
								button: "Ok!",
							});
						}
					});
					break;

				default:
					console.log("Logout Aborted!");
			}
		});
}
//End Manage Profile

//Dashboard
function modalOA() {
	$.ajax({
		url: 'functions/client-account.php',
		method: "POST",
		data: {
			clientaccount: 'clmodalOA',
			clname: localStorage.getItem("clFullName")
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertModalApprovedOrder").innerHTML = data;
		},
		error: function () {
			swal({
				title: "Program Error!",
				text: "Ajax Call Failed!",
				icon: "error",
				button: "Ok!",
			});
		}
	});
}

function modalOR() {
	$.ajax({
		url: 'functions/client-account.php',
		method: "POST",
		data: {
			clientaccount: 'clmodalOR',
			clname: localStorage.getItem("clFullName")
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertModalOrderReady").innerHTML = data;
		},
		error: function () {
			swal({
				title: "Program Error!",
				text: "Ajax Call Failed!",
				icon: "error",
				button: "Ok!",
			});
		}
	});
}

function modalOD() {
	$.ajax({
		url: 'functions/client-account.php',
		method: "POST",
		data: {
			clientaccount: 'clmodalOD',
			clname: localStorage.getItem("clFullName")
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertModalOnDelivery").innerHTML = data;
		},
		error: function () {
			swal({
				title: "Program Error!",
				text: "Ajax Call Failed!",
				icon: "error",
				button: "Ok!",
			});
		}
	});
}

function modalReceived() {
	$.ajax({
		url: 'functions/client-account.php',
		method: "POST",
		data: {
			clientaccount: 'clmodalR',
			clname: localStorage.getItem("clFullName")
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertModalReceived").innerHTML = data;
		},
		error: function () {
			swal({
				title: "Program Error!",
				text: "Ajax Call Failed!",
				icon: "error",
				button: "Ok!",
			});
		}
	});
}
//End Dashboard

//Recent Transaction
function loadTrans() {
	$.ajax({
		url: 'functions/client-account.php',
		method: "POST",
		data: {
			clientaccount: 'clrecentTrans',
			clname: localStorage.getItem("clFullName")
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertRecentTrans").innerHTML = data;
		},
		error: function () {
			swal({
				title: "Program Error!",
				text: "Ajax Call Failed!",
				icon: "error",
				button: "Ok!",
			});
		}
	});
}
//End Recent Transaction