// JavaScript Document
//$(document).ready(function () {
//logger
function logger(acts) {
	$.ajax({
		url: 'functions/admin-JS-pHp.php',
		method: "POST",
		data: {
			logger: 'log',
			logAction: acts
		},
		success: function (data) {},
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
//end logger

//Order Request
function orderrequestload() { // ok na
	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'orload',
			query: 'SELECT * FROM (SELECT * FROM fsorderrequest, fsclientlogin where fsorderrequest.CusOrder_ID = fsclientlogin.CL_ID) as Tblset WHERE O_AcceptReq != "Accepted" AND O_OrderStatus != "Accepted" AND RD_ItemAssignment != "Accepted" AND RP_Status != "Accepted" AND SO_Status != "Success" AND O_AcceptReq NOT LIKE "%Canceled%"'
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertorderrequest").innerHTML = data;
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

function orSearchBtn() { //ok na advance que nlng

	var queStr = 'SELECT * FROM (SELECT * FROM fsorderrequest, fsclientlogin where fsorderrequest.CusOrder_ID = fsclientlogin.CL_ID) as Tblset WHERE O_CusName like "%' + $("#orSearch").val() + '%" AND O_AcceptReq != "Accepted" AND O_OrderStatus != "Accepted" AND RD_ItemAssignment != "Accepted" AND RP_Status != "Accepted" AND SO_Status != "Success" AND O_AcceptReq NOT LIKE "%Canceled%"';

	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'orload',
			query: queStr
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertorderrequest").innerHTML = data;
			logger("Order Request Tab Perform: " + queStr);
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
	swal({
		title: "Search!",
		text: "Searching...",
		icon: "info",
		button: "Ok!",
	});
}

function showSuccess(id) { // ok na
	var res = id.split("_", 2);
	/*document.getElementById('success').style.display = "block";
	document.getElementById('cancel').style.display = "none";
	document.getElementById('success').innerHTML = "Order# " + res[1] + " Succesfully approve. You can check it at Approved Module";
	//hide delay
	$("#success").hide(5000);
	//end hide*/
	swal({
		title: "Approve Request!",
		text: "Order# " + res[1] + " Succesfully approve. You can check it at Approved Module!",
		icon: "success",
		button: "Ok!",
	});
	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'acceptOrder',
			query: 'UPDATE `fsorderrequest` SET `O_AcceptReq`="Accepted", `RD_ItemAssignment`="Pending", `O_OrderStatus`="Pending", `RP_Status`="Pending", `SO_Status`="Pending" WHERE `O_OrderNumber` = ' + res[1]
		},
		success: function (data) {
			console.log(data);
			logger("Order Request Tab Perform: Order Number " + res[1] + " was Accepted!.");
			orderrequestload();
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

var btnID = '';

function getID(id) { // ok na
	btnID = id;
}

function showCancel() { // ok na

	var res = btnID.split("_", 2);

	var reason = $("#textCancel").val();

	/*document.getElementById('cancel').style.display = "block";
	document.getElementById('success').style.display = "none";
	document.getElementById('cancel').innerHTML = reason;
	//hide delay
	$("#cancel").hide(5000);
	//end hide*/
	swal({
		title: "Approve Request!",
		text: reason,
		icon: "info",
		button: "Ok!",
	});
	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'acceptOrder',
			query: 'UPDATE `fsorderrequest` SET `O_AcceptReq` = "Canceled: ' + reason + '" WHERE `O_OrderNumber` = ' + res[1]
		},
		success: function (data) {
			console.log(data);
			logger("Order Request Tab Perform: Order Number " + res[1] + " was Canceled!.");
			orderrequestload();
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
	document.getElementById("orClose").click();
}
//end Order Request

//Approved Order
function approvedorderload() { // ok na
	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'oaload',
			query: 'SELECT * FROM fsorderrequest WHERE O_AcceptReq = "Accepted" AND O_OrderStatus != "Accepted" AND RD_ItemAssignment != "Accepted" AND RP_Status != "Accepted" AND SO_Status != "Success"'
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertApprovedOrder").innerHTML = data;
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

function oaSearchBtn() { //ok na advance que nlng
	var queStr = 'SELECT * FROM fsorderrequest WHERE O_CusName like "%' + $("#oaSearch").val() + '%" AND O_AcceptReq = "Accepted" AND O_OrderStatus != "Accepted" AND RD_ItemAssignment = "Pending" AND RP_Status != "Accepted" AND SO_Status != "Success"';

	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'oaload',
			query: queStr
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertApprovedOrder").innerHTML = data;
			logger("Approved Order Tab Perform: " + queStr);
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
	swal({
		title: "Search!",
		text: "Searching...",
		icon: "info",
		button: "Ok!",
	});
}

function showReady(id) { // ok na
	var res = id.split("_", 2);

	var queStr = 'UPDATE fsorderrequest SET O_OrderStatus = "Accepted" WHERE O_OrderNumber =' + res[1];

	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'oaload',
			query: queStr
		},
		success: function (data) {
			console.log(data);
			/*document.getElementById('ready').style.display = "block";
			document.getElementById('ready').innerHTML = 'Order Number ' + res[1] + ' is ready for Delivery or Pickup';
			$("#ready").hide(5000);*/
			logger("Approved Order Tab Perform: Order Number " + res[1] + " Accepted/Approved!.");
			approvedorderload();
			swal({
				title: "Approve Order!",
				text: 'Order Number ' + res[1] + ' is ready for Delivery or Pickup!',
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
//end Approved Order

//Ready for Delivery
function readyfordelivery() { // ok na
	var sql = 'SELECT * FROM fsorderrequest, fsclientlogin where fsorderrequest.CusOrder_ID = fsclientlogin.CL_ID AND O_Type = "Delivery" AND O_AcceptReq = "Accepted" AND O_OrderStatus = "Accepted" AND RP_Status != "Accepted" AND SO_Status != "Success"';
	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'rdload',
			query: sql
		},
		success: function (data) {
			//console.log(data);
			document.getElementById("insertReadyforDelivery").innerHTML = data;
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

function rdSearchBtn() { //ok na advance que nlng
	var queStr = 'SELECT * FROM (SELECT * FROM fsorderrequest, fsclientlogin where fsorderrequest.CusOrder_ID = fsclientlogin.CL_ID) as Tblset WHERE O_CusName like "%' + $("#rdSearch").val() + '%" AND O_Type = "Delivery" AND O_AcceptReq = "Accepted" AND O_OrderStatus = "Accepted" AND SO_Status != "Success"';

	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'rdload',
			query: queStr
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertReadyforDelivery").innerHTML = data;
			logger("Ready for Delivery Tab Perform: " + queStr);
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
	swal({
		title: "Search!",
		text: "Searching...",
		icon: "info",
		button: "Ok!",
	});
}

function rdManList() {
	var queStr = 'SELECT * FROM `fslogin` WHERE `L_Position` = "Delivery Man"';

	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'rdManList',
			query: queStr
		},
		success: function (data) {
			document.getElementById("insertRDManSelect").innerHTML = data;
			logger("Ready for Delivery Tab Perform: " + queStr);
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

function showAssign() { //pending
	var noChked = $('input[class=chkboxs]:checked').attr('value');

	//alert(noChked);

	if (noChked > 0) {
		document.getElementById('no-selected').style.display = "none";
		document.getElementById('assign').style.display = "none";
	} else {
		document.getElementById('no-selected').style.display = "block";
		document.getElementById('assign').style.display = "none";
	}

}

function assign() { //pending

	document.getElementById('no-selected').style.display = "none";

	var valID = $('input[name=DelMan]:checked').attr('value');
	var orderNo = $('input[class=chkboxs]:checked').attr('value');
	var nameid = '';

	console.log(orderNo);

	valID = valID ? valID : 0;
	orderNo = orderNo ? orderNo : 0;

	if (valID != 0 || orderNo != 0) {

		document.getElementById('no-selected').style.display = "none";

		var queStr = 'UPDATE fs_rd_delmanstatus SET `RD_TransNo` = ' + orderNo + ' , `RD_Status` = "Busy" WHERE `RD_ID` = ' + valID;

		$.ajax({
			url: 'functions/ordering-process.php',
			method: 'POST',
			data: {
				ordering: 'rdquery',
				query: queStr
			},
			success: function (data) {
				//console.log("Add Delman Trans Data: " + data);
				document.getElementById("rdmodaldm").click();
				//document.getElementById('assign').style.display = "block";
				//$("#assign").hide(5000);
				swal({
					title: "Assign Delivery Man",
					text: "Order " + orderNo + " was assigned to " + nameid + ".",
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
		//update transaction info

		var queStr1 = "SELECT `L_Name` FROM `fslogin` WHERE L_ID = " + valID;

		$.ajax({
			url: 'functions/ordering-process.php',
			method: 'POST',
			data: {
				ordering: 'rdquery',
				query: queStr1
			},
			success: function (data) {
				console.log("Name from get id: " + data);
				nameid = data;
				var queStr2 = 'UPDATE `fsorderrequest` SET `RD_ItemAssignment` = "Item was assign to ' + nameid + " for Delivery!" + '" WHERE `O_OrderNumber` = ' + orderNo;

				$.ajax({
					url: 'functions/ordering-process.php',
					method: 'POST',
					data: {
						ordering: 'rdquery',
						query: queStr2
					},
					success: function (data) {
						console.log("update to trans data " + data);
						readyfordelivery();
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
		logger("Order Number: " + orderNo + " Was assigned to " + nameid + " for Delivery");
	} else {
		swal({
			title: "Order Details",
			text: "No Transaction or Delivery Man selected!",
			icon: "warning",
			button: "Ok!",
		});
		document.getElementById("rdmodaldm").click();
		document.getElementById('no-selected').style.display = "block";
		document.getElementById('no-selected').innerHTML = "Please select a Transaction and Delivery Man!";
		$("#no-selected").hide(5000);
	}
}

function checkall() { //done

	var selectnum = $(".chkboxs").length;
	var id = '';

	if (document.getElementById('checkall').checked == true) {
		for (a = 0; selectnum != a; a++) {
			id = $(".chkboxs:eq(" + a + ")").attr('id');
			document.getElementById(id).checked = true;
		}
	} else {
		for (a = 0; selectnum != a; a++) {
			id = $(".chkboxs:eq(" + a + ")").attr('id');
			document.getElementById(id).checked = false;
		}
	}
	showAssign();
}
//end Ready for Delivery

//Ready for Pick-up
function readyforpickup() { // ok na
	var sql = 'SELECT * FROM (SELECT * FROM fsorderrequest, fsclientlogin where fsorderrequest.CusOrder_ID = fsclientlogin.CL_ID) as Tblset WHERE O_Type = "Pick-up" AND O_AcceptReq = "Accepted" AND O_OrderStatus = "Accepted" AND RP_Status != "Accepted" AND SO_Status != "Success"';
	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'rpload',
			query: sql
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertReadyforPickup").innerHTML = data;
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

function rpSearchBtn() { //ok na advance que nlng
	var queStr = 'SELECT * FROM (SELECT * FROM fsorderrequest, fsclientlogin where fsorderrequest.CusOrder_ID = fsclientlogin.CL_ID) as Tblset WHERE O_CusName like "%' + $("#rpSearch").val() + '%" AND O_Type = "Pick-up" AND O_AcceptReq = "Accepted" AND O_OrderStatus = "Accepted" AND RP_Status != "Accepted" AND SO_Status != "Success"';

	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'rpload',
			query: queStr
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertReadyforPickup").innerHTML = data;
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
	swal({
		title: "Search!",
		text: "Searching...",
		icon: "info",
		button: "Ok!",
	});
}

function showpickup(id) {
	var res = id.split("_", 2);

	var datetoday = new Date();

	var yr = datetoday.getFullYear();
	var mon = datetoday.getMonth() + 1;
	var day = datetoday.getDate();

	if (mon < 10) {
		mon = "0" + mon;
	}

	if (day < 10) {
		day = "0" + day;
	}

	var dtdStr = yr + "-" + mon + "-" + day;

	var queStr = 'UPDATE fsorderrequest SET RP_Status = "Accepted", SO_Status = "Success", O_ReqDate = "' + dtdStr + '" WHERE O_OrderNumber =' + res[1];

	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'rpUpdate',
			query: queStr
		},
		success: function (data) {
			//console.log(data);
			//document.getElementById('pickup').style.display = "block";
			//document.getElementById('pickup').innerHTML = "Order Number " + res[1] + " is has been Picked-up!";
			//$("#pickup").hide(5000);
			swal({
				title: "Item Picked-Up",
				text: "Order Number " + res[1] + " is has been Picked-up!",
				icon: "success",
				button: "Ok!",
			});
			readyforpickup();
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
//end Ready for Pick-up

//On Delivery
function ondelivery() { // ok na
	var sql = 'SELECT * FROM (SELECT * FROM fsorderrequest, fsclientlogin WHERE fsorderrequest.CusOrder_ID = fsclientlogin.CL_ID) AS Tblset WHERE O_Type = "Delivery" AND O_AcceptReq = "Accepted" AND O_OrderStatus = "Accepted" AND RD_ItemAssignment != "Pending" AND SO_Status != "Success"';
	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'odload',
			query: sql
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertOnDelivery").innerHTML = data;
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

function odSearchBtn() { //ok na advance que nlng
	var queStr = 'SELECT * FROM (SELECT * FROM fsorderrequest, fsclientlogin where fsorderrequest.CusOrder_ID = fsclientlogin.CL_ID) as Tblset WHERE O_CusName like "%' + $("#odSearch").val() + '%" AND O_Type = "Delivery" AND O_AcceptReq = "Accepted" AND O_OrderStatus = "Accepted" AND RD_ItemAssignment != "Pending" AND SO_Status != "Success"';

	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'odload',
			query: queStr
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertOnDelivery").innerHTML = data;
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
	swal({
		title: "Search!",
		text: "Searching...",
		icon: "info",
		button: "Ok!",
	});
}
//end On Delivery

//Received Item advance column search nlng
function receiveditems() { // ok na
	var sql = 'SELECT * FROM fsorderrequest' + ' WHERE SO_Status = "Success"';
	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'riload',
			query: sql
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertreceiveditems").innerHTML = data;
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

function riSearchBtn() { //ok na advance que nlng
	var queStr = '';

	if ($("#riSelect").val() == 'All' || $("#riSelect").val() == 'Filter By Type:') {
		queStr = 'SELECT * FROM fsorderrequest WHERE O_CusName LIKE "%' + $("#riSearch").val() + '%"' + ' AND SO_Status = "Success"';
	} else {
		queStr = 'SELECT * FROM (SELECT * FROM fsorderrequest WHERE O_Type LIKE "%' + $("#riSelect").val() + '%") AS Tblset WHERE O_CusName LIKE "%' + $("#riSearch").val() + '%"' + ' AND SO_Status = "Success"';
	}
	receiveditemsQue(queStr);
	swal({
		title: "Search!",
		text: "Searching...",
		icon: "info",
		button: "Ok!",
	});
}

$("#riSelect").change(function () { // ok na
	var queStr = '';

	if ($("#riSelect").val() == 'All' || $("#riSelect").val() == 'Filter By Type:') {
		queStr = 'SELECT * FROM fsorderrequest' + ' WHERE SO_Status = "Success"';

	} else {
		queStr = 'SELECT * FROM fsorderrequest WHERE O_Type LIKE "%' + $("#riSelect").val() + '%"' + ' AND SO_Status = "Success"';
	}
	receiveditemsQue(queStr);
});

function riAddSOTransBtn() { // ok na
	if ($("#riAddSOTrans").val() != '') {
		//var queStr = 'UPDATE `fsorderrequest` SET SO_Status = "Success" WHERE O_OrderNumber = ' + $("#riAddSOTrans").val();
		var queStr = 'UPDATE `fsorderrequest`, `fs_rd_delmanstatus` SET SO_Status = "Success", RD_TransNo = "0", RD_Status = "Available" WHERE O_OrderNumber = ' + $("#riAddSOTrans").val() + ' AND ' + 'RD_TransNo = ' + $("#riAddSOTrans").val();
		receiveditemsQueAdd(queStr);
	} else {
		swal({
			title: "Add Delivered Order!",
			text: "Please Enter Order Number!",
			icon: "warning",
			button: "Ok!",
		});
	}
}

function receiveditemsQue(sql) { // ok na

	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'riload',
			query: sql
		},
		success: function (data) {
			console.log(data);
			document.getElementById("insertreceiveditems").innerHTML = data;
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

function receiveditemsQueAdd(sql) { // ok na

	$.ajax({
		url: 'functions/ordering-process.php',
		method: "POST",
		data: {
			ordering: 'riAdd',
			query: sql
		},
		success: function (data) {
			//console.log(data);
			//document.getElementById("received").innerHTML = data;
			document.getElementById("riModalCloseBtn").click();
			//showUpdate();
			receiveditems();
			swal({
				title: "Add Completed Delivery",
				text: "Order #" + $("#riAddSOTrans").val() + " was successfully completed!",
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
//end Received Item
