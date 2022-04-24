<?php
	$host = "localhost:3307";
	$database = "homelyfurn_db";
	$user = "root";
	$password = "";

	$connection = mysqli_connect($host, $user, $password, $database) or die('Cannot connect to database');
?>