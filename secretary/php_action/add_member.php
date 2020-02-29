<?php
session_start();
require_once 'db_connect.php';

//if form is submitted
if($_POST) {
	
	$validator = array('success' => false, 'messages' => array());
	
	$contactids= $_POST['contactid'];
	/* $middlename = $_POST['middlename']; */
	/* $lastname = $_POST['lastname'];
	$phone = $_POST['phone']; */
	$active = $_POST['active'];
	$groupid=$_SESSION['groupid'];
	
	
	foreach ($contactids as $contactid):
		
		$sql = "INSERT INTO group_members (groupid,contactid,active,datejoined)
		VALUES ($groupid,$contactid, $active,now())";
		$query = $connect->query($sql);
		
		
		endforeach;
	
	
	
	
	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Member Successfully Added";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the new member information";
	}
	
	// close the database connection
	$connect->close();
	
	echo json_encode($validator);
	
}