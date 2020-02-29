<?php
session_start();
require_once 'db_connect.php';

//if form is submitted
if($_POST) {
	
	$validator = array('success' => false, 'messages' => array());
	
	 $contactid = $_POST['member_id'];
	 
	$active = $_POST['editActive'];
	$groupid=$_SESSION['groupid'];
	
	$sql = "UPDATE group_members SET active = '$active' WHERE contactid = $contactid AND groupid=$groupid";
	$query = $connect->query($sql);
	
	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Member updated Successfully";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error while updating member information";
	}
	
	// close the database connection
	$connect->close();
	
	echo json_encode($validator);
	
}