<?php
// Start session management and include necessary functions
$lifetime= 60 * 30 ;
session_set_cookie_params($lifetime,'/');
session_start();
require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');
require_once('../message_sender/message_sender.php');
require_once('../message_sender/AfricasTalkingGateway.php');

require_once('../message_sender/sms_work.php');

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
	$action = filter_input(INPUT_GET, 'action');
	if ($action == NULL) {
		$action = 'dashboard';
		//echo 'action is null';
	}
}

if ($action == 'forgot_password' || $action == 'reset_code'){
	/* if ($action = 'forgot_password'  ){
		$action = 'forgot_password';
		
	}
	if($action = 'reset_code'){
		$action = 'reset_code';
	} */
}else {
	

// If the user isn't logged in, force the user to login
if (!isset($_SESSION['is_valid_admin']) ) {
	$action = 'login';
	/* if ($action = 'forgot_password'  ){
		$action = 'forgot_password';
		
	}
	 if($action = 'reset_code'){
		$action = 'reset_code';
	} */
	/* else {
		$action = 'login';
		//echo 'action is login';
	} */
	
}

if (!isset($_SESSION['category'])) {
	$action = 'login';
	/* if ($action = 'forgot_password'  ){
		$action = 'forgot_password';
		
	}
	else if($action = 'reset_code'){
		$action = 'reset_code';
	} */
	/* else {
		$action = 'login';
		//echo 'action is login';
	} */
}

}

if (isset($_SESSION['category'])) {
	$login_message="";
	if (strcmp($_SESSION['category'],"Administrator") != 0){
		$login_message.=" Your session have been nullified. Please login as administrator";
		$_SESSION = array();   // Clear all session data from memory
		session_destroy();     // Clean up the session ID
			
		include('../view/login.php');
		exit();
	}
}

if (isset($_SESSION['defaultPassword'])) {
	
	if (isset($action)) {
		if (strcmp($action,"logout") === 0){
			//include('p.php');
			//exit();
		}
		
	}else {
	
	if (strcmp($_SESSION['defaultPassword'],"defaultPassword") === 0){
		include('p.php');
		//exit();
	}
	}
}





