<?php

require_once 'db_connect.php';

$output = array('success' => false, 'messages' => array());

$messageId = $_POST['member_id'];

$sql = "DELETE FROM messages WHERE `messageid` = {$messageId}";
$query = $connect->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully removed';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the contact information. <br> 
You should first delete the contacts associated with the message.';
} 
/* if($connect->affected_rows() > 0) {
	$output['success'] = true;
	$output['messages'] = "Successfully removed {$messageId}";
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the contact information. <br>
You should first delete the contacts associated with the message.';
} */

// close database connection
$connect->close();

echo json_encode($output);