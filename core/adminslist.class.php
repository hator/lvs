<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

class AdminsList {

	public static function getList() {
	
		$db = DBHandler::getDBConnection();
		
		$result = $db->query("SELECT * FROM ". Config::$db['prefix'] ."users WHERE `is_admin`='1'");
		
		if ($result->num_rows < 1) {
			throw new Exception('Nie udało się pobrać listy konkursów');
		}
	
		$loop = 0;
		while($row = $result->fetch_assoc()) {
			
			$return[$loop] = $row;			
			$loop++;
			
		}
		
		return $return;
	
	}

}

?>