<?php

require_once 'db_connect.php';

$output = array('success' => false, 'messages' => array());

$groupId = $_POST['member_id'];
//echo $groupId;

$sql = "DELETE FROM contact_groups WHERE groupid = {$groupId}";
$query = $connect->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully removed';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the group information';
}

// close database connection
$connect->close();

echo json_encode($output);