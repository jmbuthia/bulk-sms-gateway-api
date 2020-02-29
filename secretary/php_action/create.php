<?php 

require_once 'db_connect.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$firstname = $_POST['firstname'];
	/* $middlename = $_POST['middlename']; */
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$active = $_POST['active'];

	$sql = "INSERT INTO contacts (first_name,last_name, phone,  active) 
VALUES ('$firstname', '$lastname','$phone', $active)";
	$query = $connect->query($sql);

	if($query === TRUE) {			
		$validator['success'] = true;
		$validator['messages'] = "Successfully Added";		
	} else {		
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the contact information";
	}

	// close the database connection
	$connect->close();

	echo json_encode($validator);

}