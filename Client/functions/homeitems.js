// JavaScript Document

//Heading
function headLoad() {
	var tempTotal = localStorage.getItem("tempTotal");
	var totalToPay = localStorage.getItem("totalToPay");

	if (totalToPay == null || isNaN(totalToPay) == true && tempTotal == null || isNaN(tempTotal) == true) {
		totalToPay = parseInt(0);
		tempTotal = parseInt(0);
	} else {
		//totalToPay = parseFloat(totalToPay.substring(2));

		var itemPrice = "";
		var nums = "";
		var itemPrice1 = "";
		var nums1 = "";

		nums = totalToPay.substring(2).split(",");
		for (var i = 0; i < nums.length; i++) {
			itemPrice += nums[i];
		}
		totalToPay = itemPrice;

		//tempTotal = parseFloat(localStorage.getItem("tempTotal"));

		nums1 = tempTotal.split(",");
		for (var a = 0; a < nums1.length; a++) {
			itemPrice1 += nums1[a];
		}
		tempTotal = itemPrice1;
	}

	var totalAll = Number(parseFloat(parseFloat(totalToPay) + parseFloat(tempTotal)).toFixed(2)).toLocaleString('en');

	var divs = document.getElementsByClassName('item-number');
	[].slice.call(divs).forEach(function (div) {
		div.innerHTML = "PhP: " + totalAll + "&nbsp;&nbsp;";
	});

	localStorage.setItem("totalToPay", "₱ " + totalAll);
	localStorage.setItem("tempTotal", 0); // reset
}
//End Heading

//Product or Home Page
function homeOnLoad() {
	$.ajax({
		url: './functions/homeitems.php',
		method: 'POST',
		data: {
			clienthome: 'homeitemsload'
		},
		success: function (data) {
			document.getElementById("insertitems").innerHTML = data;
		},
		error: function () {
			//alert("Ajax Call Failed!");
			swal({
				title: "Program Error!",
				text: "Ajax Call Failed!",
				icon: "error",
				button: "Ok!",
			});
		}
	});
}
//End Product or Home Page

//Add to Cart
function acLoadDetails() {

	var id = localStorage.getItem('selitemID');

	$.ajax({
		url: './functions/homeitems.php',
		method: 'POST',
		data: {
			clienthome: 'acLoadDetails',
			itemID: id
		},
		success: function (data) {
			document.getElementById("acItemLoad").innerHTML = data;
		},
		error: function () {
			//alert("Ajax Call Failed!");
			swal({
				title: "Program Error!",
				text: "Ajax Call Failed!",
				icon: "error",
				button: "Ok!",
			});
		}
	});
}

var ifadded = false;

function addtocartBtn(itemID) {

	var i, results = [];
	var query = "itemID_";
	var lastIndex = 0;

	for (i in localStorage) {
		if (localStorage.hasOwnProperty(i)) {

			if (i.match(query) || (!query && typeof i === 'string')) {
				value = JSON.parse(localStorage.getItem(i));
				results.push({
					key: i,
					val: value
				});
				console.log(i);
				if (lastIndex <= parseInt(i.substring(7))) {
					lastIndex = parseInt(i.substring(7));
				}
			}
		}
	}

	localStorage.setItem("itemcounter", results.length);

	var itemcounter = parseInt(localStorage.getItem('itemcounter'));
	var itemQty = parseFloat($('#number').val());

	var itemPrice = "";
	var nums = "";

	nums = document.getElementById("acprice").innerHTML.split(",");
	for (i = 0; i < nums.length; i++) {
		itemPrice += nums[i];
	}

	if (ifadded == false) {
		itemcounter += 1;
		lastIndex += 1;
		localStorage.setItem("itemcounter", itemcounter);
		localStorage.setItem("itemID_" + lastIndex, itemID);
		localStorage.setItem("itemQty_" + lastIndex, itemQty);
		localStorage.setItem("itemPrice_" + lastIndex, itemPrice);
		localStorage.setItem("tempTotal", (itemPrice * itemQty));
		ifadded = true;
		headLoad();
		//alert("Item was added to cart!");
		swal({
			title: "Item Added!",
			text: "Item was added to cart!",
			icon: "success",
			button: "Ok!",
		});
	} else {
		//alert("Item was already added to cart!");
		swal({
			title: "Item Added!",
			text: "Item was already added to cart!",
			icon: "info",
			button: "Ok!",
		});
	}
}
//End Add to Cart

