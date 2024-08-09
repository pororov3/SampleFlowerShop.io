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

function itemAdd() {
	swal({
		title: "Add Item!",
		text: "Adding...",
		icon: "info",
		button: "Ok!",
	});
	var image_name = $('#fileVal').val();

	if (image_name == '') {
		swal({
			title: "Add Image!",
			text: "Please Select Image!",
			icon: "error",
			button: "Ok!",
		});
		return false;
	} else {

		var fd = new FormData();

		fd.append('Item', 'addItem');
		fd.append('aIName', $("#aItemName").val());
		fd.append('aIPrice', $("#aItemPrice").val());
		fd.append('aIDetails', $("#aItemDetails").val());
		fd.append('aIOccation', $("#aItemOccation").val());
		fd.append('file', document.getElementById('fileVal').files[0]);

		$.ajax({
			url: 'functions/item-process.php',
			method: "POST",
			data: fd,
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				console.log(data);
				if (data == 'New record created successfully') {
					/*document.getElementById('Succesfully').style.display = "block";
					$("#Succesfully").hide(5000);*/
					swal({
						title: "Add Item!",
						text: "New Item Added!",
						icon: "success",
						button: "Ok!",
					});
					logger("Add Item Tab Perform: New Item Added!");
				} else {
					/*document.getElementById('Succesfully').style.display = "block";*/
					swal({
						title: "Add Item!",
						text: "Item Adding Failed!",
						icon: "error",
						button: "Ok!",
					});
					/*document.getElementById('Succesfully').innerHTML = data;
					$("#Succesfully").hide(5000);*/
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
	}
}

function chkInputAddItem() { //check later
	var txtname = document.getElementById("aItemName").onchange();
	var txtprice = document.getElementById("aItemPrice").onchange();
	var txtdesc = document.getElementById("aItemDetails").onchange();

	alert(txtname);

	if (this.val() == '') {
		document.getElementById('cancel').style.display = "block";
		$("#cancel").hide(5000);
	} else {
		document.getElementById('cancel').style.display = "none";
	}
}

//Item
function loadItem() {
	$.ajax({
		url: 'functions/item-process.php',
		method: "POST",
		data: {
			Item: 'loadItem'
		},
		success: function (data) {
			document.getElementById("insertItem").innerHTML = data;
			Succesfully();
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

//End Item