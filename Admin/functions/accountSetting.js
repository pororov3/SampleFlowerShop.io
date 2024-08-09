// JavaScript Document

//$(document).ready(function () {
//load
//loadinfo();

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
//end load

//login call

function loginbtn() { //ok na
	swal({
		title: "Login!",
		text: "Logging In...!",
		icon: "info",
		button: "Ok!",
	});
	$.ajax({
		url: './../Admin/functions/admin-JS-pHp.php',
		method: "POST",
		data: {
			login: 'login',
			luser: $("#lusername").val(),
			lpass: $("#loginpass").val()
		},
		success: function (data) {
			logger("Logged In!");
			document.write(data);
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
//end login call

//user

function loadUserTable() { //ok wat if ibang column pa filter Que
	//Columns
	//L_ID L_Name L_Username L_UserType L_Contact L_UserSince L_AccountStatus

	var uType = '';
	var uStatus = '';
	var where = '';
	var and = '';
	var searchlvl1 = '';
	var searchlvl2 = '';

	if ($("#uUserType").val() == "All") {
		uType = '';
	} else {
		uType = ' L_UserType = "' + $("#uUserType").val() + '"';
	}

	if ($("#uStatus").val() == "All") {
		uStatus = '';
	} else {
		uStatus = ' L_AccountStatus = "' + $("#uStatus").val() + '"';
	}

	if (uType == "" && uStatus == "") {
		where = '';
	} else {
		where = ' where ';
	}

	if (uType != "" && uStatus != "" && $("#ulSearch").val() != '') {
		and = ' and ';
	}

	if ($("#uSearchtxt").val() != '') {

		searchlvl1 = '(select * from fslogin where L_Name like "%' + $("#uSearchtxt").val() + '%") as tblSearch'; //what if other column... please check
		executeULQue();

	} else {

		searchlvl1 = '(select * from fslogin) as tblSearch';
		executeULQue();
	}

	//SELECT * FROM (select * from (select * from fsuserlogs where UL_Action like "%s%") as tblSearch where UL_Date >= "0000-00-00" and UL_Date <= "9999-12-30") as tblDateRange where UL_Position = "Staff" and UL_UserType = "Owner"

	function executeULQue() {

		var queStr = 'SELECT * FROM ' + searchlvl1 + where + uType + and + uStatus;

		$.ajax({
			url: 'functions/accountSetting.php',
			method: "POST",
			data: {
				action: 'loadtable',
				query: queStr
			},
			success: function (data) {
				document.getElementById("tableDesti").innerHTML = data;
				logger("User Tab Perform: " + queStr);
				swal({
					title: "Load Logs!",
					text: "Loaded...",
					icon: "info",
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

function adduserbtn() { //ok
	swal({
		title: "Adding!",
		text: "Adding...",
		icon: "info",
		button: "Ok!",
	});
	var name = $("#add-name").val();
	var pos = $("#add-pos").val();
	var type = $("#add-type").val();
	var uname = $("#add-uname").val();
	var cont = $("#add-contact").val();
	var pass = $("#add-pass").val();

	$.ajax({
		url: 'functions/accountSetting.php',
		method: "POST",
		data: {
			action: 'add',
			name: name,
			position: pos,
			userType: type,
			username: uname,
			contact: cont,
			password: pass
		},
		success: function (data) {
			loaduser();
			document.getElementById("succesfully-add-user").innerHTML = data;
			document.getElementById("close-modal").click();
			adduser();
			logger("User Tab Perform: Add User: " + name + " " + pos + " " + type + " " + uname);
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

function loaduser() {

	var queStr = 'SELECT * FROM fslogin';

	$.ajax({
		url: 'functions/accountSetting.php',
		method: "POST",
		data: {
			action: 'loadtable',
			query: queStr
		},
		success: function (data) {
			document.getElementById("tableDesti").innerHTML = data;
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
//end user

//account-setting
function saveconfirmbtn() { //ok na

	var intPass = $("#myInput").val();
	var lstPass = $("#reMyInput").val();

	if (intPass != lstPass) {
		swal({
			title: "Program Error!",
			text: "Retype Password!",
			icon: "warning",
			button: "Ok!",
		});
	} else {
		$.ajax({
			url: 'functions/accountSetting.php',
			method: "POST",
			data: {
				action: 'update',
				name: $("#upName").val(),
				username: $("#upUsername").val(),
				contact: $("#upContact").val(),
				password: $("#reMyInput").val()
			},
			success: function (data) {
				loadinfo();
				document.getElementById("account-updated").innerHTML = data;
				update();
				logger("Account Setting Tab Perform: Update on own details!");
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

//loadinfo
//var curruser;

function loadinfo() { //ok
	$.ajax({
		url: 'functions/accountSetting.php',
		method: "POST",
		data: {
			action: 'loginchk'
		},
		success: function (data) {
			var obj = JSON.parse(data);

			var name = obj.L_Name;
			var position = obj.L_Position;
			var userType = obj.L_UserType;
			var userID = obj.L_ID;
			var userName = obj.L_Username;
			var password = obj.L_Password;
			var contact = obj.L_Contact;
			var userSince = obj.L_UserSince;

			document.getElementById("L_Name").innerHTML = name;
			document.getElementById("L_Pos").innerHTML = position;
			document.getElementById("L_Type").innerHTML = userType;
			document.getElementById("L_ID").innerHTML = userID;
			document.getElementById("L_Username").innerHTML = userName;
			document.getElementById("L_Pass").innerHTML = password;
			document.getElementById("L_Contact").innerHTML = contact;
			document.getElementById("L_UserSince").innerHTML = userSince;
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
//end loadinfo
//end account-setting

//user log

function ulSearchBtn() { //ok kulang nlng search all column
	swal({
		title: "Search!",
		text: "Searching...!",
		icon: "info",
		button: "Ok!",
	});
	//Columns
	//UL_ID UL_Name UL_Position UL_Date UL_Time UL_Action

	//date parsing
	var uldateFrom = $("#datepicker").val();
	var uldateTo = $("#datepicker1").val();

	if (uldateFrom != '') { // 03/03/2000
		var fyr = uldateFrom.slice(6, 10);
		var fday = uldateFrom.slice(3, 5);
		var fmon = uldateFrom.slice(0, 2);
		uldateFrom = fyr + "-" + fmon + "-" + fday;
	}
	if (uldateTo != '') {
		uldateTo = uldateTo.slice(6, 10) + "-" + uldateTo.slice(0, 2) + "-" + uldateTo.slice(3, 5);
	}

	var pos = '';
	var userLev = '';
	var where = '';
	var and = '';
	var searchlvl1 = '';
	var searchlvl2 = '';

	if ($("#ulPosition").val() == "All") {
		pos = '';
	} else {
		pos = ' UL_Position = "' + $("#ulPosition").val() + '"';
	}

	if ($("#ulUserLevel").val() == "All") {
		userLev = '';
	} else {
		userLev = ' UL_Action = "' + $("#ulUserLevel").val() + '"';
	}

	if (pos == "" && userLev == "") {
		where = '';
	} else {
		where = ' where ';
	}

	if (pos != "" && userLev != "" && $("#ulSearch").val() != '') {
		and = ' and ';
	}

	if ($("#ulSearch").val() != '') {

		searchlvl1 = '(select * from fsuserlogs where UL_Action like "%' + $("#ulSearch").val() + '%") as tblSearch'; //what if other column... please check

		if (uldateFrom == '' && uldateTo == '') {
			searchlvl2 = '(select * from ' + searchlvl1 + ') as tblDateRange ';
			executeULQue();
		} else if (uldateFrom == '' || uldateTo == '') {
			swal({
				title: "Query error!",
				text: "Please complete the Date Range!",
				icon: "error",
				button: "Ok!",
			});
		} else {
			searchlvl2 = '(select * from ' + searchlvl1 + ' where UL_Date >= "' + uldateFrom + '" and UL_Date <= "' + uldateTo + '") as tblDateRange ';
			executeULQue();
		}
	} else {

		if (uldateFrom == '' && uldateTo == '') {
			searchlvl2 = '(select * from fsuserlogs) as tblDateRange ';
			executeULQue();
		} else if (uldateFrom == '' || uldateTo == '') {
			swal({
				title: "Query error!",
				text: "Please complete the Date Range!",
				icon: "error",
				button: "Ok!",
			});
		} else {
			searchlvl2 = '(select * from fsuserlogs where UL_Date >= "' + uldateFrom + '" and UL_Date <= "' + uldateTo + '") as tblDateRange ';
			executeULQue();
		}
	}

	//SELECT * FROM (select * from (select * from fsuserlogs where UL_Action like "%s%") as tblSearch where UL_Date >= "0000-00-00" and UL_Date <= "9999-12-30") as tblDateRange where UL_Position = "Staff" and UL_UserType = "Owner"
	function executeULQue() {

		var queStr = 'SELECT * FROM ' + searchlvl2 + where + pos + and + userLev;

		$.ajax({
			url: 'functions/accountSetting.php',
			method: "POST",
			data: {
				action: 'srclog',
				query: queStr
			},
			success: function (data) {
				document.getElementById("insertLog").innerHTML = data;
				//logger("User Log History Tab Perform: " + queStr);
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

function genbtn() { //ok
	swal({
		title: "Generate Logs!",
		text: "Generating...",
		icon: "info",
		button: "Ok!",
	});
	$.ajax({
		url: 'functions/accountSetting.php',
		method: "POST",
		data: {
			action: 'loadlog'
		},
		success: function (data) {
			document.getElementById("insertLog").innerHTML = data;
			//logger("User Log History Tab Perform: Generate Logs");
			swal({
				title: "Load Logs!",
				text: "Loaded...",
				icon: "info",
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
//end user log
//});
