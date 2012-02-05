<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

class WinnersSQLList {

	public static function getWinnersList() {
		
		$db = DBHandler::getDBConnection();
		
		$result_contests = $db->query("SELECT * FROM ". Config::$db['prefix'] ."contests WHERE `status`='3'");
		
		if ($result_contests->num_rows == 0) {
			return 1;
		} else if ($result_contests->num_rows < 0) {
			throw new Exception('Nie udało się pobrać listy konkursów');
		}
	
		$loop = 0;
		while($row = $result_contests->fetch_assoc()) {
			
			$return[$loop] = $row;
			
			$result_users = $db->query("SELECT login FROM ". Config::$db['prefix'] ."users WHERE `id`='". $return[$loop]['winner'] ."'");
			
			if ($result_users->num_rows == 1) {
				
				$user = $result_users->fetch_assoc();
				$return[$loop]['login'] = $user['login'];
				
			}
			
			$loop++;
			
		}
		
		return $return;
	
	}

}

?>