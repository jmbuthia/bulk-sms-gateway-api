<?php

require_once 'db_connect.php';
//require_once('../../model/database/database.php');
//require_once('../../model/database/DbOperations.php');

//if form is submitted
if($_POST) {
	
	$validator = array('success' => false, 'messages' => array());
	
	$firstname = $_POST['firstname'];
	/* $middlename = $_POST['middlename']; */
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$active = $_POST['active'];
	$username = $_POST['username'];
	$gender = $_POST['gender'];
	$category = $_POST['category'];
	
	//default password is
	$password_to_hash="$username"."P@ssw0rd";
	$password=md5($password_to_hash);
	
	
	//create user query
	 $sql_create_user="INSERT INTO `users` 
(`username`, `first_name`,`last_name`,`gender`,`active`, `phone`,`datecreated`)
VALUES ('$username','$firstname', '$lastname','$gender',$active,'$phone',now());";
	
	 //create login query
	 $sql_create_login="INSERT INTO `login`(`username`, `password`,`profile_picture`)
 VALUES ('$username','$password',default);";
	 
	 //create contact details
	 $sql_contact_details = "INSERT INTO contacts (first_name,last_name, phone,  active)
	 VALUES ('$firstname', '$lastname','$phone', $active)"; 
	 
	 //create user rights
	 $sql_user_rights ="INSERT INTO `user_rights`(`username`, `category_name`) VALUES ('$username','$category');";
	 

	 
	 //checking if username exists
		 $query1="SELECT userid FROM users WHERE username='$username'";
		 $query_exists = $connect->query($query1); 
	
	 if($query_exists->num_rows > 0){
		$validator['success'] = false;
		$validator['messages'] = "User name exists. Try another one.";
	}
	else {
		$query_phone="SELECT contactid FROM contacts WHERE phone='$phone'";
		$query_phone_exists = $connect->query($query_phone); 
		if($query_phone_exists->num_rows > 0){
			
			
			
			try {
				/* disable autocommit */
				$connect->autocommit(FALSE);
				
				//saving user
				$create_user_result= $connect->query($sql_create_user);
				
				//saving login
				$create_login_result=$connect->query($sql_create_login);
				
				//saving user rights
				$create_user_rights=$connect->query($sql_user_rights);
				
				
				if (!$create_user_result || !$create_login_result || !$create_user_rights){
					/* Rollback */
					$validator['success'] = false;
					$validator['messages'] = "An error occurred while saving the record. Please try again.";
					//$validator['messages'] = "create_user_rights= ".$create_user_rights." ";
					
					
					$connect->rollback();
				}
				else {
					$validator['success'] = true;
					$validator['messages'] = " User Successfully Created";
				}
				
			}
			catch (Exception $e) {
				
				/* Rollback */
				
				
				$validator['success'] = false;
				$validator['messages'] = "An error occurred while saving the record. Error= ".$e;
				
				$connect->rollback();
			}
			
			/* commit insert */
			$connect->commit();
			
			
			// close the database connection
			$connect->close();
			
			
			
		}
		else {
			
	
		try {
		/* disable autocommit */
		$connect->autocommit(FALSE);
		
		//saving user
		$create_user_result= $connect->query($sql_create_user);
		
		//saving login
		$create_login_result=$connect->query($sql_create_login);
		
		//saving contact
		$contact_details_result=$connect->query($sql_contact_details);
		
		//saving user rights
		$create_user_rights=$connect->query($sql_user_rights);
		
		if (!$create_user_result || !$create_login_result || !$contact_details_result || !$create_user_rights){
			/* Rollback */
			$validator['success'] = false;
			$validator['messages'] = "An error occurred while saving the record. Please try again.";
			
			$connect->rollback();
		}
		else {
			$validator['success'] = true;
			$validator['messages'] = " User Successfully Created";
		}
		
		}
		catch (Exception $e) {
			
			/* Rollback */
			
			
			$validator['success'] = false;
			$validator['messages'] = "An error occurred while saving the record. Error= ".$e;
			
			$connect->rollback();
		}
		
		/* commit insert */
		$connect->commit();
				

	// close the database connection
	$connect->close();
	
	 } 
		}
	
	echo json_encode($validator);
	
}