<?php

// Start session management and include necessary functions
$lifetime= 60 * 30 ;
session_set_cookie_params($lifetime,'/');
session_start();
require_once('model/database/database.php');
require_once('model/database/DbOperations.php');


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
	$action = filter_input(INPUT_GET, 'action');
	if ($action == NULL) {
		$action = 'dashboard';
		//echo 'action is null';
	}
}

if ($action == 'forgot_password' || $action == 'reset_code'){

}else {
	

// If the user isn't logged in, force the user to login
if (!isset($_SESSION['is_valid_admin']) ) {
	$action = 'login';
	
	
}

if (!isset($_SESSION['category'])) {
	$action = 'login';
	
}

}

if (isset($_SESSION['category'])) {
	
	if (strcmp($_SESSION['category'],"Administrator") === 0){
		
		header('Location: admin?action=dashboard');
	}
	if (strcmp($_SESSION['category'],"Secretary") === 0){
		
		header('Location: secretary?action=dashboard');
	}
	
	if (strcmp($_SESSION['category'],"Super_Administrator") === 0){
		
		header('Location: super_admin?action=dashboard');
	}
	
}

if (isset($_SESSION['defaultPassword'])) {
	
	if (isset($action)) {
		if (strcmp($action,"logout") === 0){
			
		}
		
	}else {
	
	if (strcmp($_SESSION['defaultPassword'],"defaultPassword") === 0){
		include('admin/p.php');
		//exit();
	}
	}
}





// Perform the specified action
switch($action) {
	case 'login':
		$username=filter_input(INPUT_POST, 'username');
		$userPlainPassword=filter_input(INPUT_POST, 'ps');
		
		
		  if(empty($username)==true){
			$errorMessage="Enter your username";
			//echo 'username empty ';
			//include 'indexxx.php';
		}
		else if (empty($userPlainPassword)==true){
			$errorMessage.=" Enter your password";
		
		}
		else {
			$errorMessage="";
			//echo 'is empty ';
		} 
		
		//echo "error messase php :". $errorMessage;
		if ($errorMessage!="") {
			
			
				include('view/login_index.php');
					
			
			
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
					include('view/login_index.php');
					
				}else {
					$userCategory=$dbOperation->getUserCategory($username);
					$company_name=$dbOperation->getUserCompanyName($username);
					
					if($dbOperation->is_company_active($company_name)){
						
					
						//echo $company_name;
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
								
								include('admin/p.php');
							}else {
								$_SESSION['is_valid_admin'] = true;
								//$profile_picture=$dbOperation->userProfilePicture($username);
								$_SESSION['profile_picture'] = $dbOperation->userProfilePicture($username);
								$_SESSION['username']=$username;
								$_SESSION['company_name']=$company_name;
								$_SESSION['category']=$userCategory;
								//echo "$profile_picture";
								//echo "$_SESSION['profile_picture']";
								header('Location: super_admin?action=dashboard');
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
								
								include('admin/p.php');
							}else {
								$_SESSION['is_valid_admin'] = true;
								//$profile_picture=$dbOperation->userProfilePicture($username);
								$_SESSION['profile_picture'] = $dbOperation->userProfilePicture($username);
								$_SESSION['username']=$username;
								$_SESSION['company_name']=$company_name;
								$_SESSION['category']=$userCategory;
								//echo "$profile_picture";
								//echo "$_SESSION['profile_picture']";
								header('Location: admin?action=dashboard');
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
								
								include('admin/p.php');
							}else {
								$_SESSION['is_valid_admin'] = true;
								//$profile_picture=$dbOperation->userProfilePicture($username);
								$_SESSION['profile_picture'] = $dbOperation->userProfilePicture($username);
								$_SESSION['username']=$username;
								$_SESSION['company_name']=$company_name;
								$_SESSION['category']=$userCategory;
								//echo "$profile_picture";
								//echo "$_SESSION['profile_picture']";
								header('Location: secretary?action=dashboard');
								//include('admin_dashboard.php');
							}
							
							
							
						}
						
						
						
					}else {
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
								
								include('admin/p.php');
							}else {
								$_SESSION['is_valid_admin'] = true;
								//$profile_picture=$dbOperation->userProfilePicture($username);
								$_SESSION['profile_picture'] = $dbOperation->userProfilePicture($username);
								$_SESSION['username']=$username;
								$_SESSION['company_name']=$company_name;
								$_SESSION['category']=$userCategory;
								//echo "$profile_picture";
								//echo "$_SESSION['profile_picture']";
								header('Location: super_admin?action=dashboard');
								//include('admin_dashboard.php');
							}
							
							
							
						}else {
							$login_message = 'Sorry, your company is deactivated. For more information consult system Administrator.';
							//echo '......trying to include view';
							include('view/login_index.php');
						}
						
					}
				}
			 
			} else {
				$login_message = 'Username or password incorrect.';
				//echo '......trying to include view';
				include('view/login_index.php');
			}
			
		}
		
	
		break;
		
		
		
	case 'forgot_password':
		include('view/forgot_password_index.php');
		break;
		
	
		
		
	case 'reset_code':
		include('view/reset_code_index.php');
		break;
		

		
		
	case 'dashboard':
		
		
		
		if (isset($_SESSION['category'])) {
			
			if (strcmp($_SESSION['category'],"Administrator") === 0){
				//$errorMessage.=" Please login as administrator";
				//include('view/login_index.php');
				
				
				if (isset($_SESSION['defaultPassword'])){
					if (strcmp($_SESSION['defaultPassword'],"defaultPassword") === 0){
						include('admin/p.php');
					}
					else {
						//include('admin_dashboard.php');
						header('Location: admin?action=dashboard');
					}
					
				}
				else {
					//include('admin_dashboard.php');
					header('Location: admin?action=dashboard');
				}
				
				
				
				
				
			}
			
			if (strcmp($_SESSION['category'],"Super_Administrator") === 0){
			
				
				if (isset($_SESSION['defaultPassword'])){
					if (strcmp($_SESSION['defaultPassword'],"defaultPassword") === 0){
						include('admin/p.php');
					}
					else {
						//include('admin_dashboard.php');
						header('Location: super_admin?action=dashboard');
					}
					
				}
				else {
					//include('admin_dashboard.php');
					header('Location: super_admin?action=dashboard');
				}
				
				
			
				
			}
			
			if (strcmp($_SESSION['category'],"Secretary") === 0){
				
				
				if (isset($_SESSION['defaultPassword'])){
					if (strcmp($_SESSION['defaultPassword'],"defaultPassword") === 0){
						include('admin/p.php');
					}
					else {
						//include('admin_dashboard.php');
						header('Location: secretary?action=dashboard');
					}
					
				}
				else {
					//include('admin_dashboard.php');
					header('Location: secretary?action=dashboard');
				}
				
				
				
				
			}
			
		}else {
			include('view/login_index.php');
		}
		
	
		
		//include('admin_dashboard.php');
		break;
	
	

}
?>





<?php
//header('Location: admin')
?>