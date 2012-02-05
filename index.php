<?php

error_reporting(E_ALL && E_STRICT ^ E_NOTICE);
//header('Accept-Encoding: utf-8');
session_start();

function prelog($data) {

	echo '<pre>';
	print_r($data);
	echo '</pre>';

}

define('STARTED', true);
define('BASEPATH', str_replace("\\",'/',dirname(__FILE__)).'/');
define('INCPATH', 'views/includes/');

try {

	// Including core files
	require_once BASEPATH.'core/config.class.php';
	require_once BASEPATH.'core/dbhandler.class.php';
	require_once BASEPATH.'core/sitecontroller.class.php';
	require_once BASEPATH.'core/validator.class.php';
	require_once BASEPATH.'core/activitymanager.class.php';
	
	DBHandler::getDBConnection();
	
	if (isset($_SESSION['id']) && $_SESSION['id'] != 0) {
		ActivityManager::updateLastActive($_SESSION['id']);
	}	
	
	$controller = new SiteController();
	
	try {
	
		if (!isset($_GET['action']) || $_GET['action'] == '') {
			$controller->setModule('main');
		} else if (!$controller->checkForModule(Validator::Text($_GET['action'], true, false))) {
			$controller->setParam('404', 'Nie podano modułu do wykonania lub moduł nie istnieje!');
			throw new RuntimeException('Nie podano modułu do wykonania lub moduł nie istnieje!');
		} else {
			$controller->setModule(Validator::Text($_GET['action'], true, false));
		}
			
	} catch (RuntimeException $e) {
		$controller->setView('404');
	}
	
	if ($controller->getModule()) {
		$controller->executeModule();
	}
	
	if (!$controller->getView() || !$controller->checkForView($controller->getView())) {
		$controller->setParam('404', 'Nie podano widoku do wykonania lub plik widoku nie istnieje!');
		$controller->setView('404');
		//throw new RuntimeException('Nie podano widoku do wykonania lub plik widoku nie istnieje!');
	}
		
	$controller->executeView();

} catch (Exception $e) {

	echo '<p>Wystąpił błąd w pliku <span style="font-weight: bold;">'. $e->getFile() .'</span> w linii <span style="font-weight: bold;">'. $e->getLine() .'</span>: '. $e->getMessage() .'</p>';
	exit();

}

?>
