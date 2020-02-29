<?php
require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');
require_once('../message_sender/message_sender.php');
require_once('../message_sender/AfricasTalkingGateway.php');
$dbOperation= new DbOperation();

//if there is any job in database

if($dbOperation->is_there_scheduled_sms()){
	//echo 'there is scheduled sms';
	
	$scheduled_messages=$dbOperation->getAllScheduledSMS();
	
	$phone_list=array();
	$messageid_to_many=array();
	foreach ($scheduled_messages as $scheduled_sms):
	if ($scheduled_sms['groupid'] == NULL){
		
		//echo 'its individual scheduled sms';
		
		
		//if it one message sent to many
		
		if($dbOperation->is_same_sms_to_many($scheduled_sms['messageid'])){
			$numbers_of_people_to_receive_the_message=$dbOperation->getTotalPeopleToReceiveMessage($scheduled_sms['messageid']);
			$phone_list_many=array();
			if (!in_array($scheduled_sms['messageid'], $messageid_to_many) ) {
				//echo " message id  = {$scheduled_sms['messageid']} is scheduled ";
				
				//var_dump($messageid_to_many);
				//getting all contact sent the message
				$all_phones=$dbOperation->getAllPhoneToSendScheduledSMS($scheduled_sms['messageid']);
				
				$i=1;
				foreach ($all_phones as $phone):
				
				$phone_list_many+=array("p_".$i => $phone['phone']);
				
				$i++;
				//echo 'inside forech ';
				//var_dump($phone_list_many);
				//echo ' mesaid_to many in loop array is = ';
				//var_dump($messageid_to_many);
				endforeach;
				
				$contact_size=count($phone_list_many);
				
				
				
				
				
				
				array_push($messageid_to_many,$scheduled_sms['messageid']);
				//$messageid_to_many+=array($scheduled_sms['messageid']);
				//var_dump($messageid_to_many);
			}
			
			if ( (!empty($phone_list_many)) && ($contact_size == $numbers_of_people_to_receive_the_message)){
				//Sending the sms
				//echo 'phone list empty is not empty';
				//echo " sending message to".$contact_size." people";
				//echo " the message will be sent to ".$numbers_of_people_to_receive_the_message." people";
				
				//echo "message id is= ".$scheduled_sms['messageid'];
				//var_dump($phone_list_many);
				
				M_sender::post_async('http://ruemerc.co.ke/apps/smsgateway/message_sender/post_async_sms_individual.php',$contact_size,$scheduled_sms['message'],$phone_list_many,$scheduled_sms['sent_by']);
				
				//marking the message as sent
				
				$dbOperation->markScheduleSmsAsSent($scheduled_sms['messageid']);
			}
			
			
			
		}else {
			if(in_array($scheduled_sms['messageid'], $messageid_to_many)){
				//echo 'bug was here';
			}else {
				//echo  " in array= ".in_array($scheduled_sms['messageid'], $messageid_to_many);
				//its one message sent to only one person
			//echo 'its single message to one contact';
				//echo "message id is= ".$scheduled_sms['messageid'];
				$phone=$dbOperation->getPhoneNumberFromContactid($scheduled_sms['contactid']);
				
				$i=1;
				$phone_list+=array("p_".$i => $phone);
				$i++;
				$contact_size=count($phone_list);
				//echo " contact_size = ".$contact_size;
				//echo $phone_list['p_1']." -> ".$scheduled_sms['message'];
				
				//Sending the sms
				
				//var_dump($phone_list);
				M_sender::post_async('http://ruemerc.co.ke/apps/smsgateway/message_sender/post_async_sms_individual.php',$contact_size,$scheduled_sms['message'],$phone_list,$scheduled_sms['sent_by']);
				
				//marking the message as sent
				
				$dbOperation->markScheduleSmsAsSent($scheduled_sms['messageid']);
				$phone_list=array();
				
			}
			}
		
		
		//var_dump($messageid_to_many);
	}else {
		
		//echo 'its group scheduled sms <BR>';
		
		
		
		
		
		
		
		
		
		
		
		//if it one message sent to many groups
		
		if($dbOperation->is_same_sms_to_many_groups($scheduled_sms['messageid'])){
			
			//echo 'it one message sent to many groups';
			
			$numbers_of_group_to_receive_the_message=$dbOperation->getTotalGroupsToReceiveMessage($scheduled_sms['messageid']);
			$groupid_list=array();
			if (!in_array($scheduled_sms['messageid'], $messageid_to_many) ) {
				//echo " message id  = {$scheduled_sms['messageid']} is scheduled ";
				
				//var_dump($messageid_to_many);
				//getting all contact sent the message
				$groupids=$dbOperation->getAllGroupidsToSendScheduledSMS($scheduled_sms['messageid']);
				
				
				$i=1;
				foreach ($groupids as $groupid):
				
				$groupid_list+=array("g_".$i => $groupid['groupid']);
				
				$i++;
				endforeach;
				
				$group_size=count($groupid_list);
				
				
				
				array_push($messageid_to_many,$scheduled_sms['messageid']);
				//$messageid_to_many+=array($scheduled_sms['messageid']);
				
				//var_dump($groupid_list);
			}
			
			if ( (!empty($groupid_list)) && ($group_size == $numbers_of_group_to_receive_the_message)){
				//Sending the sms
				//echo 'phone list empty is not empty';
				//echo " sending message to".$contact_size." people";
				//echo " the message will be sent to ".$numbers_of_people_to_receive_the_message." people";
				
				//echo "message id is= ".$scheduled_sms['messageid'];
			//	var_dump($groupid_list);
				
				
				M_sender::post_async('http://ruemerc.co.ke/apps/smsgateway/message_sender/post_async_sms.php',$group_size,$scheduled_sms['message'],$groupid_list,$scheduled_sms['sent_by']);
				
				//marking the message as sent
				
				$dbOperation->markScheduleSmsAsSent($scheduled_sms['messageid']);
			}
			
			
			
		}else {
			//echo 'it one message sent to one group';
			$groupid_list_one=array();
			if(in_array($scheduled_sms['messageid'], $messageid_to_many)){
				//echo 'bug was here';
			}else {
				//echo  " in array= ".in_array($scheduled_sms['messageid'], $messageid_to_many);
				//its one message sent to only one person
				//echo 'its single message to one contact';
				//echo "message id is= ".$scheduled_sms['messageid'];
				
				$groupid=$dbOperation->getGroupidToSendSheduleSMS($scheduled_sms['messageid']);
				
				$i=1;
				$groupid_list_one+=array("g_".$i => $groupid);
				$i++;
				
				$group_size_one=count($groupid_list_one);
				//echo " contact_size = ".$contact_size;
				//echo $phone_list['p_1']." -> ".$scheduled_sms['message'];
				
				//Sending the sms
				//echo " message id of this message is".$scheduled_sms['messageid'];
				//var_dump($groupid_list_one);
				
				M_sender::post_async('http://ruemerc.co.ke/apps/smsgateway/message_sender/post_async_sms.php',$group_size_one,$scheduled_sms['message'],$groupid_list_one,$scheduled_sms['sent_by']);
				
				//marking the message as sent
				
				$dbOperation->markScheduleSmsAsSent($scheduled_sms['messageid']);
				array_push($messageid_to_many,$scheduled_sms['messageid']);
				$groupid_list_one=array();
				
			}
		}
		
		
		//var_dump($messageid_to_many);
		
		
		
		
		
		
		
		
		
		
		
	}
	endforeach;
	
	
	
	
	
	
	
	
	
}else {
	//echo 'there is no scheduled sms';
}
/* 
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
	
	
	
	M_sender::post_async('http://localhost/smsgateway/message_sender/post_async_sms_individual.php',$contact_size,$message,$phone_list,$username);
	
	
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



$dbOperation->markScheduleSmsAsSent(2); */

?>
