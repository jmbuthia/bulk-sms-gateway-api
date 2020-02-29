<?php 

include '../../model/database/Constants.php';

// create connection
$connect = new mysqli(SERVERNAME, DB_USER, DB_PASSWORD,DB_NAME);

// check connection 
if($connect->connect_error) {
	die("Connection Failed : " . $connect->connect_error);
} else {
	// echo "Successfully Connected";
}