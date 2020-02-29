<?php
require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');
require_once('../message_sender/message_sender.php');
require_once('../message_sender/AfricasTalkingGateway.php');

require_once('../message_sender/sms_work.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
	$action = filter_input(INPUT_GET, 'action');
	if ($action == NULL) {
		$action = 'dashboard';
		//echo 'action is null';
	}
}
switch($action) {
	case 'send_code':
		
		$username=filter_input(INPUT_POST, 'username');
		$phone=filter_input(INPUT_POST, 'phone');
		
		$dbOperation= new DbOperation();
		
		//check if username exists
		if($dbOperation->isUsernameExist($username)){
			//echo "Username entered= ".$username." phone= ".$phone."<br>";
			
			$user_phone=$dbOperation->getUserPhoneNumber($username);
			
			if (strcmp($phone,$user_phone) === 0){
				
				
				$reset_code= n_digit_random(5);
				
				//delete all the previous forgot password details if exists
				$dbOperation->deleteAllForgotPasswordDetailsIfExists($username);
				
				//save the reset code in the database
				if($dbOperation->save_forgot_password_code($username, $reset_code)){
					
					//its saved in the db
					
					//send the code in the user phone
					$message="Hi $username, somebody asked to reset your smsgateway password.
Your reset code is: $reset_code .
If you didn't ask for this, just ignore.";
					$phone_list=array();
					$phone_list+=array("p_1" => $user_phone);
					$contact_size=count($phone_list);
					
					//Sending the sms
					
					M_sender::post_async('http://www.ruemerc.co.ke/apps/smsgateway/message_sender/post_async_sms_individual.php',$contact_size,$message,$phone_list,$username);
					
					$login_message ='Enter the code that was sent to your phone number';
					
					//direct the user to reset the password
					include('../view/reset_code.php');
				}
				else{
					
					//an error occurred while saving in db
				}
				
				
				
			}
			else {
				
				$login_message ='Your phone number doesn\'t match our record';
				include('../view/forgot_password.php');
			}
			
		}
		else {
			 
			$login_message ='Only registered user should use this service';
			include('../view/forgot_password.php');
		}
		
		
		
		
		//include('../view/forgot_password.php');
		break;
		
	case 'dashboard':
		
		header('Location: .');
		break;
		
	case 'reset':
		
		$reset_code=filter_input(INPUT_POST, 'resetCode');
		$new_password=filter_input(INPUT_POST, 'newPassword');
		$confirm_password=filter_input(INPUT_POST, 'confirmPassword');
		
		$dbOperation= new DbOperation();
		
		//Check if reset code exists not less than 1 day and not greater than today
		
		if($dbOperation->is_reset_code_exist($reset_code)){
			//reset code is valid
			
			//check if the password matches
			if(strcmp($new_password,$confirm_password) === 0){
				
				//password match and reset code is cool
								
				//getting the username from reset code
				$username=$dbOperation->getUsernameFromResetCode($reset_code);
				
				// now change password
				
				//hash password
				$hashed_password=md5($username.$new_password);
				
				//save the new record in the database
				$saving_status=$dbOperation->changePassword($hashed_password, $username);
				
				//if is saved successfully
				if($saving_status > 0){
					
					$dbOperation->deleteAllForgotPasswordDetailsIfExists($username);
					
					$login_message ='You reset password successfully. Now login with your new password';
					include('../view/login.php');
					
				}else {
					$login_message ='An error occurred while saving your record. Please try again';
					include('../view/reset_code.php');
				}
				
				
				
			}else {
				$login_message ='Your new password should match confirm password';
				include('../view/reset_code.php');
			}
			
		}else {
			$login_message ='Your reset code is invalid or is expired. Request another one here';
			include('../view/forgot_password.php');
		}
		
		
		break;
}
function n_digit_random($digits){
	return rand(pow(10, $digits - 1) - 1, pow(10, $digits) - 1);
}
