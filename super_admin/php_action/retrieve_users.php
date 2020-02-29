<?php

require_once 'db_connect.php';

$output = array('data' => array());

$sql = "SELECT users.userid, users.username,
users.first_name,users.last_name,users.gender,
users.phone,users_company.company_name,users.active 
FROM `users` INNER JOIN users_company ON 
users.username=users_company.username INNER JOIN user_rights ON 
users.username=user_rights.username 
WHERE user_rights.category_name='Administrator'";
$query = $connect->query($sql);

//$x = 1;
while ($row = $query->fetch_assoc()) {
	$active = '';
	if($row['active'] == 1) {
		$active = '<label class="label label-success">Active</label>';
	} else {
		$active = '<label class="label label-danger">Deactive</label>';
	}
	
	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editMemberModal" onclick="editMember('.$row['userid'].')"> <span class="glyphicon glyphicon-edit"></span> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['userid'].')"> <span class="glyphicon glyphicon-trash"></span> Remove</a></li>
	  </ul>
	</div>
		';
	
	$output['data'][] = array(
			//$x,
			$row['username'],
			$row['first_name'],
			/* $row['middle_name'], */
			$row['last_name'],
			$row['phone'],
			$row['gender'],
			$row['company_name'],
			$active,
			$actionButton
	);
	
	//$x++;
}

// database connection close
$connect->close();

echo json_encode($output);