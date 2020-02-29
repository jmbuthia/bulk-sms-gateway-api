<?php 

require_once 'db_connect.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$contactid = $_POST['member_id'];
	$firstname = $_POST['editFirstName'];
	/* $middlename = $_POST['editMiddleName']; */
	 $lastname = $_POST['editLastName']; 
	$phone = $_POST['editContact'];
	$active = $_POST['editActive'];
	
	
		$sql = "UPDATE contacts SET first_name = '$firstname', last_name = '$lastname', phone = '$phone', active = '$active' WHERE contactid = $contactid";
		$query = $connect->query($sql);
		
		if($query === TRUE) {
			$validator['success'] = true;
			$validator['messages'] = "Updated Successfully";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while updating contact information";
		}
	
		

	// close the database connection
	$connect->close();

	echo json_encode($validator);

}