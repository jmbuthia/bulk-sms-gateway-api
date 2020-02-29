<?php
class DbConnect{
	private $con;
	
	function __construct(){
		
	}
	function connect(){
		$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		include_once dirname(__FILE__).'/Constants.php';
		try {
		$this->con= new PDO(SDN, DB_USER, DB_PASSWORD, $options);
		}catch (PDOException $e) {
			$error_message = $e->getMessage();
			include '../errors/db_error_connect.php';
			exit;
		}
		
	
		return $this->con;
	}
	function display_db_error($error_message) {
		global $app_path;
		include '../errors/db_error.php';
		exit;
	}
}
?>