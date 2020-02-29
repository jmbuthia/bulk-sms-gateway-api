<?php
// Textlocal account details
$username = 'jmbuthia12@gmail.com';
$hash = 'c4a68f1a34548dc4bd1ca8bdf97dc68ef114a379c9a81ea49a4d59a8426491ff';

// Message details
$numbers = array(+254717925741);
$sender = urlencode('Johnson M.');
$message = rawurlencode('My message to send');

$numbers = implode(',', $numbers);

// Prepare data for POST request
$data = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

// Send the POST request with cURL
$ch = curl_init('http://api.txtlocal.com/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Process your response here
echo $response;
?>