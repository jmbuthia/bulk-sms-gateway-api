<?php

require_once 'db_connect.php';

//if form is submitted
if($_POST) {
	
	$validator = array('success' => false, 'messages' => array());
	
	$groupname = $_POST['groupname'];
	/* $middlename = $_POST['middlename']; */
	/* $lastname = $_POST['lastname'];
	$phone = $_POST['phone']; */
	$active = $_POST['active'];
	
	$sql = "INSERT INTO contact_groups (group_name, active,datecreated)
	VALUES ('$groupname',  $active, now())";
	$query = $connect->query($sql);
	
	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Successfully Added";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the group information";
	}
	
	// close the database connection
	$connect->close();
	
	echo json_encode($validator);
	
}