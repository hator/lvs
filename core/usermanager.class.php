<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

class UserManager {

	public static function login($username, $password) {
	
		$db = DBHandler::getDBConnection();
		$result = $db->query("SELECT id, is_admin FROM `". Config::$db['prefix'] ."users` WHERE `login`='". $username ."' AND `password`='". sha1($password) ."'");
		
		if ($result->num_rows != 1) {
			throw new Exception('Nie ma takiego użytkownika lub istnieje wielu takich użytkowników!');
		}
		
		$userdata = $result->fetch_assoc();
		
		$_SESSION['id'] = $userdata['id'];
		$_SESSION['admin'] = $userdata['is_admin'];
		
		ActivityManager::updateLastActive($_SESSION['id']);
	
	}
	
	public static function logout() {
	
		$db = DBHandler::getDBConnection();
		$result = $db->query("UPDATE `lvs_users` SET `last_active`='0' WHERE `id`='". $_SESSION['id'] ."'");
	
		unset($_SESSION['admin']);
		unset($_SESSION['id']);
		session_destroy();
	
	}
	
	public static function addUser($username, $password, $mail, $telephone) {
	
		$db = DBHandler::getDBConnection();
		$checking_result = $db->query("SELECT id FROM `". Config::$db['prefix'] ."users` WHERE `login`='". $username ."'");
		
		if ($checking_result->num_rows > 0) {
			return -1;
		}
		
		$result = $db->query("INSERT INTO `". Config::$db['prefix'] ."users` (`is_admin`, `login`, `password`, `mail`, `tel`) VALUES ('0', '". $username ."', '". sha1($password) ."', '". $mail ."', '". $telephone ."')");
		
	}

}

?>