<?php

require_once 'db_connect.php';

//if form is submitted
if($_POST) {
	
	$validator = array('success' => false, 'messages' => array());
	
	$groupid = $_POST['member_id'];
	$groupname = $_POST['editGroupName'];
	/* $middlename = $_POST['editMiddleName']; */
	/* $lastname = $_POST['editLastName'];
	$phone = $_POST['editContact']; */
	$active = $_POST['editActive'];
	
	$sql = "UPDATE contact_groups SET group_name = '$groupname',  active = $active WHERE groupid = $groupid";
	$query = $connect->query($sql);
	
	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Updated Successfully";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error while updatting group information";
	}
	
	// close the database connection
	$connect->close();
	
	echo json_encode($validator);
	
}