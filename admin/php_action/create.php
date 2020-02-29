<?php 

require_once 'db_connect.php';
session_start();
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$firstname = $_POST['firstname'];
	/* $middlename = $_POST['middlename']; */
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$active = $_POST['active'];
	$company_name=$_SESSION['company_name'];
	
	if (is_numeric($phone)){
		
		if ($phone[0]=='+'){
			
			$sql = "INSERT INTO contacts (first_name,last_name, phone,  active, `company_name`)
			VALUES ('$firstname', '$lastname','$phone', $active, '$company_name')";
			$query = $connect->query($sql);
			
			if($query === TRUE) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully Added";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the contact information";
			}
			
		}elseif ($phone[0]=='0'){
			$phone="+254".substr($phone, 1);
			
			$sql = "INSERT INTO contacts (first_name,last_name, phone,  active, `company_name`)
			VALUES ('$firstname', '$lastname','$phone', $active, '$company_name')";
			$query = $connect->query($sql);
			
			if($query === TRUE) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully Added";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the contact information";
			}
			
		}else {
			$validator['success'] = false;
			$validator['messages'] = "Enter a valid phone number. eg 0717925741 or +254717925741";
		}
		
		
	}else {
		$validator['success'] = false;
		$validator['messages'] = "Enter a valid phone number. eg 0717925741 or +254717925741";
	}

	

	// close the database connection
	$connect->close();

	echo json_encode($validator);

}