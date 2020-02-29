<?php
require_once('sms_work.php');
extract($_POST);
//$group_list_array=array();
$phone_list_array=array();
for ($i=1;$i<=$group_size;$i++){
	$encoded_phone=$_POST["p_".$i];
	//$phone=urldecode($encoded_phone);
	array_push($phone_list_array,$encoded_phone);
	
}
//var_dump($phone_list_array);
//require_once('mywork.php');
//$p3=array(1,2,3,4);
//echo $username;
MessageSender::sendToIndividual($username,$message, $phone_list_array);
//file_put_contents('thiga', $group_list_array[0]);