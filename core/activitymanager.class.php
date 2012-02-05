<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

class ActivityManager {

	public static function updateLastActive($id) {
	
		$db = DBHandler::getDBConnection();
		$result = $db->query("UPDATE `lvs_users` SET `last_active`='". date('U') ."' WHERE `id`='". $id ."'");
	
	}

}

?>