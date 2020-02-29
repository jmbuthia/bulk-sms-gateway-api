<?php
session_start();
require_once 'db_connect.php';

$messageid= $_POST['messageid'];

$sql = "SELECT contacts.`contactid`, `first_name`, 
`last_name`, `phone`,  `timesent`  FROM `contacts` INNER JOIN sent_messages ON 
sent_messages.contactid=contacts.contactid WHERE sent_messages.messageid= $messageid";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();

echo json_encode($result);

