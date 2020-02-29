<?php
require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');
require_once('message_sender.php');
require_once('AfricasTalkingGateway.php');



/*

class MyWork extends Threaded {
	public $username;
	public $message;
	public $groupid_list;
	
	
	public function __construct($username,$message,$groupid_list) {
		//echo "Constructing worker to send message= $message \n<br>";
		$this->username= $username;
		$this->message= $message;
		$this->groupid_list= $groupid_list;
		//var_dump($groupid_list);
		$this->run();
		exit();
		
	}
	
	public function run() {
		//sleep(30);
		
		$dbOperation= new DbOperation();
		$contact_list=array();
		
		//getting user company
		$user_company=$dbOperation->getUserCompanyName($this->username);
		
		//saving composed message
		$message_id=$dbOperation->save_message($this->message,$user_company);
		
		
		
		//echo 'message id = '.$message_id;
		
		foreach ($this->groupid_list as $groupid):
		//echo "in first for each and groupid=  ".$groupid."<br>";
		array_push($contact_list, $dbOperation->getAllActiveGroupMembers($groupid));
		endforeach;
		$contact_list=array_unique($contact_list,SORT_REGULAR);
		// var_dump($contact_list);
		
		$phone=array();
		foreach ($contact_list as $key=>$value):
		
		foreach ($value as $key=>$value):
		
		//echo "contactid= ".$value['contactid']." groupid=  ".$value['groupid']." phone=  ".$value['phone']."<br>";
		array_push($phone, $value['phone']);
		
		//save each message and whoever was sent in database here
		if (!$dbOperation->is_message_sent($message_id, $value['contactid'])){
			$status_info=$dbOperation->save_message_sent_to_group_members($message_id,$value['contactid'],$value['groupid'],$this->username);
			//echo 'status info'.$status_info;
		}
		
		
		endforeach;
		
		endforeach;
		
		$phone=array_unique($phone,SORT_STRING);
		//print_r($phone);
		//echo "count of numbers is = ".count($phone);
		//$phone_numbers=implode(",", $phone);
		//echo "<br> phone list to send $this->message = ".$phone_numbers;
		
		M_sender::send_sms($this->username, $this->message, $phone);
	}
	
}

class MyIndividualWork extends Threaded {
	public $username;
	public $message;
	public $phone_list;
	
	
	public function __construct($username,$message,$phone_list) {
		//echo "Constructing worker to send message= $message \n<br>";
		$this->username= $username;
		$this->message= $message;
		$this->phone_list= $phone_list;
		//var_dump($groupid_list);
		$this->runi();
		exit();
		
	}
	
	public function runi() {
		//sleep(30);
		
		$dbOperation= new DbOperation();
		$contact_list=array();
		
		//getting user company
		$user_company=$dbOperation->getUserCompanyName($this->username);
		
		//saving composed message
		$message_id=$dbOperation->save_message($this->message,$user_company);
		
		
		//echo 'message id = '.$message_id;
		
		foreach ($this->phone_list as $phone):
		//saving individual person in database
		$contactid= $dbOperation->getContactid($phone);
		
		if (!$dbOperation->is_message_sent($message_id, $contactid)){
			$status_info=$dbOperation->save_message_sent_to_group_members($message_id,$contactid,null,$this->username);
			//echo 'status info'.$status_info;
		}
		
		
		endforeach;
		
		
		M_sender::send_sms($this->username, $this->message, $this->phone_list);
	}
	
}





class MyWorker extends Worker {
	public function run() {	}
	
}

class MyIndividualWorker extends Worker {
	public function runi() {	}
	
}



*/













//$p1=array(1,2);
//$p2=array(3,4);
//$p3=array(1,2,3,4);

/* $pool = new Pool(1, \MyWorker::class);
 //$pool->submit(new MyWork("message A",$p1));
 //$pool->submit(new MyWork("message B",$p2));
 $pool->submit(new MyWork("message C",$p3));
 $pool->shutdown();
 echo 'no waiting'; */

class MessageSender{
	public function  __construct(){
		
	}
/* 	public  static function send($username,$message,$groupid){
		$pool = new Pool(1, \MyWorker::class);
		//$pool->submit(new MyWork("message A",$p1));
		//$pool->submit(new MyWork("message B",$p2));
		$pool->submit(new MyWork($username,$message,$groupid));
		$pool->shutdown();
		
	}
	public  static function sendToIndividual($username,$message,$phone_list){
		$pool = new Pool(1, \MyIndividualWorker::class);
		//$pool->submit(new MyWork("message A",$p1));
		//$pool->submit(new MyWork("message B",$p2));
		$pool->submit(new MyIndividualWork($username,$message, $phone_list));
		$pool->shutdown();
		
	}
	 */
	
	
	
	
	
	
	
	
	
	
	public  static function send($username,$message,$groupids){
		
		//sleep(30);
		
		$dbOperation= new DbOperation();
		$contact_list=array();
		
		//getting user company
		$user_company=$dbOperation->getUserCompanyName($username);
		
		//saving composed message
		$message_id=$dbOperation->save_message($message,$user_company);
		
		
		
		//echo 'message id = '.$message_id;
		
		foreach ($groupids as $groupid):
		//echo "in first for each and groupid=  ".$groupid."<br>";
		array_push($contact_list, $dbOperation->getAllActiveGroupMembers($groupid));
		endforeach;
		$contact_list=array_unique($contact_list,SORT_REGULAR);
		// var_dump($contact_list);
		
		$phone=array();
		foreach ($contact_list as $key=>$value):
		
		foreach ($value as $key=>$value):
		
		//echo "contactid= ".$value['contactid']." groupid=  ".$value['groupid']." phone=  ".$value['phone']."<br>";
		array_push($phone, $value['phone']);
		
		//save each message and whoever was sent in database here
		if (!$dbOperation->is_message_sent($message_id, $value['contactid'])){
			$status_info=$dbOperation->save_message_sent_to_group_members($message_id,$value['contactid'],$value['groupid'],$username);
			//echo 'status info'.$status_info;
		}
		
		
		endforeach;
		
		endforeach;
		
		$phone=array_unique($phone,SORT_STRING);
		//print_r($phone);
		//echo "count of numbers is = ".count($phone);
		//$phone_numbers=implode(",", $phone);
		//echo "<br> phone list to send $this->message = ".$phone_numbers;
		
		M_sender::send_sms($username, $message, $phone);
		
		
	}
	public  static function sendToIndividual($username,$message,$phone_list){
		
		//sleep(30);
		
		$dbOperation= new DbOperation();
		$contact_list=array();
		
		//getting user company
		$user_company=$dbOperation->getUserCompanyName($username);
		
		//saving composed message
		$message_id=$dbOperation->save_message($message,$user_company);
		
		
		//echo 'message id = '.$message_id;
		
		foreach ($phone_list as $phone):
		//saving individual person in database
		$contactid= $dbOperation->getContactid($phone);
		
		if (!$dbOperation->is_message_sent($message_id, $contactid)){
			$status_info=$dbOperation->save_message_sent_to_group_members($message_id,$contactid,null,$username);
			//echo 'status info'.$status_info;
		}
		
		
		endforeach;
		
		
		M_sender::send_sms($username, $message, $phone_list);
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}



