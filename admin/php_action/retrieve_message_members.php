<?php
session_start();
require_once 'db_connect.php';

$output = array('data' => array());

$messageid=$_SESSION['messageid'];

$sql = "SELECT contacts.`contactid`, `first_name`, 
`last_name`, `phone`,  `timesent`  FROM `contacts` INNER JOIN sent_messages ON 
sent_messages.contactid=contacts.contactid WHERE sent_messages.messageid= $messageid ORDER BY `timesent` DESC;";
$query = $connect->query($sql);

//$x = 1;
while ($row = $query->fetch_assoc()) {
	/* $active = '';
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
	    <!-- implement resend and delete button later -->
        <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['contactid'].')"> <span class="glyphicon glyphicon-repeat"></span> Resend</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['contactid'].')"> <span class="glyphicon glyphicon-trash"></span> Delete</a></li>
	  </ul>
	</div>
		';
	
	$output['data'][] = array(
			//$x,
			$row['contactid'],
			$row['first_name'],
			/* $row['middle_name'], */
			$row['last_name'],
			$row['phone'],
			$row['timesent'],
			
			$actionButton
	);
	
	//$x++;
}

// database connection close
$connect->close();

echo json_encode($output);