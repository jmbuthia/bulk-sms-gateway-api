
<?php
require_once 'db_connect.php';
require_once('../../model/database/database.php');
require_once('../../model/database/DbOperations.php');
session_start();
require_once 'db_connect.php';

$validator= array('success' => false, 'messages' => array());

$userid= $_POST['member_id'];

$dbOperation= new DbOperation();
//username

$username=$dbOperation->userNameFromUserId($userid);

//remove user query
$sql_remove_user = "DELETE FROM users WHERE username = '{$username}'";

//remove login query
$sql_remove_login = "DELETE FROM login WHERE username = '{$username}'";

//remove user rights query
$sql_remove_user_rights = "DELETE FROM user_rights WHERE username = '{$username}'";

//remove contact query
//$sql_remove_contacts = "DELETE FROM contacts WHERE phone=in(SELECT `phone` FROM `users` WHERE `username` = {$username})";

if($_SESSION['username'] == $username){
	$validator['success'] = false;
	$validator['messages'] = "You cannot remove the current User: ".$username;
}
else{
	
	try {
		/* disable autocommit */
		$connect->autocommit(FALSE);
		
		//delete user
		$delete_user_result= $connect->query($sql_remove_user);
		
		//delete login
		$delete_login_result=$connect->query($sql_remove_login);
		
		//delete user rights
		$delete_user_rights=$connect->query($sql_remove_user_rights);
		
		//delete contacts
		//$delete_contacts=$connect->query($sql_remove_contacts);
		
		
		if (!$delete_user_result || !$delete_login_result || !$delete_user_rights /* || !$delete_contacts */){
			/* Rollback */
			$validator['success'] = false;
			$validator['messages'] = "An error occurred while removing the record. Please try again.";
			//$validator['messages'] = "username = ".$username." delete_user_result= ".$delete_user_result."  delete_login_result= ".$delete_login_result." delete_user_rights".$delete_user_rights;
			
			
			$connect->rollback();
		}
		else {
			$validator['success'] = true;
			$validator['messages'] = " User Successfully removed";
		}
		
	}
	catch (Exception $e) {
		
		/* Rollback */
		
		
		$validator['success'] = false;
		$validator['messages'] = "An error occurred while removing the record. Error= ".$e;
		
		$connect->rollback();
	}
	
	/* commit insert */
	$connect->commit();
	
	
	

}


// close database connection
$connect->close();

echo json_encode($validator);