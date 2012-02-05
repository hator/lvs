<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

class ContestCounter {

	public static function listOfContests() {
	
		$db = DBHandler::getDBConnection();
		
		$result = $db->query("SELECT * FROM ". Config::$db['prefix'] ."contests ORDER BY `date` DESC");
		
		if (!$result->num_rows) {
			return false;
		}
		
		$loop = 0;
		while($row = $result->fetch_assoc()) {
			
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

	public static function addContest($timestamp, $award) {
	
		$db = DBHandler::getDBConnection();
	
		$result = $db->query("INSERT INTO `". Config::$db['prefix'] ."contests` (`id`, `status`, `date`, `winner`, `award`) VALUES (NULL, '0', '". $timestamp ."', NULL, '". $award ."')");
		
		return $result;
	
	}
	
	public static function changeStatus($id, $status) {
	
		$db = DBHandler::getDBConnection();
		
		if ($status == 1 && self::isOpened() != false || $status == 2 && self::isOpened() != false) {
		
			$row_result = $db->query("SELECT * FROM ". Config::$db['prefix'] ."contests WHERE `id`='". $id ."'");
			
			if (!$row_result->num_rows) {
				result -1;
			} else {
				$current = $row_result->fetch_assoc();
				if ($current['status'] == 0 || $current['status'] == 3) {
					return 0;
				}
			}
		}
		
		$result = $db->query("UPDATE `". Config::$db['prefix'] ."contests` SET `status` = '". $status ."' WHERE `id` = '". $id ."'");
		
		if (!$result) {
			return -1;
		} else {
			return 1;
		}
	
	}

	public static function isOpened() {
	
		$db = DBHandler::getDBConnection();
	
		$result = $db->query("SELECT * FROM ". Config::$db['prefix'] ."contests WHERE `status`='2'");
		
		if ($result->num_rows == 1) {
			return 2;
		}
		
		$result = $db->query("SELECT * FROM ". Config::$db['prefix'] ."contests WHERE `status`='1'");
		
		if ($result->num_rows == 1) {
			return 1;
		}
	
		return false;
	
	}
	
	public static function nextContest($status = 0) {
	
		$db = DBHandler::getDBConnection();
		$result = $db->query("SELECT * FROM ". Config::$db['prefix'] ."contests WHERE `status`='". $status ."' ORDER BY `date` DESC LIMIT 1");
		
		if ($result->num_rows >= 1) {
			$row = $result->fetch_assoc();
			return $row['date'];
		}
	
		return false;
	
	}
	
	public static function nextContestsList() {
	
		$db = DBHandler::getDBConnection();
		
		$result_contests = $db->query("SELECT * FROM ". Config::$db['prefix'] ."contests WHERE `status`='0'");
		
		if ($result_contests->num_rows == 0) {
			return true;
		} else if ($result_contests->num_rows < 0) {
			return false;
		}
		
		$loop = 0;
		while($row = $result_contests->fetch_assoc()) {
			$return[$loop] = $row;
			$loop++;
		}
		
		return $return;
	
	}
	
	public static function contestByStatus($status) {
	
		$db = DBHandler::getDBConnection();
		$result = $db->query("SELECT * FROM ". Config::$db['prefix'] ."contests WHERE `status`='". $status ."' LIMIT 1");
		
		if ($result->num_rows == 1) {
			return $result->fetch_assoc();
		} else {
			return false;
		}
	
	}

}

?>