//Cart
function loadItemCart() {

	//localStorage.clear();

	var i, results = [];
	var query = "itemID_";

	for (i in localStorage) {
		if (localStorage.hasOwnProperty(i)) {
			if (i.match(query) || (!query && typeof i === 'string')) {
				value = JSON.parse(localStorage.getItem(i));
				results.push({
					key: i,
					val: value
				});
			}
		}
	}
	localStorage.setItem("itemcounter", results.length); // set item counter

	//localStorage filter

	/*function findLocalItems(query) {
		var i, results = [];
		for (i in localStorage) {
			if (localStorage.hasOwnProperty(i)) {
				if (i.match(query) || (!query && typeof i === 'string')) {
					value = JSON.parse(localStorage.getItem(i));
					results.push({
						key: i,
						val: value
					});
				}
			}
		}
		return results;
	}*/

	//End localStorage filter

	var i;
	var item = "";
	var query = "itemID_";
	//var index = 0;

	for (i in localStorage) {
		if (localStorage.hasOwnProperty(i)) {
			if (i.match(query) || (!query && typeof i === 'string')) {

				//console.log("OnLoad " + i);
				//index += 1;
				var index = i.substring(7);
				var itemID = localStorage.getItem(i);
				var itemQty = localStorage.getItem("itemQty_" + index);

				$.ajax({
					url: './functions/homeitems.php',
					method: 'POST',
					data: {
						clienthome: 'cartLoadItem',
						itemID: itemID,
						cartNumber: index,
						itemQty: itemQty
					},
					success: function (data) {
						item += data;
						document.getElementById("cartInsert").innerHTML = item;
						cartCalculator();
						headLoad();
					},
					error: function () {
						//alert("Ajax Call Failed!");
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
}

function removeItem(id) {
	//var alert = confirm("Are you sure to Delete this item to your Cart?");

	swal({
			title: "Delete Item!",
			text: "Are you sure to Delete this item to your Cart?",
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
					localStorage.removeItem("itemID_" + id);
					localStorage.removeItem("itemQty_" + id);
					localStorage.removeItem("itemPrice_" + id);
					localStorage.removeItem("orderType");
					localStorage.removeItem("promisedDate");
					loadItemCart();
					cartCalculator();
					headLoad();
					break;

				default:
					//swal("Button Direction Error!");
			}
		});

	/*if (alert == true) {
		localStorage.removeItem("itemID_" + id);
		localStorage.removeItem("itemQty_" + id);
		localStorage.removeItem("itemPrice_" + id);
		localStorage.removeItem("orderType");
		localStorage.removeItem("promisedDate");
		loadItemCart();
		cartCalculator();
		headLoad();
	}*/
}

function cartCalculator() {

	var cartNoOfItems = parseInt(localStorage.getItem("itemcounter"));
	var itemtotal = 0.00;
	var delivery = 0;
	var totalItemQty = 0;

	if (cartNoOfItems != 0) {

		var i, results = [];
		var query = "itemID_";
		var index = 0;

		for (i in localStorage) {
			if (localStorage.hasOwnProperty(i)) {
				if (i.match(query) || (!query && typeof i === 'string')) {
					index = i.substring(7);
					console.log(i + " " + index);

					var price = document.getElementById("itemPrice_" + index).innerHTML;

					var itemPrice = "";
					var nums = "";

					nums = price.split(",");
					for (i = 0; i < nums.length; i++) {
						itemPrice += nums[i];
						price = itemPrice;
					}

					var qty = parseInt(document.getElementById("number_" + index).value);
					var total = 0.00;

					total = price * qty;
					itemtotal += total;

					console.log(i + " " + itemtotal);

					var items = document.getElementsByClassName('inputItemQty'); // fix error
					for (var a = 0; a < items.length; a++) {
						totalItemQty += parseInt(items[a].value) / cartNoOfItems;
					}
					console.log("int qty " + totalItemQty);

					if (cartNoOfItems != 0 && totalItemQty != 0) {
						if ($('input[class="OrderType"]:checked').val() == "Delivery") {
							delivery = 50.00;
						} else {
							delivery = 0;
						}
					} else {
						delivery = 0;
					}

					document.getElementById("delFee").innerHTML = "₱ " + delivery;
					document.getElementById("itemTotal").innerHTML = "₱ " + Number(parseFloat(itemtotal).toFixed(2)).toLocaleString('en');
					document.getElementById("Total").innerHTML = "₱ " + Number(parseFloat(itemtotal + delivery).toFixed(2)).toLocaleString('en');
					document.getElementById("subTotal").innerHTML = "Subtotal (" + cartNoOfItems + " items)";
				}
			}
		}
	} else {
		document.getElementById("itemTotal").innerHTML = "₱ 0.00";
		document.getElementById("delFee").innerHTML = "₱ 0.00";
		document.getElementById("Total").innerHTML = "₱ 0.00";
		document.getElementById("subTotal").innerHTML = "Subtotal (0 items)";
		document.getElementById("cartInsert").innerHTML = "No Item Added!";
	}
	localStorage.setItem("totalToPay", document.getElementById("Total").innerHTML);
}

function clearCart() {
	//var ccalert = confirm("Are you sure to Clear items in your Cart?");

	var i, results = [];
	var query = "itemID_";

	for (i in localStorage) {
		if (localStorage.hasOwnProperty(i)) {
			if (i.match(query) || (!query && typeof i === 'string')) {
				value = JSON.parse(localStorage.getItem(i));
				results.push({
					key: i,
					val: value
				});
			}
		}
	}

	swal({
			title: "Clear Cart!",
			text: "Are you sure to Delete all item(s) in your Cart?",
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
					if (results.length > 0) {
						for (i in localStorage) {
							if (localStorage.hasOwnProperty(i)) {
								if (i.match(query) || (!query && typeof i === 'string')) {
									localStorage.removeItem("itemID_" + i.substring(7));
									localStorage.removeItem("itemQty_" + i.substring(7));
									localStorage.removeItem("itemPrice_" + i.substring(7));
									localStorage.removeItem("orderType");
									localStorage.removeItem("promisedDate");
								}
							}
						}
						loadItemCart();
						cartCalculator();
						headLoad();
					} else {
						swal("Cart is Already Empty!");
					}
					break;

				default:
					//swal("Button Direction Error!");
			}
		});

	/*if (ccalert == true) {
		if (results.length > 0) {
			for (i in localStorage) {
				if (localStorage.hasOwnProperty(i)) {
					if (i.match(query) || (!query && typeof i === 'string')) {
						localStorage.removeItem("itemID_" + i.substring(7));
						localStorage.removeItem("itemQty_" + i.substring(7));
						localStorage.removeItem("itemPrice_" + i.substring(7));
						localStorage.removeItem("orderType");
						localStorage.removeItem("promisedDate");
					}
				}
			}
			loadItemCart();
			cartCalculator();
			headLoad();
		} else {
			alert("Cart is Already Empty!");
		}
	}*/
}

function toPayment() {
	var orderType = $("input[name='myRadio']:checked").val();
	var noItem = parseInt(localStorage.getItem("itemcounter"));
	var date = document.getElementById("datepicker-12").value;

	if (orderType == undefined || noItem == 0 || date == "") {
		if (noItem == 0) {
			//alert("No Item was in the cart!");
			swal({
				title: "Empty Cart!",
				text: "No Item was in the cart!",
				icon: "warning",
				button: "Ok!",
			});
		} else if (orderType == undefined) {
			//alert("Please select Order Type!");
			swal({
				title: "Order Type!",
				text: "Please select Order Type!",
				icon: "warning",
				button: "Ok!",
			});
		} else if (date == "") { // find a date string validator
			//alert("Please add Promised Date!");
			swal({
				title: "Claim Date!",
				text: "Please add Promised Date!",
				icon: "warning",
				button: "Ok!",
			});
		}
	} else {
		localStorage.setItem("promisedDate", date);
		localStorage.setItem("orderType", orderType);
		window.location.href = 'payment.php';
	}
}
//End Cart

//Payment
function payOnload() {
	document.getElementById("pay1Amount").innerHTML = "Amount: " + localStorage.getItem("totalToPay");
	document.getElementById("pay2Amount").value = localStorage.getItem("totalToPay").substring(2);
	document.getElementById("paySender").value = localStorage.getItem("clFullName");
	document.getElementById("payContact").value = localStorage.getItem("clContact");
	//document.getElementById("payControlNo").value = '';
	if (localStorage.getItem("clFullName") != null && document.getElementById("paySender").value.length == 0) {
		/*if (localStorage.getItem("reloadcnt") == null) {
			localStorage.setItem("reloadcnt", 0);
			payOnload();
		} else {*/
		window.location.reload();
		console.log("Reloaded");
		/*
					console.log(localStorage.getItem("reloadcnt"));
					payOnload();
				}
			} else {
				localStorage.removeItem("reloadcnt");*/
	}
	console.log(localStorage.getItem("clFullName"));
	console.log(document.getElementById("paySender").value.length);
}
//End Payment

//Onload Thank You tab
function tyOnload() {
	var i, results = [];
	var query = "itemID_";

	for (i in localStorage) {
		if (localStorage.hasOwnProperty(i)) {
			if (i.match(query) || (!query && typeof i === 'string')) {
				localStorage.removeItem("itemID_" + i.substring(7));
				localStorage.removeItem("itemQty_" + i.substring(7));
				localStorage.removeItem("itemPrice_" + i.substring(7));
				localStorage.removeItem("orderType");
				localStorage.removeItem("promisedDate");
				localStorage.removeItem("tempTotal");
				localStorage.removeItem("totalToPay");
				localStorage.removeItem("itemcounter");
			}
		}
	}
}
//End Onload Thank You tab
