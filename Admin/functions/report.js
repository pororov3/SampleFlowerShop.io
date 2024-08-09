// JavaScript Document

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


//Ordering and Reservation Report
function reportTORSearchBtn() {
	swal({
		title: "Search!",
		text: "Searching...!",
		icon: "info",
		button: "Ok!",
	});

	//date parsing
	var rdateFrom = $("#datepicker").val();
	var rdateTo = $("#datepicker1").val();

	if (rdateFrom != '') { // 03/03/2000
		var fyr = rdateFrom.slice(6, 10);
		var fday = rdateFrom.slice(3, 5);
		var fmon = rdateFrom.slice(0, 2);
		rdateFrom = fyr + "-" + fmon + "-" + fday;
	}
	if (rdateTo != '') {
		rdateTo = rdateTo.slice(6, 10) + "-" + rdateTo.slice(0, 2) + "-" + rdateTo.slice(3, 5);
	}

	var typeOfOrder = '';
	var query = '';
	
	/*SELECT `I_Code`,`I_ItemName`, `I_Description`, `I_Occasion`, `I_Price`, `O_Item`, `O_Qty` FROM `fsitems`,`fsorderrequest` WHERE `SO_Status` = "Success"*/

	if ($("#typeOfOrder").val() == "All") {
		if (rdateFrom == '' && rdateTo == '') {
			query = 'SELECT `I_Code`,`I_ItemName`, `I_Description`, `I_Occasion`, `I_Price`, `O_Item`, `O_Qty` FROM `fsitems`,`fsorderrequest` WHERE 1';
			executeQue();
		} else if (rdateFrom == '' || rdateTo == '') {
			swal({
				title: "Query error!",
				text: "Please complete the Date Range!",
				icon: "error",
				button: "Ok!",
			});
		} else {
			query = 'SELECT `I_Code`,`I_ItemName`, `I_Description`, `I_Occasion`, `I_Price`, `O_Item`, `O_Qty` FROM `fsitems`,`fsorderrequest` WHERE `O_DateOrder` >= "' + rdateFrom + '" AND `O_DateOrder` <= "' + rdateTo + '"';
			executeQue();
		}
	} else {
		if (rdateFrom == '' && rdateTo == '') {
			query = 'SELECT `I_Code`,`I_ItemName`, `I_Description`, `I_Occasion`, `I_Price`, `O_Item`, `O_Qty` FROM `fsitems`,`fsorderrequest` WHERE `O_Type` = "' + $("#typeOfOrder").val() + '"';
			executeQue();
		} else if (rdateFrom == '' || rdateTo == '') {
			swal({
				title: "Query error!",
				text: "Please complete the Date Range!",
				icon: "error",
				button: "Ok!",
			});
		} else {
			query = 'SELECT `I_Code`,`I_ItemName`, `I_Description`, `I_Occasion`, `I_Price`, `O_Item`, `O_Qty` FROM `fsitems`,`fsorderrequest` WHERE `O_DateOrder` >= "' + rdateFrom + '" AND `O_DateOrder` <= "' + rdateTo + '" AND `O_Type` = "' + $("#typeOfOrder").val() + '"';
			executeQue();
		}
	}

	function executeQue() {

		var sql = query;

		swal({
			title: "Generate Logs!",
			text: "Generating...",
			icon: "info",
			button: "Ok!",
		});

		$.ajax({
			url: 'functions/report.php',
			method: "POST",
			data: {
				sql: sql,
				report: 'loadOR'
			},
			success: function (data) {
				document.getElementById('report').style.display = "block";
			document.getElementById("insertReport").innerHTML = data;
				swal({
					title: "Load Logs!",
					text: "Loaded...",
					icon: "info",
					button: "Ok!",
				});
				logger("Ordering and Reservation Report: Generate Logs.");
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
//End Ordering and Reservation Report

//Transaction History
function reportTHSearchBtn() {
	swal({
		title: "Search!",
		text: "Searching...!",
		icon: "info",
		button: "Ok!",
	});

	//date parsing
	var rdateFrom = $("#datepicker").val();
	var rdateTo = $("#datepicker1").val();

	if (rdateFrom != '') { // 03/03/2000
		var fyr = rdateFrom.slice(6, 10);
		var fday = rdateFrom.slice(3, 5);
		var fmon = rdateFrom.slice(0, 2);
		rdateFrom = fyr + "-" + fmon + "-" + fday;
	}
	if (rdateTo != '') {
		rdateTo = rdateTo.slice(6, 10) + "-" + rdateTo.slice(0, 2) + "-" + rdateTo.slice(3, 5);
	}

	var typeOfOrder = '';
	var query = '';

	if ($("#typeOfOrder").val() == "All") {
		if (rdateFrom == '' && rdateTo == '') {
			query = 'SELECT `O_OrderNumber`, `O_CusName`, `O_Type`, `O_Item`, `O_Qty`, `O_ItemAmount`, `O_PaymentMethod`, `O_ReferenceNumber`, `O_AmountTotaled`, `O_ReqDate`, `O_DateOrder` FROM `fsorderrequest`';
			executeQue();
		} else if (rdateFrom == '' || rdateTo == '') {
			swal({
				title: "Query error!",
				text: "Please complete the Date Range!",
				icon: "error",
				button: "Ok!",
			});
		} else {
			query = 'SELECT `O_OrderNumber`, `O_CusName`, `O_Type`, `O_Item`, `O_Qty`, `O_ItemAmount`, `O_PaymentMethod`, `O_ReferenceNumber`, `O_AmountTotaled`, `O_ReqDate`, `O_DateOrder` FROM `fsorderrequest` WHERE `O_DateOrder` >= "' + rdateFrom + '" AND `O_DateOrder` <= "' + rdateTo + '"';
			executeQue();
		}
	} else {
		if (rdateFrom == '' && rdateTo == '') {
			query = 'SELECT `O_OrderNumber`, `O_CusName`, `O_Type`, `O_Item`, `O_Qty`, `O_ItemAmount`, `O_PaymentMethod`, `O_ReferenceNumber`, `O_AmountTotaled`, `O_ReqDate`, `O_DateOrder` FROM `fsorderrequest`WHERE `O_Type` = "' + $("#typeOfOrder").val() + '"';
			executeQue();
		} else if (rdateFrom == '' || rdateTo == '') {
			swal({
				title: "Query error!",
				text: "Please complete the Date Range!",
				icon: "error",
				button: "Ok!",
			});
		} else {
			query = 'SELECT `O_OrderNumber`, `O_CusName`, `O_Type`, `O_Item`, `O_Qty`, `O_ItemAmount`, `O_PaymentMethod`, `O_ReferenceNumber`, `O_AmountTotaled`, `O_ReqDate`, `O_DateOrder` FROM `fsorderrequest` WHERE `O_DateOrder` >= "' + rdateFrom + '" AND `O_DateOrder` <= "' + rdateTo + '" AND `O_Type` = "' + $("#typeOfOrder").val() + '"';
			executeQue();
		}
	}

	function executeQue() {

		var sql = query;

		swal({
			title: "Generate Logs!",
			text: "Generating...",
			icon: "info",
			button: "Ok!",
		});

		$.ajax({
			url: 'functions/report.php',
			method: "POST",
			data: {
				sql: sql,
				report: 'loadTH'
			},
			success: function (data) {
				document.getElementById('report').style.display = "block";
				document.getElementById("insertTransHistory").innerHTML = data;
				swal({
					title: "Load Logs!",
					text: "Loaded...",
					icon: "info",
					button: "Ok!",
				});
				logger("Transaction History: Generate Logs.");
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
//End Transaction History