<?php session_start(); echo $_SESSION['type']."-".$_SESSION['pos']."-".$_SESSION['name'];?><?php session_start(); echo $_SESSION['type']."-".$_SESSION['pos']."-".$_SESSION['name'];?><?php session_start(); echo $_SESSION['type']."-".$_SESSION['pos']."-".$_SESSION['name'];?><?php session_start(); echo $_SESSION['type']."-".$_SESSION['pos']."-".$_SESSION['name'];?>getuser();
	function getuser() {
		$.ajax({
			url: 'functions/admin-JS-pHp.php',
			method: "POST",
			data: {
				getuser: 'getuser'
			},
			success: function (data) {
				document.getElementById("userlabel").innerHTML = data;
			},
			error: function () {
				alert('There was some error performing the AJAX call!');
			}
		});
	}
getuser();
	function getuser() {
		$.ajax({
			url: 'functions/admin-JS-pHp.php',
			method: "POST",
			data: {
				getuser: 'getuser'
			},
			success: function (data) {
				document.getElementById("userlabel").innerHTML = data;
			},
			error: function () {
				alert('There was some error performing the AJAX call!');
			}
		});
	}
// JavaScript Document
$(document).ready(function () {
	/*
	fix time in logs
	*/
	//session but not needed
	function onloadchk() {
		$.ajax({
			url: 'functions/admin-JS-pHp.php',
			method: "POST",
			data: {
				chklogin: 'login'
			},
			success: function (data) {},
			error: function () {
				alert('There was some error performing the AJAX call!');
			}
		});
	}
	
	function logger(acts) {
		$.ajax({
			url: 'functions/admin-JS-pHp.php',
			method: "POST",
			data: {
				logger: 'log',
				logAction: acts
			},
			success: function (data) {
			},
			error: function () {
				alert('There was some error performing the AJAX call!');
			}
		});
	}
	
});
