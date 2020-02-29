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
	
	
	
		
		if (is_numeric($phone)){
			
			if ($phone[0]=='+'){
				
				
				$sql = "UPDATE contacts SET first_name = '$firstname', last_name = '$lastname', phone = '$phone', active = '$active' WHERE contactid = $contactid";
				$query = $connect->query($sql);
				
				if($query === TRUE) {
					$validator['success'] = true;
					$validator['messages'] = "Updated Successfully";
				} else {
					$validator['success'] = false;
					$validator['messages'] = "Error while updating contact information";
				}
				
			}elseif ($phone[0]=='0'){
				$phone="+254".substr($phone, 1);
				
				
				$sql = "UPDATE contacts SET first_name = '$firstname', last_name = '$lastname', phone = '$phone', active = '$active' WHERE contactid = $contactid";
				$query = $connect->query($sql);
				
				if($query === TRUE) {
					$validator['success'] = true;
					$validator['messages'] = "Updated Successfully";
				} else {
					$validator['success'] = false;
					$validator['messages'] = "Error while updating contact information";
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