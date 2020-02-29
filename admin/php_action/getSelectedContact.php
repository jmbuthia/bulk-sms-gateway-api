<?php
//session_start();
require_once 'db_connect.php';

$contactId = $_POST['member_id'];
//$groupid=$_SESSION['groupid'];
$sql = "SELECT * FROM contacts WHERE contactid=$contactId";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();

echo json_encode($result);

