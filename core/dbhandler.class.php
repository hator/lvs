<?php

//ą

defined("STARTED") or die("<p>Unauthorized access.</p>");

class DBHandler {

	private static $dbinstance;

	public static function getDBConnection() {
	
		//echo 'DBHandler::getDBConnection();';
	
		if (!self::$dbinstance) {

			@ self::$dbinstance = new mysqli(Config::$db['host'],Config::$db['user'],Config::$db['password'],Config::$db['dbname']);

			if (mysqli_connect_errno()) {
				throw new RuntimeException('MySQL: '.mysqli_connect_error());
			}

			self::$dbinstance->query("SET NAMES utf8");

		}
		
		return self::$dbinstance;
	
	}

}

?>