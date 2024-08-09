//Admin Dashboard

$('document').ready(function () {
	loadDashboard();
})

function loadDashboard() {
	monEarnings();
	delPercentage();
	pickPercentage();
	newCustomer();
	todaysReq();
	approvedReq();
	itemsOnDelivery();
	itemsPickUp();
	deliveredPickedUp();
	orderReq();
	approvedReqOR();
	onDelivery();
	delivered();
	pickUpReq();
	deliveryReq();
	readyForPickup();
	duetodayPickup();
	dueTomPickup();
	readyForDel()
	duetodayDel();
	dueTomDel();
	withAssDelMan();
	withoutAssDelMan();
}

function monEarnings() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'monthlyEarnings'
		},
		success: function (data) {
			document.getElementById("monEarnings").innerHTML = "₱ " + parseFloat(data).toFixed(2);
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

function delPercentage() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'delPercentage'
		},
		success: function (data) {
			document.getElementById("delPercentage").innerHTML = parseFloat(data).toFixed(2) + " %";
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

function pickPercentage() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'pickPercentage'
		},
		success: function (data) {
			document.getElementById("pickPercentage").innerHTML = parseFloat(data).toFixed(2) + " %";
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

function newCustomer() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'newCustomer'
		},
		success: function (data) {
			document.getElementById("newCustomer").innerHTML = data;
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

function todaysReq() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'todaysReq'
		},
		success: function (data) {
			document.getElementById("todaysReq").innerHTML = data;
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

function approvedReq() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'approvedReq'
		},
		success: function (data) {
			document.getElementById("approvedReq").innerHTML = data;
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

function itemsOnDelivery() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'itemsOnDelivery'
		},
		success: function (data) {
			document.getElementById("itemsOnDelivery").innerHTML = data;
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

function itemsPickUp() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'itemsPickUp'
		},
		success: function (data) {
			document.getElementById("itemsPickUp").innerHTML = data;
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

function deliveredPickedUp() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'deliveredPickedUp'
		},
		success: function (data) {
			document.getElementById("deliveredPickedUp").innerHTML = data;
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

function orderReq() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'orderReq'
		},
		success: function (data) {
			document.getElementById("orderReq").innerHTML = data;
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

function approvedReqOR() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'approvedReqOR'
		},
		success: function (data) {
			document.getElementById("approvedReqOR").innerHTML = data;
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

function pickUpReq() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'pickUpReq'
		},
		success: function (data) {
			document.getElementById("pickUpReq").innerHTML = data;
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

function deliveryReq() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'deliveryReq'
		},
		success: function (data) {
			document.getElementById("deliveryReq").innerHTML = data;
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

function onDelivery() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'onDelivery'
		},
		success: function (data) {
			document.getElementById("onDelivery").innerHTML = data;
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

function delivered() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'delivered'
		},
		success: function (data) {
			document.getElementById("delivered").innerHTML = data;
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

function readyForPickup() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'readyForPickup'
		},
		success: function (data) {
			document.getElementById("readyForPickup").innerHTML = data;
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

function duetodayPickup() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'duetodayPickup'
		},
		success: function (data) {
			document.getElementById("duetodayPickup").innerHTML = data;
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

function dueTomPickup() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'dueTomPickup'
		},
		success: function (data) {
			document.getElementById("dueTomPickup").innerHTML = data;
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

function readyForDel() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'readyForDel'
		},
		success: function (data) {
			document.getElementById("readyForDel").innerHTML = data;
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

function duetodayDel() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'duetodayDel'
		},
		success: function (data) {
			document.getElementById("duetodayDel").innerHTML = data;
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

function dueTomDel() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'dueTomDel'
		},
		success: function (data) {
			document.getElementById("dueTomDel").innerHTML = data;
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

function withAssDelMan() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'withAssDelMan'
		},
		success: function (data) {
			document.getElementById("withAssDelMan").innerHTML = data;
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

function withoutAssDelMan() {
	$.ajax({
		url: 'functions/admin-dashboard.php',
		method: "POST",
		data: {
			adminDashboard: 'withoutAssDelMan'
		},
		success: function (data) {
			document.getElementById("withoutAssDelMan").innerHTML = data;
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
//End Admin Dashboard
