<?php

require_once 'db_connect.php';
require_once('../../model/database/database.php');
require_once('../../model/database/DbOperations.php');
session_start();
//if form is submitted
if($_POST) {
	
	$validator = array('success' => false, 'messages' => array());
	
	$dbOperation= new DbOperation();
	
	$userid = $_POST['member_id'];
	$firstname = $_POST['editFirstName'];
	$gender = $_POST['editGender']; 
	$lastname = $_POST['editLastName'];
	$phone = $_POST['editContact'];
	$active = $_POST['editActive'];
	$contactid=$dbOperation->contactidFromUserId($userid);
	$phone_before=$dbOperation->getUserPhoneBefore($userid);
	
	$username=$dbOperation->userNameFromUserId($userid);
	
	//update user query
	$sql_update_user = "UPDATE `users` SET `first_name`='$firstname',
	`last_name`='$lastname',`gender`='$gender',
	`active`=$active,`phone`='$phone'
	WHERE `userid` = {$userid}";
	
	//update contact query
	$sql_update_contact= "UPDATE contacts SET first_name = '$firstname',
	last_name = '$lastname', phone = '$phone',
	active = $active WHERE contactid = $contactid";
	
	
	
	
	if($_SESSION['username'] == $username && $active !=1){
		$validator['success'] = false;
		$validator['messages'] = "You cannot deactivate the current User: ".$username;
		
	}else {
		
		if($dbOperation->is_phone_the_same($phone_before)){
			
			try {
				/* disable autocommit */
				$connect->autocommit(FALSE);
				
				//update user
				$update_user_result= $connect->query($sql_update_user);
				
				
				//update contacts
				$update_contact_result=$connect->query($sql_update_contact);
				
				
				if (!$update_user_result || !$update_contact_result){
					/* Rollback */
					$validator['success'] = false;
					$validator['messages'] = "An error occurred while updating the record. Please try again.";
					//$validator['messages'] ="contactid= $contactid"." userid= $userid"." update_user_result= ".$update_user_result."  update_contact_result= ".$update_contact_result;
					
					
					$connect->rollback();
				}
				else {
					$validator['success'] = true;
					$validator['messages'] = " User Successfully updated";
				}
				
			}
			catch (Exception $e) {
				
				/* Rollback */
				
				
				$validator['success'] = false;
				$validator['messages'] = "An error occurred while updating the record. Error= ".$e;
				
				$connect->rollback();
			}
			
			/* commit insert */
			$connect->commit();
			
			
			
		}else {
			$query = $connect->query($sql_update_user);
			
			if($query === TRUE) {
				$validator['success'] = true;
				$validator['messages'] = "Updated Successfully";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating user information";
			}
			
		}
		
		
	}
	

	
	// close the database connection
	$connect->close();
	
	echo json_encode($validator);
	
}