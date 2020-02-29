<?php
require_once('sms_work.php');
require_once('AfricasTalkingGateway.php');
extract($_POST);
//$group_list_array=array();
$group_list_array=array();
for ($i=1;$i<=$group_size;$i++){
	
	array_push($group_list_array, $_POST["g_".$i]);
	
}
//require_once('mywork.php');
//$p3=array(1,2,3,4);
MessageSender::send($username,$message, $group_list_array);
//file_put_contents('thiga', $group_list_array[0]);