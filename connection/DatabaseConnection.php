<?php
	$dbname = "onlineordersystem";
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$con = mysqli_connect($hostname, $username, $password, $dbname );
	mysqli_set_charset($con, "utf8");
	date_default_timezone_set('Asia/Dhaka');
	$currentDate = date('Y-m-d H:i:s');
?>
