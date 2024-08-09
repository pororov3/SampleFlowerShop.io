// JavaScript Document
/*function test1() {
	alert("client to admin connected!");
	$.ajax({
		url: './functions/client-admin.php',
		method: 'POST',
		data: {
			clienttoadmin: 'test'
		},
		success: function (data) {
			alert(data);
		},
		error: function () {
			alert("Ajax Call Failed!");
		}
	});
}*/

//Cart to Order Request
function cartToOrderReq() {

	var i, cartItem = [];
	var query = "itemID_";

	var perItemQty = 0;
	var perItemPrice = 0;
	var controlNum = document.getElementById("payControlNo").value;
	var fulName = localStorage.getItem("clFullName");
	var cusID = localStorage.getItem("clID");
	var totalPrice = 0;

	var toOrderCartList = [];
	var mergeItemID = [];
	var mergeQty = [];
	var mergePrice = [];
	var orderType = localStorage.getItem("orderType");
	var pdTemp = localStorage.getItem("promisedDate").split("/");
	var promisedDate = pdTemp[2] + "-" + pdTemp[0] + "-" + pdTemp[1];

	for (i in localStorage) {
		if (localStorage.hasOwnProperty(i)) {
			if (i.match(query) || (!query && typeof i === 'string')) {
				perItemQty = parseInt(localStorage.getItem("itemQty_" + i.substring(7)));
				perItemPrice = parseFloat(localStorage.getItem("itemPrice_" + i.substring(7)));
				selectedItemID = JSON.parse(localStorage.getItem(i));
				cartItem.push({
					cartIndex: i,
					qty: perItemQty,
					item: selectedItemID,
					itemPrice: perItemPrice
				});
				totalPrice += (perItemPrice * perItemQty);
			}
		}
	}

	for (var a = 0; a < cartItem.length; a++) {
		mergeItemID.push({
			item: cartItem[a].item
		});
		mergePrice.push({
			item: cartItem[a].itemPrice
		});
		mergeQty.push({
			item: cartItem[a].qty
		});
	}

	//console.log(mergeItemID);
	//console.log(mergePrice);
	//console.log(mergeQty);

	toOrderCartList.push({
		name: fulName,
		cusID: cusID,
		item: mergeItemID,
		qty: mergeQty,
		price: mergePrice,
		orderType: orderType,
		date: promisedDate,
		controlNumber: controlNum,
		totalPrice: (totalPrice + parseInt(50)) //for delivery fee
	});

	//console.log(toOrderCartList);

	$.ajax({
		url: './functions/client-admin.php',
		method: 'POST',
		data: {
			clienttoadmin: 'cartToOrderReq',
			jsonDataCart: JSON.stringify(toOrderCartList)
		},
		success: function (data) {
			console.log(data);
			cusUpdate();
		},
		error: function () {
			alert("Ajax Call Failed!");
		}
	});
}
//End Cart to Order Request

//isLogin Verifier
//window.location.href='thank-you.php';
function loginVer() { //paymeny tab
	$.ajax({
		url: './functions/client-account.php',
		method: 'POST',
		data: {
			clientaccount: 'loginVer'
		},
		success: function (data) {
			if (data.length == 14) {
				//alert(data);
				swal({
					title: "Login Verification",
					text: "Not Logged In!",
					icon: "error",
					button: "Ok!",
				});
			} else {
				console.log(data);
				swal({
					title: "Submitting in progress!",
					text: "Please wait... You'll be redirected...",
					icon: "info",
					button: false,
				});
				cartToOrderReq();
			}
		},
		error: function () {
			console.log("Error!");
		}
	});
}
//End isLogin Verifier

//Payment Verifier
var ifclick = false;

function sendRequest() {
	if (ifclick == false) {
		ifclick = true;
		if (document.getElementById("payControlNo").value == '') {
			//alert("Control Number was not Entered!");
			swal({
				title: "Control Number",
				text: "Control Number was not Entered!",
				icon: "error",
				button: "Ok!",
			});
		} else {
			loginVer();
		}
	} else {
		//alert("Submitting in progress!");
		swal({
			title: "Multiple Submission",
			text: "Verification in progress!",
			icon: "info",
			button: "Ok!",
		});
		ifclick = false;
	}
}
//End Payment Verifier

//Per Custumer updater
var currTransNo = 0;

function cusUpdate() {

	var fullname = localStorage.getItem("clFullName").split(" ");

	var sql = "SELECT MAX(`O_OrderNumber`) FROM `fsorderrequest` WHERE 1";

	$.ajax({
		url: './functions/client-admin.php',
		method: 'POST',
		data: {
			clienttoadmin: 'cusUpdate',
			cuSQL: sql
		},
		success: function (data) {
			currTransNo = parseInt(data);

			var sql1 = 'UPDATE `fsclientlogin` SET `Cus_OrderNumber`= ' + currTransNo + ' WHERE `CL_LName` = "' + (fullname[0].substr(0, fullname[0].length - 1)) + '" AND `CL_GName` = "' + fullname[1] + '" AND `CL_MInitial` = "' + fullname[2] + '"';

			$.ajax({
				url: './functions/client-admin.php',
				method: 'POST',
				data: {
					clienttoadmin: 'cusUpdate',
					cuSQL: sql1
				},
				success: function (data) {
					console.log(data);
					window.location.href = 'thank-you.php';
				},
				error: function () {
					console.log("Error!");
				}
			});
		},
		error: function () {
			console.log("Error!");
		}
	});
}
//End Per Custumer updater
