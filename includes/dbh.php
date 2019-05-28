<?php

$dbhServername = "Localhost";
$dbhusername = "root";
$dbhpassword = "";
$dbhname = "bloggershive";

// Create connection

$conn = mysqli_connect($dbhServername, $dbhusername, $dbhpassword, $dbhname);

// Check connection
if (!$conn ) {
	die("Connection failed:" . mysqli_connect_error());
}