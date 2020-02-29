<?php

require_once 'db_connect.php';

$output = array('data' => array());

$sql = "SELECT * FROM `messages` ORDER BY `timecreated` DESC;";
$query = $connect->query($sql);

//$x = 1;
while ($row = $query->fetch_assoc()) {

	
	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
<li><a type="button" href=".?action=view_contacts&messageid='.$row['messageid'].'"> <span class="glyphicon glyphicon-eye-open"></span> View</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['messageid'].')"> <span class="glyphicon glyphicon-trash"></span> Delete</a></li>
	  </ul>
	</div>
		';
	
	$output['data'][] = array(
			//$x,
			$row['messageid'],
			$row['message'],
			
			$row['timecreated'],
			$actionButton
	);
	
	//$x++;
}

// database connection close
$connect->close();

echo json_encode($output);