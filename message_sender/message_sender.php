<?php
require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');
require_once('AfricasTalkingGateway.php');
class M_sender{
	public  function  __construct(){
		
	}
	
	public static function send_sms($sender,$message_to_send, $phone_numbers) {
		
		$dbOperation= new DbOperation();
		
		//getting user company
		$user_company=$dbOperation->getUserCompanyName($sender);
		
		
		//getting api username
		$api_username=$dbOperation->getApiUsername($user_company);
		
		//getting api key
		$api_key=$dbOperation->getApiKey($user_company);
		
		
		
		//African's Talking
		
		// Be sure to include the file you've just downloaded
		//require_once('AfricasTalkingGateway.php');
		// Specify your login credentials
		$username   = "mbuthia";
		$apikey     = "058178a2195b29f908bc025d9153f662f9ac36a309752c9a83000b367a3714b2";
		// NOTE: If connecting to the sandbox, please use your sandbox login credentials
		// Specify the numbers that you want to send to in a comma-separated list
		// Please ensure you include the country code (+254 for Kenya in this case)
		$recipients = implode(",", $phone_numbers);
		// And of course we want our recipients to know what we really do
		$message    = "I'm a lumberjack and its ok, I sleep all night and I work all day";
			// Create a new instance of our awesome gateway class
			
	//	$gateway    = new AfricasTalkingGateway($username, $apikey);
		
		$gateway    = new AfricasTalkingGateway($api_username, $api_key);
		
		// NOTE: If connecting to the sandbox, please add the sandbox flag to the constructor:
		/*************************************************************************************
		 ****SANDBOX****
		 $gateway    = new AfricasTalkingGateway($username, $apiKey, "sandbox");
		 **************************************************************************************/
		// Any gateway error will be captured by our custom Exception class below,
		// so wrap the call in a try-catch block
		try
		{ 
			// Thats it, hit send and we'll take care of the rest.
			$results = $gateway->sendMessage($recipients, $message_to_send);
			//$results = $gateway->sendMessage($recipients, $message);
			
			foreach($results as $result) {
				// status is either "Success" or "error message"
				echo " Number: " .$result->number;
				echo " Status: " .$result->status;
				echo " MessageId: " .$result->messageId;
				echo " Cost: "   .$result->cost."\n";
			}
		}
		catch ( AfricasTalkingGatewayException $e )
		{
			echo "Encountered an error while sending: ".$e->getMessage();
		}
		// DONE!!! 
		
		
		
		
		
		
		
		/* 
	// Textlocal account details
	$username = 'jmbuthia12@gmail.com';
	$hash = 'e32f1103c757bb3a641487083e01f7412cf32438615c7ddec17d067cdb3c6383';
	
	// Message details
	//$numbers = array(+254717925741);
	$sender = urlencode($sender);
	$message = rawurlencode($message_to_send);
	
	$numbers = implode(',', $phone_numbers);
	
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
	//echo $response;
	
	 */
	}
	
	
	
	
	
	
public static function post_async($url,$group_size,$message, $params,$username) {
	foreach ($params as $key => &$val) {
		if (is_array($val)) $val = implode(',', $val);
		$post_params[] = $key.'='.urlencode($val);
		
		//var_dump($post_params);
		//array_push($post_params,$mymeso);
		// var_dump($post_params);
	}
	$mymeso[]=array('message'.'='. urlencode($message));
	$myusername[]=array('username'.'='. urlencode($username));
	$group_size_array[]=array('group_size'.'='. urlencode($group_size));
	//var_dump($mymeso);
	
	$post_params=array_merge($post_params,$mymeso[0],$myusername[0],$group_size_array[0]);
	//var_dump($post_params);
	$post_string = implode('&', $post_params);
	//echo 'post string'.$post_string;
	//echo  is_string(1);
	$parts=parse_url($url);
	$fp = fsockopen($parts['host'],
			isset($parts['port'])?$parts['port']:80,
			$errno, $errstr, 30);
	$out = "POST ".$parts['path']." HTTP/1.1\r\n";
	$out.= "Host: ".$parts['host']."\r\n";
	$out.= "Content-Type: application/x-www-form-urlencoded\r\n";
	$out.= "Content-Length: ".strlen($post_string)."\r\n";
	$out.= "Connection: Close\r\n\r\n";
	if (isset($post_string)) $out.= $post_string;
	fwrite($fp, $out);
	fclose($fp);
}
}