// Perform the specified action
switch($action) {
	case 'login':
		$username=filter_input(INPUT_POST, 'username');
		$userPlainPassword=filter_input(INPUT_POST, 'ps');
		//echo "Username entered= ".$userMail." user ps entered= ".$userPsIn."<br>";
		//$userPs = hash('sha256', $plainPs);;
		//validate input
		
		  if(empty($username)==true){
			$errorMessage="Enter your username";
			//echo 'username empty ';
			//include 'indexxx.php';
		}
		else if (empty($userPlainPassword)==true){
			$errorMessage.=" Enter your password";
		//	echo 'password empty ';
			//include 'indexxx.php';
		}
		else {
			$errorMessage="";
			//echo 'is empty ';
		} 
		
		//echo "error messase php :". $errorMessage;
		if ($errorMessage!="") {
			//error in data entered
			//include 'indexxx.php';
			//echo 'not null ';
			//exit() ;
			
				include('../view/login.php');
					
			
			
		}
		else 
		{
			//echo 'in db operationpassword empty';
			$dbOperation= new DbOperation();
			$password=md5($username.$userPlainPassword);
			if ($dbOperation->is_valid_admin_login($username, $password)) {
				
				if(!$dbOperation->is_user_active($username)){
					
					$login_message = 'You session has been deactivated. Please consult System Administrator.';
					//echo '......trying to include view';
					include('../view/login.php');
					
				}else {  //start
					
					$userCategory=$dbOperation->getUserCategory($username);
					$company_name=$dbOperation->getUserCompanyName($username);
					
					if($dbOperation->is_company_active($company_name)){
						
					//this is site administrator
					if (strcmp($userCategory,"Super_Administrator") === 0){
						
						if (strcmp($userPlainPassword,"P@ssw0rd") === 0){
							$error_message="<div align=\"center\" style=\"color:orange\"><h1>You need to change the default password to continue.</h1></div>";
							$_SESSION['is_valid_admin'] = true;
							//$profile_picture=$dbOperation->userProfilePicture($username);
							$_SESSION['profile_picture'] = $dbOperation->userProfilePicture($username);
							$_SESSION['username']=$username;
							$_SESSION['company_name']=$company_name;
							$_SESSION['category']=$userCategory;
							$_SESSION['defaultPassword']="defaultPassword";
							
							include('p.php');
						}else {
							$_SESSION['is_valid_admin'] = true;
							//$profile_picture=$dbOperation->userProfilePicture($username);
							$_SESSION['profile_picture'] = $dbOperation->userProfilePicture($username);
							$_SESSION['username']=$username;
							$_SESSION['company_name']=$company_name;
							$_SESSION['category']=$userCategory;
							//echo "$profile_picture";
							//echo "$_SESSION['profile_picture']";
							header('Location: http://www.ruemerc.co.ke/apps/smsgateway/?action=dashboard');
							//include('admin_dashboard.php');
						}
						
						
						
					}
					
					
					//this is company administrator
					if (strcmp($userCategory,"Administrator") === 0){
						
						
						if (strcmp($userPlainPassword,"P@ssw0rd") === 0){
							$error_message="<div align=\"center\" style=\"color:orange\"><h1>You need to change the default password to continue.</h1></div>";
							$_SESSION['is_valid_admin'] = true;
							//$profile_picture=$dbOperation->userProfilePicture($username);
							$_SESSION['profile_picture'] = $dbOperation->userProfilePicture($username);
							$_SESSION['username']=$username;
							$_SESSION['company_name']=$company_name;
							$_SESSION['category']=$userCategory;
							$_SESSION['defaultPassword']="defaultPassword";
							
							include('p.php');
						}else {
							$_SESSION['is_valid_admin'] = true;
							//$profile_picture=$dbOperation->userProfilePicture($username);
							$_SESSION['profile_picture'] = $dbOperation->userProfilePicture($username);
							$_SESSION['username']=$username;
							$_SESSION['company_name']=$company_name;
							$_SESSION['category']=$userCategory;
							//echo "$profile_picture";
							//echo "$_SESSION['profile_picture']";
							header('Location: http://www.ruemerc.co.ke/apps/smsgateway/?action=dashboard');
							//include('admin_dashboard.php');
						}
						
						
						
					}
					
					
					//this is company secretary
					if (strcmp($userCategory,"Secretary") === 0){
						
						if (strcmp($userPlainPassword,"P@ssw0rd") === 0){
							$error_message="<div align=\"center\" style=\"color:orange\"><h1>You need to change the default password to continue.</h1></div>";
							$_SESSION['is_valid_admin'] = true;
							//$profile_picture=$dbOperation->userProfilePicture($username);
							$_SESSION['profile_picture'] = $dbOperation->userProfilePicture($username);
							$_SESSION['username']=$username;
							$_SESSION['company_name']=$company_name;
							$_SESSION['category']=$userCategory;
							$_SESSION['defaultPassword']="defaultPassword";
							
							include('p.php');
						}else {
							$_SESSION['is_valid_admin'] = true;
							//$profile_picture=$dbOperation->userProfilePicture($username);
							$_SESSION['profile_picture'] = $dbOperation->userProfilePicture($username);
							$_SESSION['username']=$username;
							$_SESSION['company_name']=$company_name;
							$_SESSION['category']=$userCategory;
							//echo "$profile_picture";
							//echo "$_SESSION['profile_picture']";
							header('Location: http://www.ruemerc.co.ke/apps/smsgateway/?action=dashboard');
							//include('admin_dashboard.php');
						}
						
						
						
					}
					
				}
					
					
					
					
					//stop
					else {
						$login_message = 'Sorry, your company is deactivated. For more information consult system Administrator.';
						//echo '......trying to include view';
						include('../view/login.php');
					}
				}
			} else {
				$login_message = 'Username or password incorrect.';
				//echo '......trying to include view';
				include('../view/login.php');
			}
			
		}
		
	
		break;
		
		
		
	case 'forgot_password':
		include('../view/forgot_password.php');
		break;
		
	
		
		
	case 'reset_code':
		include('../view/reset_code.php');
		break;
		

		
		
	case 'dashboard':
		
		if (isset($_SESSION['defaultPassword'])){
			if (strcmp($_SESSION['defaultPassword'],"defaultPassword") === 0){
				include('p.php');
			}
			else {
				include('admin_dashboard.php');
			}
			
		}
		else {
			include('admin_dashboard.php');
		}
		
		
		//include('admin_dashboard.php');
		break;
	case 'contact_management':
		include('contact_management.php');
		break;
	case 'profile':
		include('profile.php');
		break;
	case 'users':
		$dbOperation= new DbOperation();
		$categories=$dbOperation->getAllCategory();
		$_SESSION['categories']=$categories;
		include('users.php');
		break;
	case 'view_group':
		$groupid = filter_input(INPUT_GET, 'groupid');
		$dbOperation= new DbOperation();
		$groupName=$dbOperation->groupName($groupid);
		$_SESSION['groupid']=$groupid;
		$company_name=$_SESSION['company_name'];
		$members=$dbOperation->getMemberToJoinGroup($groupid,$company_name);
		$_SESSION['groupname']=$groupName;
		$_SESSION['members']=$members;
		//echo $groupid;
		//echo $groupName;
		include('view_group_members.php');
		break;
	case 'create_group':
		include('create_group.php');
		break;
	case 'logout':
		$_SESSION = array();   // Clear all session data from memory
		session_destroy();     // Clean up the session ID
		$login_message = 'You have been logged out.';
		
		if (isset($_SESSION['defaultPassword'])){
			if (strcmp($_SESSION['defaultPassword'],"defaultPassword") === 0){
				//include('../view/login.php');
				header('Location: ?action=dashboard');
			}
			else {
				//include('../view/login.php');
				header('Location: ?action=dashboard');
			}
			
		}
		else {
			//include('../view/login.php');
			header('Location: ?action=dashboard');
		}
		
		break;
	case 'send_group_message':
		
		include('send_group_message.php');
		break;
		
	case 'send_group_message_later':
		
		include('send_group_message_later.php');
		break;
		

		
	case 'send_individual_sms':
		//echo 'group id is= '.$_POST['groupid'];
		$phones= isset($_POST['phone']) ? $_POST['phone'] : false;
		$message= isset($_POST['message']) ? $_POST['message'] : false;
		//echo 'is array or not== '.is_array($groupids);
		//echo 'array value == '.$groupids[1];
		if ($phones && $message) {
		
			$phone_list=array();
			 $i=1;
			foreach ($phones as $phone):
		
			$phone_list+=array("p_".$i => $phone);
			
			$i++;
			endforeach;
		
			$contact_size=count($phone_list);
		
			//Sending the sms
			$username=$_SESSION['username'];
			
			
			
			M_sender::post_async('http://www.ruemerc.co.ke/apps/smsgateway/message_sender/post_async_sms_individual.php',$contact_size,$message,$phone_list,$username);
		
			
			$errorMessage='Message was sent';
			$status_color='green';
			include('send_message_to_individuals.php');
			
		} 
		else if(!$phones) {
			$errorMessage='Phone is required';
			$status_color='red';
			include('send_group_message.php');
		
		}
		else if(!$message) {
			//echo $message;
			$errorMessage='Message is required';
			$status_color='red';
			include('send_group_message.php');
			
		}
		//include('send_group_message.php');
		break;
		
	case 'send_individual_sms_later':
		//echo 'group id is= '.$_POST['groupid'];
		$phones= isset($_POST['phone']) ? $_POST['phone'] : false;
		$message= isset($_POST['message']) ? $_POST['message'] : false;
		$time= isset($_POST['time']) ? $_POST['time'] : false;
		//echo 'is array or not== '.is_array($groupids);
		//echo 'time == '.$time;
		$company_name=$_SESSION['company_name'];
		//echo "company name= ".$company_name;
		$username=$_SESSION['username'];
		//echo "username= ".$username;
		$dbOperation= new DbOperation();
		if ($phones && $message && $time) {
			//echo 'inside if';
			$status=$dbOperation->save_message_to_send_later($message, $time, $company_name);
			
			//echo "messageid= ".$status;
			
			if($status){
				
				foreach ($phones as $phone):
				
				$contactid=$dbOperation->getCompanyContactid($phone, $company_name);
				//echo "contact id = ".$contactid;
				
				$saving_status=$dbOperation->save_scheduled_sms_list_to_individual($status, $contactid,NULL, $username);
				
				//echo "saving status= ".$saving_status;
				endforeach;
				
				
				$errorMessage="Message Was Scheduled at $time";
				$status_color='green';
				include('send_individual_sms_later.php');
				
			}else {
				$errorMessage='Please ensure that date are correct and try again';
				$status_color='red';
				include('send_individual_sms_later.php');
			}
			
			
			
		}
		else if(!$phones) {
			$errorMessage='Phone is required';
			$status_color='red';
			include('send_individual_sms_later.php');
			
		}
		else if(!$message) {
			//echo $message;
			$errorMessage='Message is required';
			$status_color='red';
			include('send_individual_sms_later.php');
			
		}
		else if(!$time) {
			//echo $message;
			$errorMessage='Scheduled time is required';
			$status_color='red';
			include('send_individual_sms_later.php');
			
		}
	
		//include('send_group_message.php');
		break;
		
	
		
	case 'send_group_sms_later':
		//echo 'group id is= '.$_POST['groupid'];
	//	echo 'inside send group meso later';
		$groupids= isset($_POST['groupid']) ? $_POST['groupid'] : false;
		$message= isset($_POST['message']) ? $_POST['message'] : false;
		$time= isset($_POST['time']) ? $_POST['time'] : false;
		//echo 'is array or not== '.is_array($groupids);
		//echo 'array value == '.$groupids[1];
		$company_name=$_SESSION['company_name'];
		//echo "company name= ".$company_name;
		$username=$_SESSION['username'];
		$dbOperation= new DbOperation();
		if ($groupids && $message && $time) {
			
			$status=$dbOperation->save_message_to_send_later($message, $time, $company_name);
			
			//echo " message saving status is = ".$status;
			
			if($status){
				
				//loop group ids to send the message
				foreach ($groupids as $groupid):
				//echo " group id  is = ".$groupid;
				$contactids=$dbOperation->getAllContactidsOfGroup($groupid);
				//loop all active group members in that group
				foreach ($contactids as $contactid):
				
				//var_dump($contactid);
				//echo " contact id  is = ".$contactid[0];
				$saving_status=$dbOperation->save_scheduled_sms_list_to_individual($status, $contactid[0],$groupid, $username);
				
				//echo "saving status= ".$saving_status;
				endforeach;
				
				
				endforeach;
				
				
				//echo htmlentities($_POST['groupid'], ENT_QUOTES, "UTF-8");
				$errorMessage="Message Was Scheduled at $time";
				$status_color='green';
				include('send_group_message_later.php');
				
				
				
				
			}else {
				$errorMessage='Please ensure that date are correct and try again';
				$status_color='red';
				include('send_group_message_later.php');
			}
			
			
		}
		else if(!$groupids) {
			$errorMessage='Groups are required';
			$status_color='red';
			include('send_group_message_later.php');
			
		}
		else if(!$message) {
			//echo $message;
			$errorMessage='Message is required';
			$status_color='red';
			include('send_group_message_later.php');
			
		}
		else if(!$time) {
			//echo $message;
			$errorMessage='Scheduled time is required';
			$status_color='red';
			include('send_group_message_later.php');
			
		}
		//include('send_group_message.php');
		break;
		
	case 'send_group_sms':
		//echo 'group id is= '.$_POST['groupid'];
		$groupids= isset($_POST['groupid']) ? $_POST['groupid'] : false;
		$message= isset($_POST['message']) ? $_POST['message'] : false;
		//echo 'is array or not== '.is_array($groupids);
		//echo 'array value == '.$groupids[1];
		if ($groupids && $message) {
			
			$groupid_list=array();
			$i=1;
			foreach ($groupids as $groupid):
			
			$groupid_list+=array("g_".$i => $groupid);
			
			$i++;
			endforeach;
			
			$group_size=count($groupid_list);
			
			
			//Sending the sms
			$username=$_SESSION['username'];
			
			M_sender::post_async('http://www.ruemerc.co.ke/apps/smsgateway/message_sender/post_async_sms.php',$group_size,$message,$groupid_list,$username);
			
			//echo var_dump($groupid_list);
			//echo $message;
			
			
			
			//echo htmlentities($_POST['groupid'], ENT_QUOTES, "UTF-8");
			$errorMessage='Message was sent';
			$status_color='green';
			include('send_group_message.php');
		}
		else if(!$groupids) {
			$errorMessage='Groups are required';
			$status_color='red';
			include('send_group_message.php');
			
		}
		else if(!$message) {
			//echo $message;
			$errorMessage='Message is required';
			$status_color='red';
			include('send_group_message.php');
			
		}
		
		//include('send_group_message.php');
		break;
		
		
		
	case 'all_messages':
		//echo 'all_messages';
		include('all_messages.php');
		break;
		
		
	case 'all_scheduled_messages':
		//echo 'all_messages';
		include('all_scheduled_messages.php');
		break;
		
		
	case 'view_contacts':
		//echo 'all_messages';
		
		
		$messageid = filter_input(INPUT_GET, 'messageid');
		$dbOperation= new DbOperation();
		//$groupName=$dbOperation->groupName($groupid);
		$_SESSION['messageid']=$messageid;
		$members=$dbOperation->getAllMemberSentMessage($messageid);
		//$_SESSION['groupname']=$groupName;
		$_SESSION['members']=$members;
		//echo $groupid;
		//echo $groupName;
		
		
		
		
		
		
		include('view_contacts.php');
		break;
		
	case 'view_scheduled_contacts':
		//echo 'all_scheduled_messages';
		
		
		$messageid = filter_input(INPUT_GET, 'messageid');
		$dbOperation= new DbOperation();
		//$groupName=$dbOperation->groupName($groupid);
		$_SESSION['messageid']=$messageid;
		$members=$dbOperation->getAllMemberSentScheduledMessage($messageid);
		//$_SESSION['groupname']=$groupName;
		$_SESSION['members']=$members;
		//echo $groupid;
		//echo $groupName;
		
		
		
		
		
		
		include('view_scheduled_contacts.php');
		break;
		
		
	case 'individual_message':
		
		include('send_message_to_individuals.php');
		break;
		
	case 'send_message_to_individual_later':
		
		include('send_individual_sms_later.php');
		break;
		
}
?>