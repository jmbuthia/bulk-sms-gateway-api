<?php
session_start();

require_once 'db_connect.php';

$output = array('success' => false, 'messages' => array());
$groupid=$_SESSION['groupid'];
$contactId = $_POST['member_id'];

$sql = "DELETE FROM group_members WHERE contactid = {$contactId} AND groupid={$groupid}";
$query = $connect->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully removed';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the member information';
}

// close database connection
$connect->close();

echo json_encode($output);