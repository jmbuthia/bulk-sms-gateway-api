<?php 

require_once 'db_connect.php';

$output = array('success' => false, 'messages' => array());

$contactId = $_POST['member_id'];

$sql = "DELETE FROM `company` WHERE `companyid` = {$contactId}";
$query = $connect->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully removed';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the company information';
}

// close database connection
$connect->close();

echo json_encode($output);