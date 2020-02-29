<?php
$dsn = 'mysql:host=localhost;dbname=smsgateway';
$username = 'your username';
$password = 'your password';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo $error_message;
    //include '../errors/db_error_connect.php';
    exit;
}

function display_db_error($error_message) {
    global $app_path;
    //include '../errors/db_error.php';
    exit;
}
?>