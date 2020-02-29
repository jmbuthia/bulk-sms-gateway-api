<?php
	class DbOperation{
		private $con;
		function __construct(){
			require_once dirname(__FILE__).'/Db_Connect.php';
			$db= new DbConnect();
			$this->con= $db->connect();
		}
		public function userLogin($username,$pass){
			$password=md5($pass);
			$query="SELECT id FROM users WHERE username=? AND password=?";
			$stmt=$this->con->prepare($query);
			$stmt->bind_param("ss",$username,$password);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;
		}
		public function getUserByUsername($username){
			$query="SELECT * FROM users WHERE username=?";
			$stmt=$this->con->prepare($query);
			$stmt->bind_param("s",$username);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
			
			
		}
		
		public function getGroupidToSendSheduleSMS($messageid){
			$query="SELECT DISTINCT scheduled_sms_list.groupid FROM 
					`scheduled_sms_list`  WHERE `messageid` =:messageid";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":messageid",$messageid);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function userProfilePicture($username){
			$query="SELECT profile_picture FROM login WHERE username=:username";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":username",$username);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getUserCompanyName($username){
			$query="SELECT `company_name` FROM `users_company` WHERE `username` =:username";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":username",$username);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function oldPasswordInDb($username){
			$query="SELECT `password` FROM `login` WHERE `username`=:username";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":username",$username);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getUserPhoneBefore($userid){
			$query="SELECT `phone` FROM `users` WHERE userid=:userid";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":userid",$userid);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalUser($company_name){
			$query="SELECT COUNT(*) FROM `users` INNER JOIN users_company ON 
					users.username=users_company.username WHERE 
					users_company.company_name ='$company_name'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}public function getTotalAdmin(){
			$query="SELECT COUNT(*) FROM `users` INNER JOIN user_rights ON
			users.username=user_rights.username WHERE
			user_rights.category_name ='Administrator'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalAddressBook($company_name){
			$query="SELECT count(*) FROM `contacts` WHERE company_name='$company_name' ";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalActiveContacts($company_name){
			$query="SELECT count(*) FROM `contacts` WHERE `active` = 1 AND company_name='$company_name'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalInactiveContacts($company_name){
			$query="SELECT count(*) FROM `contacts` WHERE `active` != 1 AND company_name='$company_name'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalGroups($company_name){
			$query="SELECT COUNT(*) FROM `contact_groups` WHERE company_name='$company_name'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalActiveGroups($company_name){
			$query="SELECT COUNT(*) FROM `contact_groups` WHERE `active` = 1 AND company_name='$company_name'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalInactiveGroups($company_name){
			$query="SELECT COUNT(*) FROM `contact_groups` WHERE `active` != 1 AND company_name='$company_name'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		
		
		public function getTotalActiveUser($company_name){
			$query="SELECT COUNT(*) FROM `users` INNER JOIN users_company ON
			users.username=users_company.username WHERE `users`.`active`=1 AND
			users_company.company_name ='$company_name'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalActiveAdmin(){
			$query="SELECT COUNT(*) FROM `users` INNER JOIN user_rights ON
			users.username=user_rights.username WHERE `users`.`active`=1 AND
			user_rights.category_name ='Administrator'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalMessages($company_name){
			$query="SELECT COUNT(*) FROM `messages` WHERE company_name='$company_name'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalSecretaryMessages($company_name,$username){
			$query="SELECT COUNT(*) FROM `messages` INNER JOIN sent_messages ON 
						messages.messageid=sent_messages.messageid WHERE 
						company_name='$company_name' AND sent_messages.sent_by ='$username'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		
		public function getTotalMessagesToGroups($company_name){
			$query="SELECT COUNT(*) FROM `sent_messages` INNER JOIN users_company ON
					 sent_messages.sent_by=users_company.username WHERE 
					company_name='$company_name' AND  `groupid` IS NOT null";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalSecretaryMessagesToGroups($company_name,$username){
			$query="SELECT COUNT(*) FROM `sent_messages` INNER JOIN users_company ON
			sent_messages.sent_by=users_company.username WHERE sent_messages.sent_by='$username' AND
			company_name='$company_name' AND  `groupid` IS NOT null";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalMessagesToIndividual($company_name){
			$query="SELECT COUNT(*) FROM `sent_messages` INNER JOIN users_company ON
					 users_company.username=sent_messages.sent_by WHERE 
					company_name='$company_name' AND `groupid` IS null;";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalScheduledMessages($company_name){
			$query="SELECT COUNT(*) FROM `scheduled_sms` WHERE `is_sent` = 0 AND
					 `company_name` = '$company_name';";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalScheduledMessagesByUser($company_name,$username){
			$query="SELECT  COUNT(DISTINCT scheduled_sms.messageid) FROM `scheduled_sms` INNER JOIN scheduled_sms_list ON scheduled_sms.messageid=scheduled_sms_list.messageid WHERE `is_sent` = 0 AND
			`company_name` = '$company_name' AND scheduled_sms_list.sent_by='$username';";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalSecretaryMessagesToIndividual($company_name,$username){
			$query="SELECT COUNT(*) FROM `sent_messages` INNER JOIN users_company ON
			users_company.username=sent_messages.sent_by WHERE sent_messages.sent_by='$username' AND
			company_name='$company_name' AND `groupid` IS null;";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		
		public function getTotalInactiveUser($company_name){
			$query="SELECT COUNT(*) FROM `users` INNER JOIN users_company ON
			users.username=users_company.username WHERE `users`.`active` !=1 AND
			users_company.company_name ='$company_name'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalInactiveAdmin(){
			$query="SELECT COUNT(*) FROM `users` INNER JOIN user_rights ON
			users.username=user_rights.username WHERE `users`.`active` !=1 AND
			user_rights.category_name ='Administrator'";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalInactiveCompanies(){
			$query="SELECT COUNT(*) FROM `company` WHERE `active` !=1 ";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalActiveCompanies(){
			$query="SELECT COUNT(*) FROM `company` WHERE `active` =1 ";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalCompanies(){
			$query="SELECT COUNT(*) FROM `company`";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		
		/* public function getUserCategory($username){
			$query="SELECT  `category_name` FROM `user_rights` WHERE `username`=:username";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":username",$username);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		} */
		public function userNameFromUserId($userid){
			$query="SELECT `username` FROM `users` WHERE `userid`=:userid";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":userid",$userid);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getUserPhoneNumber($username){
			$query="SELECT `phone` FROM `users` WHERE `username` =:username";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":username",$username);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getPhoneNumberFromContactid($contactid){
			$query="SELECT `phone` FROM `contacts` WHERE `contactid` =:contactid";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":contactid",$contactid);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		
		public function contactidFromUserId($userid){
			$query="SELECT `contactid` FROM `contacts` 
					INNER JOIN users ON contacts.phone=users.phone 
					WHERE users.userid=:userid";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":userid",$userid);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getUsernameFromResetCode($reset_code){
			$query="SELECT `username` FROM `forgot_password` WHERE `reset_code`=:reset_code";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":reset_code",$reset_code);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getUserCategory($username){
			$query="SELECT `category_name` FROM `user_rights` WHERE `username`=:username";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":username",$username);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function groupName($groupid){
			$query="SELECT group_name FROM contact_groups WHERE groupid=:groupid";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":groupid",$groupid);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getContactid($phone){
			$query="SELECT contactid FROM contacts WHERE phone=:phone";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":phone",$phone);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getCompanyContactid($phone,$company_name){
			$query="SELECT contactid FROM contacts WHERE phone=:phone AND company_name=:company_name";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":phone",$phone);
			$stmt->bindValue(":company_name",$company_name);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getApiUsername($company_name){
			$query="SELECT `api_username` FROM `company` WHERE `company_name`=:company_name";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":company_name",$company_name);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getApiKey($company_name){
			$query="SELECT `api_key` FROM `company` WHERE `company_name`=:company_name";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":company_name",$company_name);
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getMemberToJoinGroup($groupid,$company_name){
			$query="SELECT * FROM contacts WHERE contactid NOT IN( SELECT contactid FROM group_members WHERE groupid = $groupid) AND active =1 AND company_name='$company_name'";
			$stmt=$this->con->prepare($query);
			//$stmt->bind_param("s",$username);
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		public function getAllActiveGroupMembers($groupid){
			$query="SELECT contacts.`contactid`,group_members.groupid,contacts.`phone` FROM 
`contacts` INNER JOIN group_members ON contacts.contactid=group_members.contactid WHERE 
(contacts.active=1 AND group_members.active=1) AND group_members.groupid=$groupid";
			$stmt=$this->con->prepare($query);
			//$stmt->bind_param("s",$username);
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		public function getAllActiveGroups($company_name){
			$query="SELECT * FROM `contact_groups` WHERE `active`=1 AND company_name='$company_name'";
			$stmt=$this->con->prepare($query);
			//$stmt->bind_param("s",$username);
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		public function getAllCategory(){
			$query="SELECT `category_name` FROM `category`;";
			$stmt=$this->con->prepare($query);
			//$stmt->bind_param("s",$username);
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		public function getAllCompanies(){
			$query="SELECT `company_name` FROM `company`;";
			$stmt=$this->con->prepare($query);
			//$stmt->bind_param("s",$username);
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		public function getAllScheduledSMS(){
			$query="SELECT * FROM `scheduled_sms` 
					INNER JOIN scheduled_sms_list ON 
					scheduled_sms.messageid = scheduled_sms_list.messageid 
					WHERE scheduled_sms.`is_sent` = 0 AND 
					scheduled_sms.`scheduled_time` < now()";
			$stmt=$this->con->prepare($query);
			//$stmt->bind_param("s",$username);
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		public function getAllPhoneToSendScheduledSMS($messageid){
			$query="SELECT  `phone` FROM `contacts` WHERE `contactid` IN(SELECT scheduled_sms_list.contactid FROM `scheduled_sms_list`
					INNER JOIN scheduled_sms ON
					scheduled_sms_list.messageid = scheduled_sms.messageid
					WHERE scheduled_sms.messageid =$messageid AND scheduled_sms.`is_sent` = 0 AND
					scheduled_sms.`scheduled_time` < now());";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		public function getAllGroupidsToSendScheduledSMS($messageid){
			$query="SELECT DISTINCT scheduled_sms_list.groupid FROM
					 scheduled_sms_list INNER JOIN scheduled_sms ON 
						scheduled_sms.messageid=scheduled_sms_list.messageid  WHERE
							 scheduled_sms.messageid=$messageid";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		public function getAllContactidsOfGroup($groupid){
			$query="SELECT  `contactid` FROM `group_members` WHERE `active` = 1 AND `groupid` = $groupid;";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		public function getAllActiveContacts($company_name){
			$query="SELECT * FROM `contacts` WHERE `active`=1 AND company_name='$company_name'";
			$stmt=$this->con->prepare($query);
			//$stmt->bind_param("s",$username);
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		public function getAllMessages(){
			$query="SELECT * FROM `messages` ORDER BY `timecreated` DESC;";
			$stmt=$this->con->prepare($query);
			//$stmt->bind_param("s",$username);
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		/* public function getContactName($contactid){
			$query="SELECT `first_name`, `last_name`, `phone`  FROM contacts WHERE `contactid`=:contactid";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(":contactid",$contactid);
			$stmt->execute();
			$first_name=$stmt->fetchColumn();
			$last_name=$stmt->fetchColumn();
			$phone=$stmt->fetchColumn();
			return $first_name." ".$last_name." ".$phone;
			
			
		} */
		//SELECT contactid FROM contacts WHERE contactid !=(SELECT contactid FROM group_members WHERE groupid =2 ) AND active =1
		
		
		public function is_valid_admin_login($username, $password) {
	
			//$password = sha1($email . $password);
			$query = 'SELECT username FROM login WHERE username = :username AND password = :password';
			$statement = $this->con->prepare($query);
			$statement->bindValue(':username', $username);
			$statement->bindValue(':password', $password);
			$statement->execute();
			$valid = ($statement->rowCount() == 1);
			$statement->closeCursor();
			return $valid;
		}
		public function is_super_admin($username) {
			
			//$password = sha1($email . $password);
			$query = 'SELECT `category_name` FROM `user_rights` WHERE `username` = :username AND `category_name`=:Super_Administrator';
			$statement = $this->con->prepare($query);
			$statement->bindValue(':username', $username);
			$statement->bindValue(':Super_Administrator', 'Super_Administrator');
			
			$statement->execute();
			$valid = ($statement->rowCount() == 1);
			$statement->closeCursor();
			return $valid;
		}
		public function is_company_active($company_name) {
			
			//$password = sha1($email . $password);
			$query = 'SELECT `companyid`FROM `company` WHERE `company_name` = :company_name AND `active` = 1';
			$statement = $this->con->prepare($query);
			$statement->bindValue(':company_name', $company_name);
			$statement->execute();
			$valid = ($statement->rowCount() == 1);
			$statement->closeCursor();
			return $valid;
		}
		public function is_reset_code_exist($reset_code) {
			
			//$password = sha1($email . $password);
			$query = 'SELECT `username`  FROM `forgot_password` 
						WHERE  `reset_code` =:reset_code  AND 
						(`time_requested` > DATE_SUB(NOW(), INTERVAL 1 DAY) AND 
						`time_requested` < NOW())';
			
			$statement = $this->con->prepare($query);
			$statement->bindValue(':reset_code', $reset_code);
			$statement->execute();
			$valid = ($statement->rowCount() == 1);
			$statement->closeCursor();
			return $valid;
		}
		public function is_user_active($username) {
			
			//$password = sha1($email . $password);
			$query = 'SELECT `userid` FROM `users` WHERE `active` = 1 AND `username`=:username';
			$statement = $this->con->prepare($query);
			$statement->bindValue(':username', $username);
			$statement->execute();
			$valid = ($statement->rowCount() == 1);
			$statement->closeCursor();
			return $valid;
		}
		public function is_there_scheduled_sms() {
			
			//$password = sha1($email . $password);
			$query = 'SELECT `messageid` FROM `scheduled_sms` WHERE `is_sent` = 0 AND `scheduled_time` < now();';
			$statement = $this->con->prepare($query);
			$statement->execute();
			$valid = ($statement->rowCount() >= 1);
			$statement->closeCursor();
			return $valid;
		}
		public function is_same_sms_to_many($messageid) {
			
			//$password = sha1($email . $password);
			$query = 'SELECT scheduled_sms.`messageid` 
						FROM `scheduled_sms` 
					INNER JOIN scheduled_sms_list ON 
					scheduled_sms.messageid = scheduled_sms_list.messageid
					  WHERE scheduled_sms.`messageid` =:messageid AND
					 scheduled_sms.`is_sent` = 0 AND
					 scheduled_sms.`scheduled_time` < now()';
			$statement = $this->con->prepare($query);
			$statement->bindValue(':messageid', $messageid);
			$statement->execute();
			$valid = ($statement->rowCount() > 1);
			$statement->closeCursor();
			return $valid;
		}
		
	 	public function is_same_sms_to_many_groups($messageid) {
			
			//$password = sha1($email . $password);
			$query = 'SELECT DISTINCT scheduled_sms_list.groupid
						FROM `scheduled_sms`
					INNER JOIN scheduled_sms_list ON
					scheduled_sms.messageid = scheduled_sms_list.messageid
					  WHERE scheduled_sms.`messageid` =:messageid AND
					 scheduled_sms.`is_sent` = 0 AND
					 scheduled_sms.`scheduled_time` < now()';
			$statement = $this->con->prepare($query);
			$statement->bindValue(':messageid', $messageid);
			$statement->execute();
			$valid = ($statement->rowCount() > 1);
			$statement->closeCursor();
			return $valid;
		} 
		public function getTotalPeopleToReceiveMessage($messageid){
			$query="SELECT COUNT(*)
						FROM `scheduled_sms` 
					INNER JOIN scheduled_sms_list ON 
					scheduled_sms.messageid = scheduled_sms_list.messageid
					  WHERE scheduled_sms.`messageid` =$messageid AND
					 scheduled_sms.`is_sent` = 0 AND
					 scheduled_sms.`scheduled_time` < now()";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		public function getTotalGroupsToReceiveMessage($messageid){
			$query="SELECT COUNT( DISTINCT scheduled_sms_list.groupid) FROM
					 scheduled_sms_list INNER JOIN scheduled_sms ON 
					scheduled_sms.messageid=scheduled_sms_list.messageid WHERE
					 scheduled_sms.messageid=$messageid";
			$stmt=$this->con->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchColumn();
			
			
		}
		
		/* public function createUser($username,$pass,$email){
			if($this->isUserExist($username,$email)){
				return 0;
			}else{
				$password=md5($pass);
				$query="INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES (NULL, ?, ?,?);";
				$stmt=$this->con->prepare($query);
				$stmt->bind_param("sss",$username,$password,$email);
				if($stmt->execute()){
					return 1;
				}else{
					return 2;
				}
			}
		} */
		public function createUser($username,$pass,$email){
			if($this->isUserExist($username,$email)){
				return 0;
			}else{
				$password=md5($pass);
				$query="INSERT INTO `users` (`userid`, `username`, `first_name`,`last_name`,`gender`,`active`, `phone`,`datecreated`) VALUES (NULL, ?, ?,?);";
				$stmt=$this->con->prepare($query);
				$stmt->bind_param("sss",$username,$password,$email);
				if($stmt->execute()){
					return 1;
				}else{
					return 2;
				}
			}
		}
		public function changeProfilePicture($profile_picture,$username){
			
				$query="UPDATE `login` SET  `profile_picture`=:profile_picture WHERE `username`=:username;";
				$stmt=$this->con->prepare($query);
				$stmt->bindValue(':profile_picture', $profile_picture);
				$stmt->bindValue(':username', $username);
				if($stmt->execute()){
					return 1;
				}else{
					return 2;
				}
			
		}
		public function markScheduleSmsAsSent($messageid){
			
			$query="UPDATE `scheduled_sms` SET `is_sent`=1 WHERE `messageid` = :messageid;";
			$stmt=$this->con->prepare($query);
			
			$stmt->bindValue(':messageid', $messageid);
			if($stmt->execute()){
				return 1;
			}else{
				return 2;
			}
			
		}
		public function changePassword($password,$username){
			
			$query="UPDATE `login` SET  `password`=:password WHERE `username`=:username;";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(':password', $password);
			$stmt->bindValue(':username', $username);
			if($stmt->execute()){
				return 1;
			}else{
				return 2;
			}
			
		}
		public function deleteAllForgotPasswordDetailsIfExists($username){
			
			$query="DELETE FROM `forgot_password` WHERE `username`=:username;";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(':username', $username);
			if($stmt->execute()){
				return 1;
			}else{
				return 2;
			}
			
		}
		public function isUsernameExist($username){
			$query="SELECT userid FROM users WHERE username=:username";
			$stmt=$this->con->prepare($query);
			$stmt->bindValue(':username', $username);
			$stmt->execute();
			$valid = ($stmt->rowCount() == 1);
			$stmt->closeCursor();
			return $valid;
			
		}
		private function isUserExist($username,$email){
			$query="SELECT id FROM users WHERE username=? OR email=?";
			$stmt=$this->con->prepare($query);
			$stmt->bind_param("ss",$username,$email);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;
			
		}
		/* public function savemeso($message,$groupid){
	
				$password=md5($pass);
				$query="INSERT INTO `users` (`username`, `password`) VALUES ( ?, ?);";
				$stmt=$this->con->prepare($query);
				$stmt->bind_param("ss",$message,$groupid);
				if($stmt->execute()){
					return 1;
				}else{
					return 2;
				}
			
		} */
		public function save_message($message,$company_name) {
					//global $db;
					$query = 'INSERT INTO messages
                 (message, timecreated,company_name)
              VALUES
                 (:message, NOW(),:company_name)';
					try {
						$statement = $this->con->prepare($query);
						$statement->bindValue(':message', $message);
						$statement->bindValue(':company_name', $company_name);
						$statement->execute();
						$statement->closeCursor();
						
						// Get the last product ID that was automatically generated
						$message_id = $this->con->lastInsertId();
						return $message_id;
					} catch (PDOException $e) {
						$error_message = $e->getMessage();
						display_db_error($error_message);
					}
		}
		
		public function save_message_to_send_later($message,$scheduled_time,$company_name) {
			//global $db;
			$query = 'INSERT INTO `scheduled_sms`
					(`message`, `scheduled_time`, `company_name`, `is_sent`) 
					VALUES 
					(:message,:scheduled_time,:company_name,:is_sent)';
			try {
				$statement = $this->con->prepare($query);
				$statement->bindValue(':message', $message);
				$statement->bindValue(':company_name', $company_name);
				$statement->bindValue(':scheduled_time', $scheduled_time);
				$statement->bindValue(':is_sent', 0);
				$statement->execute();
				$statement->closeCursor();
				
				// Get the last product ID that was automatically generated
				$message_id = $this->con->lastInsertId();
				return $message_id;
			} catch (PDOException $e) {
				$error_message = $e->getMessage();
				display_db_error($error_message);
			}
		}
		
		
		public function save_forgot_password_code($username,$reset_code) {
			//global $db;
			$query = 'INSERT INTO `forgot_password`
						(`username`, `reset_code`, `time_requested`) 
						VALUES (:username,:reset_code,now())';
			try {
				$statement = $this->con->prepare($query);
				$statement->bindValue(':username', $username);
				$statement->bindValue(':reset_code', $reset_code);
				$status=$statement->execute();
				$statement->closeCursor();
				
				// Get the last product ID that was automatically generated
				//$message_id = $this->con->lastInsertId();
				return $status;
			} catch (PDOException $e) {
				$error_message = $e->getMessage();
				display_db_error($error_message);
			}
		}
		
		public function save_message_sent_to_group_members($messageid,$contactid,$groupid,$username) {
			//global $db;
			$query = 'INSERT INTO `sent_messages`(`messageid`, `contactid`, `groupid`, `timesent`,`sent_by`)
			VALUES (:messageid,:contactid,:groupid, NOW(),:username)';
			
			try {
				$statement = $this->con->prepare($query);
				$statement->bindValue(':messageid', $messageid);
				$statement->bindValue(':contactid', $contactid);
				$statement->bindValue(':groupid', $groupid);
				$statement->bindValue(':username', $username);
				$status=$statement->execute();
				$statement->closeCursor();
				
				// Get the last product ID that was automatically generated
				//$message_id = $this->con->lastInsertId();
				return $status;
			} catch (PDOException $e) {
				$error_message = $e->getMessage();
				display_db_error($error_message);
			}
		}
		public function save_scheduled_sms_list_to_individual($messageid,$contactid,$groupid,$username) {
			//global $db;
			$query = 'INSERT INTO `scheduled_sms_list`
					(`messageid`, `contactid`, `groupid`, `sent_by`) 
					VALUES 
					(:messageid,:contactid,:groupid, :username)';
			
			try {
				$statement = $this->con->prepare($query);
				$statement->bindValue(':messageid', $messageid);
				$statement->bindValue(':contactid', $contactid);
				$statement->bindValue(':groupid', $groupid);
				$statement->bindValue(':username', $username);
				$status=$statement->execute();
				$statement->closeCursor();
				
				// Get the last product ID that was automatically generated
				//$message_id = $this->con->lastInsertId();
				return $status;
			} catch (PDOException $e) {
				$error_message = $e->getMessage();
				display_db_error($error_message);
			}
		}
		public function is_message_sent($messageid,$contactid) {
			//global $db;
			$query = 'SELECT `messageid`, `contactid` FROM `sent_messages`
			WHERE `messageid`=:messageid AND `contactid`=:contactid';
			
		
				$statement = $this->con->prepare($query);
				$statement->bindValue(':messageid', $messageid);
				$statement->bindValue(':contactid', $contactid);
				$statement->execute();
				$valid = ($statement->rowCount() == 1);
				$statement->closeCursor();
				return $valid;
				
		
			
		}
		
		public function is_phone_the_same($phone,$company_name) {
			//global $db;
			$query = 'SELECT contactid FROM `contacts` 
					INNER JOIN users ON contacts.phone=users.phone 
					INNER JOIN users_company ON users.username=users_company.username
					WHERE users.phone=:phone AND users_company.company_name=:company_name LIMIT 1';
			
			
			$statement = $this->con->prepare($query);
			$statement->bindValue(':phone', $phone);
			$statement->bindValue(':company_name', $company_name);
			$statement->execute();
			$valid = ($statement->rowCount() >= 1);
			$statement->closeCursor();
			return $valid;
			
			
			
		}
		
		public function getAllMemberSentMessage($messageid){
			$query="SELECT contacts.`contactid`, `first_name`, 
`last_name`, `phone`,  `timesent`  FROM `contacts` INNER JOIN sent_messages ON 
sent_messages.contactid=contacts.contactid WHERE sent_messages.messageid= $messageid ORDER BY `timesent` DESC;";
			$stmt=$this->con->prepare($query);
			//$stmt->bind_param("s",$username);
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		
		public function getAllMemberSentScheduledMessage($messageid){
			$query="SELECT contacts.`contactid`, `first_name`,
			`last_name`, `phone`  FROM `contacts`  WHERE `contactid` IN(
				SELECT DISTINCT scheduled_sms_list.contactid FROM
				 scheduled_sms INNER JOIN `scheduled_sms_list` ON
				 scheduled_sms.messageid=scheduled_sms_list.messageid
					 WHERE scheduled_sms.messageid=$messageid)";
			$stmt=$this->con->prepare($query);
			//$stmt->bind_param("s",$username);
			$stmt->execute();
			$result= $stmt->fetchAll();
			return $result;
			
			
		}
		
	}

?>