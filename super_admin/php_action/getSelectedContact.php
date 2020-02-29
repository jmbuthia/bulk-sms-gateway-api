<?php
//session_start();
require_once 'db_connect.php';

$contactId = $_POST['member_id'];

$sql = "SELECT * FROM company WHERE companyid=$contactId";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();

echo json_encode($result);

