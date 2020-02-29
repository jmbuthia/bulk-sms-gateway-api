<?php

require_once 'db_connect.php';
session_start();
$company_name=$_SESSION['company_name'];
$output = array('data' => array());

$sql = "SELECT * FROM `scheduled_sms` WHERE `is_sent` = 0 AND company_name='$company_name' ORDER BY `scheduled_time` ASC;";
$query = $connect->query($sql);

//$x = 1;
while ($row = $query->fetch_assoc()) {
	/* 	$active = '';
	 if($row['active'] == 1) {
	 $active = '<label class="label label-success">Active</label>';
	 } else {
	 $active = '<label class="label label-danger">Deactive</label>';
	 } */
	
	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
<li><a type="button" href=".?action=view_scheduled_contacts&messageid='.$row['messageid'].'"> <span class="glyphicon glyphicon-eye-open"></span> View</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['messageid'].')"> <span class="glyphicon glyphicon-trash"></span> Delete</a></li>
	  </ul>
	</div>
		';

	$output['data'][] = array(
			//$x,
			 $row['messageid'], 
			$row['message'],
			/* $row['middle_name'], */
			$row['scheduled_time'],
			$actionButton
	);
	
	//$x++;
}

// database connection close
$connect->close();

echo json_encode($output);