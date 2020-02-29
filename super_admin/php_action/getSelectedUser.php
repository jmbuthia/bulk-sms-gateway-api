<?php
//session_start();
require_once 'db_connect.php';

$userid = $_POST['member_id'];

$sql = "SELECT `userid`, users.`username`, 
`first_name`, `last_name`, `gender`, `active`, 
`phone`, users_company.company_name 
FROM `users` INNER JOIN users_company ON
 users.username=users_company.username WHERE
 userid=$userid";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();

echo json_encode($result);

