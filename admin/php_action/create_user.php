<?php

require_once 'db_connect.php';
//require_once('../../model/database/database.php');
//require_once('../../model/database/DbOperations.php');
session_start();
//if form is submitted
$company_name=$_SESSION['company_name'];
if($_POST) {
	
	$validator = array('success' => false, 'messages' => array());
	
	$firstname = $_POST['firstname'];
	/* $middlename = $_POST['middlename']; */
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$active = $_POST['active'];
	$username = $_POST['username'];
	$gender = $_POST['gender'];
	//$category = $_POST['category'];
	
	//default password is
	$password_to_hash="$username"."P@ssw0rd";
	$password=md5($password_to_hash);
	
	if ($phone[0]=='0'){
		$phone="+254".substr($phone, 1);
	}
	
	//create user query
	 $sql_create_user="INSERT INTO `users` 
(`username`, `first_name`,`last_name`,`gender`,`active`, `phone`,`datecreated`)
VALUES ('$username','$firstname', '$lastname','$gender',$active,'$phone',now());";
	
	 //create login query
	 $sql_create_login="INSERT INTO `login`(`username`, `password`,`profile_picture`)
 VALUES ('$username','$password',default);";
	 
	 //create contact details
	 $sql_contact_details = "INSERT INTO contacts (first_name,last_name, phone,  active,company_name)
	 VALUES ('$firstname', '$lastname','$phone', $active,'$company_name')"; 
	 
	 //create user rights
	 $sql_user_rights ="INSERT INTO `user_rights`(`username`, `category_name`) VALUES ('$username','Secretary');";
	 
	 ////create user company
	 $sql_user_company ="INSERT INTO `users_company`(`username`, `company_name`) VALUES ('$username','$company_name');";

	 
	 //checking if username exists
		 $query1="SELECT userid FROM users WHERE username='$username'";
		 $query_exists = $connect->query($query1); 
	
		 if($query_exists->num_rows > 0 || !is_numeric($phone)){
		
		
		if($query_exists->num_rows > 0 ){
			$validator['success'] = false;
			$validator['messages'] = "User name exists. Try another one.";
		}
		if(!is_numeric($phone)){
			$validator['success'] = false;
			$validator['messages'] = "Enter a valid phone number. eg 0717925741 or +254717925741";
		}
	}
	else {
		$query_phone="SELECT contactid FROM contacts WHERE phone='$phone' AND company_name='$company_name'";
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
				
				//saving user company
				$create_user_company=$connect->query($sql_user_company);
				
				if (!$create_user_result || !$create_login_result || !$create_user_rights || !$create_user_company){
					/* Rollback */
					$validator['success'] = false;
					$validator['messages'] = "An error occurred while saving the record. Please try again.";
					//$validator['messages'] = "create_user_rights= ".$create_user_rights." phone exist and create user company= ".$create_user_company;
					
					
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
		
		//saving user company
		$create_user_company=$connect->query($sql_user_company);
		
		if (!$create_user_result || !$create_login_result || !$contact_details_result || !$create_user_rights || !$create_user_company){
			/* Rollback */
			$validator['success'] = false;
			$validator['messages'] = "An error occurred while saving the record. Please try again.";
			//$validator['messages'] = "create_user_rights= ".$create_user_rights."  phone doesnt exist and create user company= ".$create_user_company;
			
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