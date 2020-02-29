<?php

require_once 'db_connect.php';

$groupid= $_POST['member_id'];

$sql = "SELECT * FROM contact_groups WHERE groupid = $groupid";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();

echo json_encode($result);

